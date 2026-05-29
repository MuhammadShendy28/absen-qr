<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Schedule</title>

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
    min-height:780px;
    background:#F5F5F5;
    border-radius:30px;
    overflow:hidden;
    position:relative;
}

.header{
    background:#2FC7E8;
    padding:60px 20px 30px;
    color:white;
}

.header-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.header h2{
    font-size:34px;
    line-height:45px;
}

.calendar-btn{
    width:45px;
    height:45px;
    border-radius:50%;
    background:rgba(255,255,255,0.3);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:22px;
    color:white;
    text-decoration:none;
}

.date-slider{
    display:flex;
    gap:12px;
    overflow-x:auto;
    margin-top:30px;
    padding-bottom:5px;
}

.date-slider::-webkit-scrollbar{
    display:none;
}

.date-card{
    min-width:65px;
    background:rgba(255,255,255,0.2);
    border-radius:18px;
    padding:12px;
    text-align:center;
    color:white;
    text-decoration:none;
}

.date-card.active{
    background:white;
    color:#2FC7E8;
    position:relative;
}

.date-card.active::before{
    content:'';
    position:absolute;
    top:8px;
    right:10px;
    width:8px;
    height:8px;
    background:#1E2A78;
    border-radius:50%;
}

.date-card h3{
    font-size:32px;
}

.date-card p{
    font-size:13px;
    margin-top:5px;
}

.content{
    background:#F5F5F5;
    margin-top:-10px;
    border-radius:30px 30px 0 0;
    padding:25px 20px 120px;
}

.schedule-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.schedule-top h3{
    font-size:28px;
}

.today-btn{
    border:none;
    background:white;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
}

.schedule-card{
    background:white;
    border-radius:20px;
    padding:18px;
    margin-bottom:18px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.schedule-card h4{
    margin-bottom:20px;
    color:#222;
}

.row{
    display:flex;
    justify-content:space-between;
}

.label{
    color:#999;
    font-size:13px;
    margin-bottom:8px;
}

.value{
    font-size:14px;
    color:#333;
}

.status{
    margin-top:15px;
    display:inline-block;
    padding:6px 14px;
    border-radius:20px;
    color:white;
    font-size:12px;
}

.hadir{
    background:#59C36A;
}

.izin{
    background:orange;
}

.telat{
    background:red;
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
    font-size:24px;
    text-decoration:none;
}

.active-nav{
    color:#2FC7E8;
}

</style>
</head>
<body>

<div class="phone">

<div class="header">

    <div class="header-top">

        <h2>Upcoming<br>Schedule</h2>

        <a href="/calendar?date={{ $selectedDate }}" class="calendar-btn">
            <i class='bx bx-calendar'></i>
        </a>

    </div>

    <div class="date-slider">

        @php

use Carbon\Carbon;

$baseDate = Carbon::parse($selectedDate);

@endphp

@for($i = -3; $i <= 3; $i++)

@php

$date = $baseDate->copy()->addDays($i);

@endphp

<a href="/schedule?date={{ $date->toDateString() }}"
   class="date-card {{ $selectedDate == $date->toDateString() ? 'active' : '' }}">

    <h3>{{ $date->format('d') }}</h3>

    <p>{{ $date->format('D') }}</p>

</a>

@endfor

    </div>

</div>

<div class="content">

    <div class="schedule-top">

        <h3>Schedule</h3>

        <a href="/schedule" class="today-btn">
            Today
        </a>

    </div>

   @foreach($schedules as $schedule)

<div class="schedule-card">

    <h4>{{ $schedule->title }}</h4>

    <div class="row">

        <div>

            <div class="label">Time</div>

            <div class="value">
                {{ $schedule->start_time }}
                -
                {{ $schedule->end_time }}
            </div>

        </div>

        <div>

            <div class="label">Duration</div>

            <div class="value">
                2 Hours
            </div>

        </div>

    </div>

</div>

@endforeach

</div>

<div class="bottom-nav">

    <a href="/home">
        <i class='bx bx-home'></i>
    </a>

    <a href="/schedule" class="active-nav">
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