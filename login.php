
<?php
// بدء الجلسة بشكل آمن في أول الملف
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conacted_db.php';

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // حماية ضد SQL Injection
    $username = $conn->real_escape_string($username);

    // جلب بيانات المستخدم بناءً على اسم المستخدم فقط
    $query = "SELECT * FROM user_name WHERE username='$username'";
    $result = $conn->query($query);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // تحقق من كلمة المرور المشفرة
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'] ?? 'user';
            session_write_close(); // إغلاق الجلسة قبل إعادة التوجيه
            header("Location: index.php");
            exit;
        } else {
            $error = "اسم المستخدم أو كلمة المرور غير صحيحة.";
        }
    } else {
        $error = "اسم المستخدم أو كلمة المرور غير صحيحة.";
    }
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>دتسجيل الدخول</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      /* خلفية متدرجة متحركة */
      background: linear-gradient(-45deg, #a7bfe8, #f0f4fd, #4a6cf7, #222e50);
      background-size: 400% 400%;
      animation: gradientBG 11s ease-in-out infinite;
      font-family: 'Cairo', Arial, sans-serif;
      margin: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    @keyframes gradientBG {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }
    /* خلفية أرشيفية SVG */
    .archive-bg {
      position: fixed;
      inset: 0;
      z-index: 0;
      pointer-events: none;
      opacity: 0.13;
      background: url('data:image/svg+xml;utf8,<svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="10" y="20" width="40" height="60" rx="6" fill="%23fff" stroke="%234a6cf7" stroke-width="2"/><rect x="70" y="30" width="36" height="50" rx="5" fill="%23f0f4fd" stroke="%23222e50" stroke-width="2"/><rect x="30" y="90" width="60" height="18" rx="4" fill="%23a7bfe8" stroke="%234a6cf7" stroke-width="2"/><rect x="80" y="10" width="24" height="16" rx="3" fill="%23fff" stroke="%234a6cf7" stroke-width="2"/><rect x="10" y="90" width="18" height="18" rx="3" fill="%23fff" stroke="%23222e50" stroke-width="2"/></svg>');
      background-size: 140px 140px;
      animation: archiveMove 22s linear infinite;
    }
    @keyframes archiveMove {
      0% {background-position: 0 0;}
      100% {background-position: 140px 140px;}
    }
    .login-container {
      background: rgba(255,255,255,0.98);
      border-radius: 28px;
      box-shadow: 0 12px 40px 0 rgba(34,46,80,0.22), 0 1.5px 8px 0 #4a6cf733;
      padding: 48px 36px 36px 36px;
      min-width: 320px;
      max-width: 95vw;
      text-align: center;
      position: relative;
      opacity: 0;
      transform: translateY(60px) scale(0.97);
      transition: all 0.8s cubic-bezier(.68,-0.55,.27,1.55);
      animation: popIn 1.1s cubic-bezier(.68,-0.55,.27,1.55) 0.2s both;
      z-index: 2;
    }
    @keyframes popIn {
      0% { opacity: 0; transform: translateY(60px) scale(0.97);}
      100% { opacity: 1; transform: translateY(0) scale(1);}
    }
    .login-logo {
      width: 80px;
      height: 80px;
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 2px 12px rgba(74,108,247,0.13);
      margin-bottom: 22px;
      object-fit: contain;
      animation: logoPop 1.1s cubic-bezier(.68,-0.55,.27,1.55);
    }
    @keyframes logoPop {
      0% { transform: scale(0.7) rotate(-10deg); opacity: 0; }
      70% { transform: scale(1.1) rotate(3deg); opacity: 1; }
      100% { transform: scale(1) rotate(0); opacity: 1; }
    }
    .login-desc {
      color: #3a4a6b;
      margin-bottom: 28px;
      font-size: 1.18em;
      letter-spacing: 0.5px;
      font-weight: 500;
      animation: fadeIn 1.2s 0.3s backwards;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px);}
      to { opacity: 1; transform: translateY(0);}
    }
    .login-input {
      width: 92%;
      padding: 13px 15px;
      margin: 13px 0 22px 0;
      border: 1.7px solid #b0b8d1;
      border-radius: 12px;
      font-size: 1.15em;
      background: #f0f4fd;
      transition: border 0.2s, box-shadow 0.2s;
      box-shadow: 0 1px 4px rgba(34,46,80,0.04);
    }
    .login-input:focus {
      border: 2px solid #4a6cf7;
      outline: none;
      background: #fff;
      box-shadow: 0 2px 8px rgba(74,108,247,0.10);
    }
    .login-btn {
      background: linear-gradient(90deg, #4a6cf7 0%, #222e50 100%);
      color: #fff;
      border: none;
      border-radius: 12px;
      padding: 15px 48px;
      font-size: 1.15em;
      cursor: pointer;
      transition: transform 0.18s, box-shadow 0.18s, background 0.2s;
      margin-top: 12px;
      letter-spacing: 1px;
      font-weight: bold;
      box-shadow: 0 2px 8px rgba(74,108,247,0.10);
      position: relative;
      overflow: hidden;
    }
    .login-btn:hover {
      background: linear-gradient(90deg, #222e50 0%, #4a6cf7 100%);
      transform: translateY(-3px) scale(1.06) rotate(-1deg);
      box-shadow: 0 8px 24px 0 rgba(74,108,247,0.22);
    }
    .show-pass {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      margin-top: -12px;
      margin-bottom: 14px;
      font-size: 1em;
      color: #3a4a6b;
      cursor: pointer;
      user-select: none;
      transition: color 0.2s;
    }
    .show-pass:hover {
      color: #4a6cf7;
    }
    .show-pass input[type="checkbox"] {
      margin-left: 7px;
      accent-color: #4a6cf7;
      cursor: pointer;
    }
    .login-footer {
      margin-top: 32px;
      color: #888;
      font-size: 1em;
      letter-spacing: 0.5px;
      opacity: 0.8;
      animation: fadeIn 1.2s 0.5s backwards;
    }
    @media (max-width: 500px) {
      .login-container { padding: 18px 4vw; min-width: unset; }
      .login-logo { width: 54px; height: 54px; }
      .login-desc { font-size: 1em; }
      .login-btn { padding: 12px 24px; font-size: 1em; }
    }
  </style>
</head>
<body>
  <div class="archive-bg"></div>
  <div class="login-container" id="loginBox">
    <img class="login-logo" src="img/شعار_قناة_الرابعة.png" alt="شعار قانه الرابعة">
    <div class="login-desc">يرجى إدخال اسم المستخدم وكلمة المرور للمتابعة إلى الصفحة الرئيسية.</div>
    <?php if (!empty($error)): ?>
      <div style="color: red; margin-bottom: 15px;"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" autocomplete="off">
      
      <input class="login-input" type="text" name="username" placeholder="اسم المستخدم" required><br>
      <input class="login-input" type="password" name="password" id="password" placeholder="كلمة المرور" required><br>
      <label class="show-pass">
        <input type="checkbox" onclick="togglePassword()"> عرض كلمة المرور
      </label>
      <button class="login-btn" type="submit">دخول</button>
      <div>
        <a href="add_user.php">انشاء حساب</a>
      </div>
    </form>
    <div class="login-footer">
      &copy; 2024 قانه الرابعة
    </div>
  </div>
  <script>
    // حركة دخول النموذج
    window.addEventListener('DOMContentLoaded', function() {
      setTimeout(function() {
        document.getElementById('loginBox').style.opacity = 1;
        document.getElementById('loginBox').style.transform = 'translateY(0) scale(1)';
      }, 200);
    });
    // إظهار/إخفاء كلمة المرور
    function togglePassword() {
      var pass = document.getElementById("password");
      pass.type = pass.type === "password" ? "text" : "password";
    }
    // حركة اهتزاز إذا كان أحد الحقول فارغ عند الضغط على دخول
    document.querySelector('form').addEventListener('submit', function(e) {
      var user = document.querySelector('[name="username"]');
      var pass = document.querySelector('[name="password"]');
      if (!user.value || !pass.value) {
        e.preventDefault();
        document.getElementById('loginBox').style.animation = 'shake 0.4s';
        setTimeout(function(){
          document.getElementById('loginBox').style.animation = '';
        }, 400);
      }
    });
    // حركة اهتزاز
    const style = document.createElement('style');
    style.innerHTML = `
      @keyframes shake {
        0% { transform: translateX(0);}
        20% { transform: translateX(-10px);}
        40% { transform: translateX(10px);}
        60% { transform: translateX(-10px);}
        80% { transform: translateX(10px);}
        100% { transform: translateX(0);}
      }
    `;
    document.head.appendChild(style);
  </script>
</body>
</html>

<?php
// إغلاق الاتصال بقاعدة البيانات
if (isset($conn)) {
    $conn->close();
}
?>

