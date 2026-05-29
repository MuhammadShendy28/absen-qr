    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>History</title>

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
        padding:55px 20px 30px;
        color:white;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .left{
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
        font-size:32px;
    }

    .calendar{
        width:45px;
        height:45px;
        border-radius:50%;
        background:rgba(255,255,255,0.3);
        display:flex;
        justify-content:center;
        align-items:center;
        color:white;
        font-size:22px;
        text-decoration:none;
    }

    .content{
        padding:20px;
        padding-bottom:120px;
    }

    .month-select{
        margin-bottom:25px;
    }

    .month-select form select{
        padding:10px 18px;
        border:none;
        border-radius:20px;
        background:#EAEAEA;
        outline:none;
    }

    .card{
        background:white;
        border-radius:25px;
        padding:20px;
        margin-bottom:25px;
    }

    .card-top{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .card-top h3{
        font-size:28px;
    }

    .statistik{
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .circle{
        width:90px;
        height:90px;
        border-radius:50%;
        display:flex;
        justify-content:center;
        align-items:center;
        position:relative;
        font-size:24px;
        font-weight:bold;
        color:#2FC7E8;

        background:
        conic-gradient(
            #2FC7E8 calc({{ $percentage }} * 1%),
            #D9D9D9 0%
        );
    }

    .circle::before{
        content:'';
        position:absolute;
        width:68px;
        height:68px;
        background:white;
        border-radius:50%;
    }

    .circle span{
        position:relative;
        z-index:2;
    }

    .detail p{
        margin-bottom:12px;
        display:flex;
        justify-content:space-between;
        gap:25px;
    }

    .green{
        color:#59C36A;
    }

    .orange{
        color:orange;
    }

    .red{
        color:red;
    }

    .history-title{
        font-size:34px;
        margin-bottom:20px;
    }

    .history-card{
        background:white;
        border-radius:20px;
        padding:18px;
        margin-bottom:18px;
    }

    .history-top{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:15px;
    }

    .badge{
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

    .time{
        color:#888;
        font-size:14px;
        margin-top:12px;
        border-top:1px solid #eee;
        padding-top:12px;
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

        <div class="left">

            <a href="javascript:void(0)" class="calendar" onclick="toggleMonth()">
                <i class='bx bx-arrow-back'></i>
            </a>

            <h2>Riwayat</h2>

        </div>

        <a href="/calendar" class="calendar">
            <i class='bx bx-calendar'></i>
        </a>

    </div>

    <div class="content">

    <div id="monthBox" style="
display:none;
margin-bottom:20px;
background:white;
padding:15px;
border-radius:20px;
">

<form method="GET">

<select
name="month"
onchange="this.form.submit()"
style="
width:100%;
padding:12px;
border:none;
outline:none;
background:#F5F5F5;
border-radius:15px;
"
>

@for($i = 1; $i <= 12; $i++)

@php

$value = now()->year . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);

@endphp

<option
value="{{ $value }}"
{{ $date == $value ? 'selected' : '' }}
>

{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
{{ now()->year }}

</option>

@endfor

</select>

</form>

</div>

    <div class="card">

    <div class="card-top">

    <h3>Statistik</h3>

    <i class='bx bx-chevron-down' style="font-size:28px;"></i>

    </div>

    <div class="statistik">

    <div class="circle">
    <span>{{ $percentage }}%</span>
    </div>

    <div class="detail">

    <p>
    <span>Hadir</span>
    <span class="green">{{ $hadir }}</span>
    </p>

    <p>
    <span>Telat</span>
    <span class="orange">{{ $telat }}</span>
    </p>

    <p>
    <span>Tidak Hadir</span>
    <span class="red">{{ $izin }}</span>
    </p>

    </div>

    </div>

    </div>

    <h2 class="history-title">Riwayat</h2>

    @foreach($histories as $history)

    <div class="history-card">

    <div class="history-top">

    <div>

    <div style="color:#777;">
    {{ \Carbon\Carbon::parse($history->created_at)->translatedFormat('D, d F') }}
    </div>

    </div>

    @if($history->status == 'hadir')

    <div class="badge hadir">
    Hadir
    </div>

    @elseif($history->status == 'izin')

    <div class="badge izin">
    Izin
    </div>

    @elseif($history->status == 'telat')

    <div class="badge telat">
    Telat
    </div>

    @endif

    </div>

    <div class="time">

    {{ $history->title }},
    {{ $history->start_time }}
    -
    {{ $history->end_time }}

    </div>

    </div>

    @endforeach

    </div>

    <div class="bottom-nav">

    <a href="/home">
    <i class='bx bx-home'></i>
    </a>

    <a href="/schedule">
    <i class='bx bx-calendar'></i>
    </a>

    <a href="/history" class="active-nav">
    <i class='bx bx-bar-chart'></i>
    </a>

    <a href="/profile">
        <i class='bx bx-user'></i>
    </a>

    </div>

    </div>

    </body>
    </html>