<!DOCTYPE html>
<html lang="id">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bumi Perkemahan Wana Harum</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            background: #f4f6f9;
        }

        .container {
            width: 100%;
            display: flex;
        }

        /* LEFT SIDE */

        .left {
            width: 50%;
            background: url("{{ asset('images/area_kemah.jpeg') }}") center/cover no-repeat;
            position: relative;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px;
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
        }

        .brand {
            position: relative;
            z-index: 2;
            font-size: 22px;
            font-weight: bold;
        }

        .left-content {
            position: relative;
            z-index: 2;
        }

        .left-content h1 {
            font-size: 42px;
            line-height: 1.2;
        }

        .left-content span {
            color: #4CAF50;
        }

        .left-footer {
            position: relative;
            z-index: 2;
            font-size: 14px;
            opacity: .9;
        }

        /* RIGHT SIDE */

        .right {
            width: 50%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            width: 380px;
        }

        .form-box h2 {
            font-size: 28px;
            margin-bottom: 25px;
            position: relative;
        }

        .form-box h2::after {
            content: '';
            width: 40px;
            height: 3px;
            background: #4CAF50;
            display: block;
            margin-top: 6px;
        }

        label {
            font-size: 14px;
            display: block;
            margin-bottom: 6px;
            margin-top: 18px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: #f9fafb;
        }

        input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .btn-login {
            margin-top: 25px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: .3s;
        }

        .btn-login:hover {
            background: #3d9140;
        }

        .top-bar {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 60px;
        }

        /* tombol kembali */

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            backdrop-filter: blur(6px);
            transition: 0.3s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.35);
        }

        .register-link {
            margin-top: 18px;
            text-align: center;
            font-size: 14px;
        }

        .register-link a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        /* MOBILE RESPONSIVE */

        @media(max-width:900px) {

            .left {
                display: none;
            }

            .right {
                width: 100%;
            }

            .form-box {
                width: 90%;
            }


        }

        /* brand */

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 600;
        }

        /* logo */

        .logo {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            width: 100%;
            padding: 12px;
            padding-right: 45px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: #f9fafb;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            opacity: 0.6;
        }

        .toggle-password:hover {
            opacity: 1;
        }

        .toggle-password i {
            font-size: 18px;
            color: #666;
        }

        .toggle-password:hover i {
            color: #4CAF50;
        }
    </style>

</head>

<body>

    <div class="container">

        <!-- LEFT IMAGE SECTION -->

        <div class="left">

            <div class="overlay"></div>

            <div class="top-bar">

                <a href="{{ route('home') }}" class="btn-back">
                    ← Kembali
                </a>

                <div class="brand">
                    <img src="{{ asset('images/logo_wana_harum_nobg.png') }}" class="logo">
                    <span>Bumi Perkemahan Wana Harum</span>
                </div>

            </div>

            <div class="left-content">
                <h1>
                    Nikmati Alam, <br>
                    <span>Jalin Kebersamaan</span>
                    Bersama Kami
                </h1>

                <p>
                    Masuk untuk melakukan pemesanan tempat kemah
                    dengan mudah dan cepat.
                </p>
            </div>

            <div class="left-footer">
                Pengalaman berkemah nyaman dimulai dari sini.
            </div>

        </div>


        <!-- RIGHT FORM SECTION -->

        <div class="right">

            <div class="form-box">

                <h2>Login</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label>Email</label>
                    <input type="email" name="email" required>

                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password">
                        <span class="toggle-password" onclick="togglePassword()">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </span>
                    </div>

                    <button class="btn-login">
                        Login →
                    </button>

                </form>

                <div class="register-link">
                    Belum punya akun?
                    <a href="{{ route('register') }}">Register</a>
                </div>

            </div>

        </div>

    </div>

</body>
<script>
    function togglePassword() {

        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("bi-eye");
            eyeIcon.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("bi-eye-slash");
            eyeIcon.classList.add("bi-eye");
        }

    }
</script>

</html>