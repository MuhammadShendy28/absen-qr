<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Home</title>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#e5e5e5;
    display:flex;
    justify-content:center;
    padding:20px 0;
}

.phone{
    width:390px;
    min-height:844px;
    background:#F5F5F5;
    border-radius:30px;
    overflow:hidden;
    position:relative;
    box-shadow:0 0 25px rgba(0,0,0,0.12);
}

.header{
    background:#2FC7E8;
    padding:50px 20px 120px;
    color:white;
    border-radius:0 0 35px 35px;
}

.content{
    padding:0 20px 120px;
    margin-top:-80px;
    position:relative;
}

.section-title{
    font-size:22px;
    color:#222;
    margin-bottom:18px;
    font-weight:700;
}

.session-card{
    background:white;
    border-radius:24px;
    padding:18px;
    margin-bottom:18px;
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
}

.left{
    display:flex;
    gap:15px;
}

.icon-box{
    width:42px;
    height:42px;
    border-radius:12px;
    background:#2FC7E8;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    font-size:20px;
}

.session-label{
    background:#E8F0FF;
    color:#4A7BFF;
    display:inline-block;
    padding:4px 10px;
    border-radius:10px;
    font-size:11px;
    margin-bottom:10px;
}

.title{
    font-size:17px;
    color:#222;
    margin-bottom:4px;
    font-weight:700;
}

.time{
    color:#777;
    font-size:14px;
}

.status{
    padding:8px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.wait{
    background:#F1F1F1;
    color:#777;
}

.running{
    background:#FFE8B8;
    color:#C78B00;
}

.done{
    background:#DFF5DD;
    color:#43A047;
}

.line{
    height:1px;
    background:#EAEAEA;
    margin:22px 0;
}

.row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
}

.row-left{
    display:flex;
    align-items:center;
    gap:12px;
}

.small-icon{
    width:34px;
    height:34px;
    border-radius:8px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:18px;
}

.in{
    background:#E8F2FF;
    color:#4A7BFF;
}

.out{
    background:#F6E8FF;
    color:#B14DFF;
}

.btn{
    width:100%;
    height:54px;
    border:none;
    border-radius:14px;
    color:white;
    font-size:15px;
    font-weight:bold;
    cursor:pointer;
}

.btn-masuk{
    background:#29C3E6;
}

.btn-selesai{
    background:#35B84B;
}

.finished{
    background:#DFF5DD;
    padding:16px;
    border-radius:14px;
    color:#43A047;
    font-size:14px;
    line-height:1.5;
}

.bottom-nav{
    position:absolute;
    bottom:0;
    width:100%;
    background:white;
    display:flex;
    justify-content:space-around;
    padding:18px 0;
    border-top:1px solid #ddd;
}

.bottom-nav a{
    color:#444;
    font-size:28px;
    text-decoration:none;
    width:50px;
    height:50px;
    display:flex;
    justify-content:center;
    align-items:center;
}

.active{
    color:#2FC7E8 !important;
}

</style>
</head>
<body>

<div class="phone">

<div class="header">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
    ">

        <div>

            <h2 style="
                font-size:26px;
                margin-bottom:6px;
                font-weight:700;
            ">
                Hello, {{ ucwords(session('user_name')) }}
            </h2>

            <p style="
                font-size:14px;
                opacity:0.9;
            ">
                Have a nice day
            </p>

        </div>

        <div style="
            width:48px;
            height:48px;
            border-radius:50%;
            background:rgba(255,255,255,0.25);
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:22px;
            color:white;
        ">

            @php

$unread = 0;

@endphp

<a href="#" style="
    position:relative;
    color:white;
">

<i class='bx bx-bell'></i>

@if($unread > 0)

<span style="
    position:absolute;
    top:-2px;
    right:-2px;
    width:10px;
    height:10px;
    background:red;
    border-radius:50%;
"></span>

@endif

</a>

        </div>

    </div>

</div>

<div class="content">

<h2 class="section-title">
    Sesi Hari Ini
</h2>

@foreach($schedules as $schedule)

@php

$attendance = DB::table('attendances')

    ->where('user_id', session('user_id'))

    ->where('schedule_id', $schedule->id)

    ->whereDate('created_at', now()->toDateString())

    ->first();

@endphp

<div class="session-card">

<div class="top">

<div class="left">

<div class="icon-box">
    <i class='bx bx-desktop'></i>
</div>

<div>

<div class="session-label">
    Sesi {{ $loop->iteration }}
</div>

<div class="title">
    {{ $schedule->title }}
</div>

<div class="time">

    <i class='bx bx-time'></i>

    {{ $schedule->start_time }}
    -
    {{ $schedule->end_time }}

</div>

</div>

</div>

@php

$sessionEnded = now()->format('H:i') > $schedule->end_time;

@endphp

@if(!$attendance && !$sessionEnded)

<div class="status wait">
    Belum Absen
</div>

@elseif($attendance && !$attendance->check_out)

<div class="status running">
    Sedang Berlangsung
</div>

@else

<div class="status done">
    Selesai
</div>

@endif

</div>

<div class="line"></div>

<div class="row">

<div class="row-left">

<div class="small-icon in">
    <i class='bx bx-log-in'></i>
</div>

<span>Absen Masuk</span>

</div>

<strong>
    {{ $attendance ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '-' }}
</strong>

</div>

<div class="row">

<div class="row-left">

<div class="small-icon out">
    <i class='bx bx-log-out'></i>
</div>

<span>Absen Keluar</span>

</div>

<strong>
    {{ $attendance && $attendance->check_out
    ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i')
    : '-'
}}
</strong>

</div>

@if(!$attendance)

<form action="/absen-masuk/{{ $schedule->id }}" method="POST">

@csrf

<button type="submit" class="btn btn-masuk">

    <i class='bx bx-log-in'></i>
    Absen Masuk

</button>

</form>

@elseif(!$attendance && $sessionEnded)

<button
    class="btn"
    style="
        background:#E0E0E0;
        color:#777;
        cursor:not-allowed;
    "
    disabled
>
    Sesi Berakhir
</button>

@elseif($attendance && !$attendance->check_out)

<form action="/selesai-sesi/{{ $attendance->id }}" method="POST">

@csrf

<button type="submit" class="btn btn-selesai">

    <i class='bx bx-check-circle'></i>
    Selesaikan Sesi

</button>

</form>

@else

<div class="finished">

    <strong>Sesi selesai.</strong><br>
    Terimakasih telah berpartisipasi!

</div>

@endif

</div>

@endforeach

</div>

<div class="bottom-nav">

<a href="/home" class="active">
    <i class='bx bx-home'></i>
</a>

<a href="/schedule">
    <i class='bx bx-calendar'></i>
</a>

<a href="/history">
    <i class='bx bx-bar-chart'></i>
</a>

<a href="/profile">
    <i class='bx bx-user'></i>
</a>

</div>

</div>

</body>
</html>