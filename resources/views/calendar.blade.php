<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Calendar</title>

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
    height:844px;
    background:#F5F5F5;
    border-radius:30px;
    overflow:hidden;
    position:relative;
}

.header{
    background:#2FC7E8;
    padding:55px 20px 25px;
    color:white;
    display:flex;
    align-items:center;
    gap:15px;
}

.back{
    color:white;
    font-size:28px;
    text-decoration:none;
}

.header h2{
    font-size:30px;
}

.content{
    padding:25px 20px 120px;
    overflow-y:auto;
    overflow-x:hidden;
    height:calc(844px - 140px);
}

.content::-webkit-scrollbar{
    display:none;
}

.month-section{
    margin-bottom:45px;
}

.month-title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.month-title h3{
    font-size:28px;
    color:#1E2A78;
}

.nav-btn{
    font-size:26px;
    text-decoration:none;
    color:#2FC7E8;
}

.days{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    gap:10px;
    text-align:center;
    width:100%;
}

.day-name{
    color:#999;
    font-size:12px;
}

.day{
    text-decoration:none;
    color:#1E2A78;
    width:35px;
    height:35px;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:50%;
    margin:auto;
    font-size:14px;
}

.day:hover{
    background:#DFF6FB;
}

.day.active{
    background:#2FC7E8;
    color:white;
}

.bottom-nav{
    position:absolute;
    bottom:0;
    left:0;
    right:0;
    background:white;
    display:flex;
    justify-content:space-around;
    padding:18px 0;
    border-top:1px solid #ddd;
    border-radius:0 0 30px 30px;
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

    <a href="/schedule" class="back">
        <i class='bx bx-arrow-back'></i>
    </a>

    <h2>Choose Date</h2>

</div>

<div class="content">

@php

use Carbon\Carbon;

$month = request('month')
    ? request('month')
    : now()->month;

$year = request('year')
    ? request('year')
    : now()->year;

$currentMonth = Carbon::create($year, $month, 1);

$nextMonth = $currentMonth->copy()->addMonth();

$months = [
    $currentMonth,
    $nextMonth
];

@endphp

@foreach($months as $index => $monthData)

@php

$daysInMonth = $monthData->daysInMonth;

$monthName = $monthData->translatedFormat('F');

@endphp

<div class="month-section">

@if($index == 0)

<div class="month-title">

<a
href="/calendar?month={{ $currentMonth->copy()->subMonths(2)->month }}&year={{ $currentMonth->copy()->subMonths(2)->year }}"
class="nav-btn"
>
<i class='bx bx-chevron-left'></i>
</a>

<h3>
{{ $monthName }} {{ $monthData->year }}
</h3>

<a
href="/calendar?month={{ $currentMonth->copy()->addMonths(2)->month }}&year={{ $currentMonth->copy()->addMonths(2)->year }}"
class="nav-btn"
>
<i class='bx bx-chevron-right'></i>
</a>

</div>

@else

<h3 style="
font-size:28px;
color:#1E2A78;
margin-bottom:30px;
text-align:center;
">
{{ $monthName }} {{ $monthData->year }}
</h3>

@endif

<div class="days">

<div class="day-name">MON</div>
<div class="day-name">TUE</div>
<div class="day-name">WED</div>
<div class="day-name">THU</div>
<div class="day-name">FRI</div>
<div class="day-name">SAT</div>
<div class="day-name">SUN</div>

@for($i = 1; $i <= $daysInMonth; $i++)

@php

$date = Carbon::create(
    $monthData->year,
    $monthData->month,
    $i
)->toDateString();

@endphp

<a
href="/schedule?date={{ $date }}"
class="day
{{ now()->toDateString() == $date ? 'active' : '' }}"
>

{{ $i }}

</a>

@endfor

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