<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Register</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
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
            background:#1B2C68;
            position:relative;
            border-radius:30px;
            overflow:hidden;
            box-shadow:0 0 25px rgba(0,0,0,0.2);
            padding:40px 30px;
        }

        .logo{
            text-align:center;
            margin-top:40px;
        }

        .logo-circle{
            width:100px;
            height:100px;
            background:#2FC7E8;
            border-radius:50%;
            margin:auto;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .logo-circle img{
            width:185px;
        }

        .title{
            text-align:center;
            color:white;
            margin-top:25px;
        }

        .title h1{
            font-size:40px;
            margin-bottom:10px;
        }

        .title p{
            color:#BFC7D5;
            font-size:14px;
            line-height:22px;
        }

        .form-area{
            margin-top:60px;
        }

        .input-group{
            width:100%;
            height:65px;
            background:#F2F2F2;
            border-radius:18px;
            margin-bottom:20px;
            display:flex;
            align-items:center;
            padding:0 18px;
        }

        .icon{
            font-size:24px;
            margin-right:15px;
            color:#1B2C68;
            display:flex;
            align-items:center;
        }

        .input-group input{
            width:100%;
            border:none;
            outline:none;
            background:none;
            font-size:15px;
            color:#333;
        }

        .input-group input::placeholder{
            color:#A9A9A9;
        }

        .btn{
            margin-top:30px;
        }

        .btn button{
            width:100%;
            height:60px;
            border:none;
            border-radius:30px;
            background:#2FC7E8;
            color:white;
            font-size:22px;
            font-weight: bold;
            cursor:pointer;
        }

        .login{
            text-align:center;
            margin-top:40px;
            color:white;
            font-size:15px;
        }

        .login a{
            color:#2FC7E8;
            text-decoration:none;
            font-family:Arial, sans-serif
        }

        @media(max-width:400px){

            body{
                padding:0;
            }

            .phone{
                width:100%;
                min-height:100vh;
                border-radius:0;
            }

        }

    </style>

</head>
<body>

<div class="phone">

    <div class="logo">

        <div class="logo-circle">
            <img src="{{ asset('images/Logo2.png') }}">
        </div>

    </div>

    <div class="title">
        <h1>Sign Up</h1>

        <p>
            Create an account so you can explore all the <br>
            existing jobs
        </p>
    </div>

    <div class="form-area">

        <form action="/register" method="POST">

            @csrf

            <div class="input-group">
               <div class="icon">
                 <i class='bx bxs-user'></i>
            </div>

                <input type="text" name="name" placeholder="Username">
            </div>

            <div class="input-group">
                <div class="icon">
                    <i class='bx bxs-envelope'></i>
                </div>
                <input type="email" name="email" placeholder="Email Address">
            </div>

            <div class="input-group">
                <div class="icon">
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <input type="password" name="password" placeholder="Password">
            </div>

            <div class="btn">
                <button type="submit">
                    Sign Up
                </button>
            </div>

        </form>

        <div class="login">
            Already have an account?
            <a href="/">Log In</a>
        </div>

    </div>

</div>

</body>
</html>