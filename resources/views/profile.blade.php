<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profile</title>

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
    height:220px;
    position:relative;
}

.back-btn{
    position:absolute;
    top:50px;
    left:20px;
    color:white;
    font-size:30px;
    text-decoration:none;
}

.profile-card{
    position:relative;
    margin-top:-55px;
    background:#F5F5F5;
    border-radius:45px 45px 0 0;
    padding:0 20px 120px;
    min-height:700px;
}

.profile-image{
    width:110px;
    height:110px;
    border-radius:50%;
    background:white;
    margin:auto;
    margin-top:-55px;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    border:6px solid #F5F5F5;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
}

.profile-image i{
    font-size:90px;
    color:#5B8DFF;
}

.name{
    text-align:center;
    margin-top:18px;
    font-size:22px;
    font-weight:bold;
    color:#222;
}

.email{
    text-align:center;
    color:#666;
    margin-top:6px;
    font-size:15px;
}

.line{
    width:100%;
    height:1px;
    background:#ddd;
    margin:25px 0;
}

.menu{
    display:flex;
    flex-direction:column;
    gap:14px;
}

.menu-card{
    background:white;
    border:1px solid #ddd;
    border-radius:14px;
    padding:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    text-decoration:none;
    color:#333;
}

.menu-left{
    display:flex;
    align-items:center;
    gap:14px;
}

.menu-left i{
    font-size:22px;
    color:#666;
}

.menu-title{
    font-size:16px;
}

.arrow{
    font-size:22px;
    color:#333;
}

.logout{
    margin-top:40px;
    border:1px solid #ffb3b3;
}

.logout .menu-left i,
.logout .menu-title,
.logout .arrow{
    color:#ff3b30;
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
    color:#2FC7E8 !important;
}

</style>
</head>
<body>

<div class="phone">

<div class="header">

    <a href="/home" class="back-btn">
        <i class='bx bx-chevron-left'></i>
    </a>

</div>

<div class="profile-card">

    <div class="profile-image">

        <i class='bx bxs-user-circle'></i>

    </div>

    <div class="name">
        {{ ucwords(session('user_name')) }}
    </div>

    <div class="email">
        {{ session('user_email') }}
    </div>

    <div class="line"></div>

    <div class="menu">

        <a href="#" class="menu-card">

            <div class="menu-left">

                <i class='bx bx-cog'></i>

                <div class="menu-title">
                    Pengaturan
                </div>

            </div>

            <i class='bx bx-chevron-right arrow'></i>

        </a>

        <a href="#" class="menu-card">

            <div class="menu-left">

                <i class='bx bx-lock-alt'></i>

                <div class="menu-title">
                    Keamanan
                </div>

            </div>

            <i class='bx bx-chevron-right arrow'></i>

        </a>

        <a href="#" class="menu-card">

            <div class="menu-left">

                <i class='bx bx-help-circle'></i>

                <div class="menu-title">
                    Bantuan & Dukungan
                </div>

            </div>

            <i class='bx bx-chevron-right arrow'></i>

        </a>

        <a href="/logout" class="menu-card logout">

            <div class="menu-left">

                <i class='bx bx-log-out'></i>

                <div class="menu-title">
                    Keluar
                </div>

            </div>

            <i class='bx bx-chevron-right arrow'></i>

        </a>

    </div>

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

    <a href="/profile" class="active-nav">
        <i class='bx bx-user'></i>
    </a>

</div>

</div>

</body>
</html>