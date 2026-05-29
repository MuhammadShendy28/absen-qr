<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Notifications</title>

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
}

.header{
    padding:25px 20px 10px;
}

.top-bar{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:30px;
}

.back{
    font-size:28px;
    color:black;
    text-decoration:none;
}

.title{
    font-size:24px;
    font-weight:700;
}

.today{
    font-size:28px;
    font-weight:700;
    margin-bottom:20px;
    padding:0 20px;
}

.content{
    padding:0 20px 120px;
}

.notif-card{
    background:white;
    border-radius:18px;
    padding:16px;
    display:flex;
    gap:14px;
    align-items:flex-start;
    margin-bottom:18px;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
}

.icon{
    width:42px;
    height:42px;
    border-radius:50%;
    background:#DFF5DD;
    display:flex;
    justify-content:center;
    align-items:center;
    color:#43A047;
    font-size:22px;
    flex-shrink:0;
}

.notif-title{
    font-size:17px;
    font-weight:700;
    margin-bottom:4px;
}

.notif-sub{
    font-size:13px;
    color:#999;
    margin-bottom:6px;
}

.notif-message{
    font-size:14px;
    color:#666;
}

.empty{
    text-align:center;
    color:#999;
    margin-top:100px;
    font-size:16px;
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

</style>
</head>
<body>

<div class="phone">

<div class="header">

<div class="top-bar">

<a href="/home" class="back">
    <i class='bx bx-arrow-back'></i>
</a>

<div class="title">
    Notifikasi
</div>

</div>

</div>

<div class="today">
    Hari Ini
</div>

<div class="content">

@if(count($notifications) > 0)

@foreach($notifications as $notif)

<div class="notif-card">

<div class="icon">

@if(str_contains($notif->title, 'selesai'))

<i class='bx bx-flag'></i>

@else

<i class='bx bx-check'></i>

@endif

</div>

<div>

<div class="notif-title">
    {{ $notif->title }}
</div>

<div class="notif-sub">
    {{ \Carbon\Carbon::parse($notif->created_at)->format('d M Y • H:i') }}
</div>

<div class="notif-message">
    {{ $notif->message }}
</div>

</div>

</div>

@endforeach

@else

<div class="empty">
    Tidak ada notifikasi
</div>

@endif

</div>

<div class="bottom-nav">

<a href="/home">
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
