<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
            overflow:hidden;
            border-radius:30px;
            box-shadow:0 0 25px rgba(0,0,0,0.2);
            }

        .top-bg{
            width:100%;
            height:320px;
            background:#2FC7E8;
            border-bottom-left-radius:50%;
            border-bottom-right-radius:50%;
            position:absolute;
            top:0;
            left:0;
        }

        .welcome{
            position:absolute;
            top:50px;
            width:100%;
            text-align:center;
            color:white;
            font-weight:bold;
            font-size:22px;
            z-index:2;
        }

        .logo{
            position:absolute;
            top:120px;
            width:100%;
            text-align:center;
            z-index:2;
        }

        .logo img{
            width:180px;
        }

        .form-area{
            position:absolute;
            top:430px;
            width:100%;
            padding:0 35px;
            z-index:2;
        }

        .input-group{
            margin-bottom:20px;
        }

        .input-group input{
            width:100%;
            padding:16px;
            border:none;
            border-radius:30px;
            outline:none;
            background:#F2F2F2;
            font-size:14px;
}

        .input-group input::placeholder{
            color:#bdbdbd;
        }

        .btn button{
            width:100%;
            padding:15px;
            border:none;
            border-radius:30px;
            background:#2FC7E8;
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
            margin-top:10px;
        }

        .register{
            text-align:center;
            margin-top:20px;
            color:white;
            font-size:14px;
        }

        .register a{
            color:#2FC7E8;
            text-decoration:none;
        }

        .error{
            background:red;
            color:white;
            padding:12px;
            border-radius:15px;
            margin-bottom:20px;
            text-align:center;
        }

        @media(max-width:400px){

            .phone{
                width:100%;
                height:100vh;
            }

        }

    </style>

</head>
<body>

<div class="phone">

    <div class="top-bg"></div>

    <div class="welcome">
        HELLO, WELCOME!
    </div>

    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="">
    </div>

    <div class="form-area">

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST">

            @csrf

            <div class="input-group">
                <input type="email" name="email" placeholder="Masukkan Email">
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Masukkan Password">
            </div>

            <div class="btn">
                <button type="submit">
                    Login
                </button>
            </div>

        </form>

        <div class="register">
            Belum punya akun?
            <a href="/register">Daftar</a>
        </div>

    </div>

</div>

</body>
</html>