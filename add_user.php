<?php include 'conacted_db.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة مستخدم لوكل جديد</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            position: relative;
            overflow-x: hidden;
            background: linear-gradient(135deg, #6dd5ed, #2193b0, #b2fefa, #6dd5ed, #2193b0);
            background-size: 400% 400%;
            animation: gradientBG 12s ease-in-out infinite;
            font-family: 'Cairo', Tahoma, Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .animated-bg-shapes {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            pointer-events: none;
            z-index: 0;
        }
        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.18;
            filter: blur(2px);
            animation: moveCircle 18s linear infinite;
        }
        .circle1 { width: 180px; height: 180px; background: #fff; top: 10%; left: 5%; animation-delay: 0s;}
        .circle2 { width: 120px; height: 120px; background: #1976d2; top: 60%; left: 80%; animation-delay: 3s;}
        .circle3 { width: 90px; height: 90px; background: #6dd5ed; top: 80%; left: 10%; animation-delay: 6s;}
        .circle4 { width: 140px; height: 140px; background: #b2fefa; top: 30%; left: 70%; animation-delay: 9s;}
        .circle5 { width: 60px; height: 60px; background: #2193b0; top: 50%; left: 40%; animation-delay: 12s;}

        @keyframes moveCircle {
            0% { transform: translateY(0) scale(1);}
            50% { transform: translateY(-40px) scale(1.15);}
            100% { transform: translateY(0) scale(1);}
        }

        .container {
            max-width: 420px;
            margin: 70px auto;
            background: rgba(255,255,255,0.92);
            border-radius: 22px;
            box-shadow: 0 10px 32px 0 rgba(33,147,176,0.18), 0 1.5px 4px rgba(0,0,0,0.07);
            padding: 38px 32px 28px 32px;
            position: relative;
            z-index: 1;
            overflow-y: auto;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 22px;
        }

        .logo img {
            width: 110px;
            height: 110px;
            object-fit: contain;
            border: 4px solid #fff;
            background: rgba(255,255,255,0.85);
            box-shadow: 0 6px 24px rgba(33,147,176,0.13);
            transition: transform 0.25s;
        }

        .logo img:hover {
            transform: scale(1.07) rotate(-2deg);
            box-shadow: 0 12px 32px rgba(33,147,176,0.22);
        }

        .logo-caption {
            text-align: center;
            font-size: 1.18em;
            color: #1976d2;
            font-weight: bold;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            color: #1976d2;
            margin-bottom: 22px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        label {
            font-size: 1.08em;
            color: #34495e;
            font-weight: 500;
        }

        input[type="text"], input[type="password"], select {
            padding: 12px 14px;
            border: 1.7px solid #b2ebf2;
            border-radius: 10px;
            font-size: 1.07em;
            background: rgba(255,255,255,0.7);
            box-shadow: 0 1px 4px rgba(33,147,176,0.06);
        }

        input[type="password"] {
            padding-right: 40px;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            color: #555;
        }

        input[type="submit"] {
            background: linear-gradient(90deg, #1976d2 60%, #6dd5ed 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 14px 0;
            font-size: 1.15em;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 2px 12px rgba(25,118,210,0.13);
        }

        .msg {
            text-align: center;
            margin-top: 20px;
            font-size: 1.12em;
        }

        @media (max-width: 500px) {
            .container {
                padding: 18px 4px 14px 4px;
            }
            .logo img {
                width: 70px;
                height: 70px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="animated-bg-shapes">
        <div class="circle circle1"></div>
        <div class="circle circle2"></div>
        <div class="circle circle3"></div>
        <div class="circle circle4"></div>
        <div class="circle circle5"></div>
    </div>
    <div class="container">
        <div class="logo">
            <img src="https://rabia-archive.infinityfreeapp.com/img/شعار_قناة_الرابعة.png" alt="شعار">
        </div>
        <div class="logo-caption"> لوكل قناة الرابعة</div>
        <h2>إضافة  لوكل مستخدم جديد</h2>
        <form method="POST" action="">
            <label for="username">اسم المستخدم:</label>
            <input type="text" id="username" name="username" required autocomplete="off">

            <label for="password">كلمة المرور:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>

            <label for="role">الصفة:</label>
            <select id="role" name="role" required>
                <option value="admin">مدير</option>
                <option value="user">مستخدم</option>
                <option value="sport_emp">موظف الرياضة</option>
                <option value="star_emp">موظف النجوم</option>
                
            </select>

            <input type="submit" name="save" value="إنشاء المستخدم">
            <div>
                <a href="login.php">تسجيل الدخول</a>
            </div>
        </form>

        <?php
        if (isset($_POST['save'])) {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role'];

            $sql = "INSERT INTO user_name (username, password, role) VALUES ('$username', '$password', '$role')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='msg' style='color:green;'>✅ تم إنشاء المستخدم بنجاح.</div>";


            } else {
                echo "<div class='msg' style='color:red;'>❌ خطأ: " . $conn->error . "</div>";
            }
        }
        ?>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.textContent = "🙈";
            } else {
                passwordInput.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>
</body>
</html>
