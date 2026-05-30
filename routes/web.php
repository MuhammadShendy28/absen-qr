<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('login');

});

Route::post('/login', function (Request $request) {

    $user = DB::table('users')
        ->where('email', $request->email)
        ->first();

    if($user && Hash::check($request->password, $user->password)){

        session([

            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email

        ]);

        return redirect('/home');

    }

    return back()->with(
        'error',
        'Email atau password salah'
    );

});

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register', function () {

    return view('register');

});

Route::post('/register', function (Request $request) {

    DB::table('users')->insert([

        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),

        'created_at' => now(),
        'updated_at' => now()

    ]);

    return redirect('/');

});

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {

    if(!session('user_id')){
        return redirect('/');
    }

    $userId = session('user_id');

    $today = now()->toDateString();

    /*
    |--------------------------------------------------------------------------
    | STATISTIK
    |--------------------------------------------------------------------------
    */

    $hadir = DB::table('attendances')

        ->where('user_id', $userId)

        ->where('status', 'hadir')

        ->whereDate('created_at', $today)

        ->count();

    $telat = DB::table('attendances')

        ->where('user_id', $userId)

        ->where('status', 'telat')

        ->whereDate('created_at', $today)

        ->count();

    $totalSchedule = DB::table('schedules')

        ->count();

    $totalAttendance = $hadir + $telat;

    $absen = $totalSchedule - $totalAttendance;

    if($absen < 0){

        $absen = 0;

    }

    if($totalSchedule > 0){

        $percentage = round(
            ($totalAttendance / $totalSchedule) * 100
        );

    }else{

        $percentage = 0;

    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    $search = request('search');

    /*
    |--------------------------------------------------------------------------
    | SCHEDULE
    |--------------------------------------------------------------------------
    */

    $schedules = DB::table('schedules')

        ->when($search, function($query) use ($search){

            $query->where(
                'title',
                'like',
                '%' . $search . '%'
            );

        })

        ->orderBy('start_time', 'asc')

        ->get();

    return view('home', compact(

        'hadir',
        'telat',
        'absen',
        'percentage',
        'schedules'

    ));

});

/*
|--------------------------------------------------------------------------
| ABSEN MASUK
|--------------------------------------------------------------------------
*/

Route::post('/absen-masuk/{id}', function ($id) {

    $schedule = DB::table('schedules')
        ->where('id', $id)
        ->first();

    $now = now();

    $startTime = $schedule->start_time;
    $endTime = $schedule->end_time;

    // kalau sesi sudah selesai
    if($now->format('H:i') > $endTime){

        return back()->with(
            'error',
            'Sesi sudah berakhir'
        );

    }

    $check = DB::table('attendances')

        ->where('user_id', session('user_id'))

        ->where('schedule_id', $id)

        ->whereDate('created_at', now()->toDateString())

        ->first();

    if(!$check){

        // STATUS HADIR / TELAT
        if($now->format('H:i') <= $startTime){

            $status = 'hadir';

        }else{

            $status = 'telat';

        }

        DB::table('attendances')->insert([

            'user_id' => session('user_id'),
            'schedule_id' => $id,
            'status' => $status,
            'check_in' => now()->format('H:i'),
            'created_at' => now(),
            'updated_at' => now()

        ]);

        DB::table('notifications')->insert([

            'user_id' => session('user_id'),
            'title' => 'Absen masuk berhasil',
            'message' => 'Absensi untuk ' . $schedule->title . ' berhasil dicatat',
            'is_read' => 0,
            'created_at' => now(),
            'updated_at' => now()

        ]);

    }

    return redirect('/home');

});

/*
|--------------------------------------------------------------------------
| SELESAIKAN SESI
|--------------------------------------------------------------------------
*/

Route::post('/selesai-sesi/{id}', function ($id) {

    $attendance = DB::table('attendances')

        ->where('id', $id)

        ->first();

    DB::table('attendances')

        ->where('id', $id)

        ->update([

            'check_out' => now()->format('H:i'),

            'updated_at' => now()

        ]);

    $schedule = DB::table('schedules')

        ->where('id', $attendance->schedule_id)

        ->first();

    DB::table('notifications')->insert([

        'user_id' => session('user_id'),

        'title' => 'Sesi selesai',

        'message' => 'Absensi keluar berhasil dicatat',

        'is_read' => 0,

        'created_at' => now(),
        'updated_at' => now()

    ]);

    return redirect('/home');

});

/*
|--------------------------------------------------------------------------
| SCHEDULE
|--------------------------------------------------------------------------
*/

Route::get('/schedule', function () {

    if(!session('user_id')){
        return redirect('/');
    }

    $selectedDate = request('date')
        ? request('date')
        : now()->toDateString();

    $schedules = DB::table('schedules')

        ->orderBy('start_time', 'asc')

        ->get();

    return view('schedule', compact(

        'schedules',
        'selectedDate'

    ));

});

/*
|--------------------------------------------------------------------------
| CALENDAR
|--------------------------------------------------------------------------
*/

Route::get('/calendar', function () {

    if(!session('user_id')){
        return redirect('/');
    }

    return view('calendar');

});

/*
|--------------------------------------------------------------------------
| HISTORY
|--------------------------------------------------------------------------
*/

Route::get('/history', function () {

    if(!session('user_id')){
        return redirect('/');
    }

    $date = request('date')
        ? request('date')
        : now()->toDateString();

    $histories = DB::table('attendances')

        ->join(
            'schedules',
            'attendances.schedule_id',
            '=',
            'schedules.id'
        )

        ->where(
            'attendances.user_id',
            session('user_id')
        )

        ->whereDate(
            'attendances.created_at',
            $date
        )

        ->select(

            'attendances.*',

            'schedules.title',
            'schedules.start_time',
            'schedules.end_time'

        )

        ->latest('attendances.created_at')

        ->get();

    $hadir = $histories
        ->where('status', 'hadir')
        ->count();

    $telat = $histories
        ->where('status', 'telat')
        ->count();

    $izin = $histories
        ->where('status', 'izin')
        ->count();

    $total = $histories->count();

    $percentage = $total > 0
        ? round(($hadir / $total) * 100)
        : 0;

    return view('history', compact(

        'histories',
        'hadir',
        'telat',
        'izin',
        'percentage',
        'date'

    ));

});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::get('/profile', function () {

    if(!session('user_id')){
        return redirect('/');
    }

    return view('profile');

});

/*
|--------------------------------------------------------------------------
| NOTIFICATIONS
|--------------------------------------------------------------------------
*/

/*
Route::get('/notifications', function () {

    ...

});
*/

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::get('/logout', function () {

    session()->flush();

    return redirect('/');

});