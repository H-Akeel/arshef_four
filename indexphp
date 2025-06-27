<?php
// بدء الجلسة حتى تعمل متغيرات $_SESSION
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// تعريف المتغيرات بناءً على الجلسة
$is_logged_in = isset($_SESSION['username']) && !empty($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
$can_edit = ($role === 'admin');
if (!isset($show_sports)) $show_sports = false;
if (!isset($show_stars)) $show_stars = false;

// الاتصال بقاعدة البيانات الخاصة بالأرقام
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'rap_dashboard';
$db_port = 3305;
$conn_numbers = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
if ($conn_numbers->connect_error) {
    die('<div style="color:red;text-align:center;">فشل الاتصال بقاعدة بيانات الأرقام: ' . $conn_numbers->connect_error . '</div>');
}

// جلب القيم الحالية من الجدول
$deqa_in = $deqa_out = $rabia_in = $rabia_out = $dk_in = $dk_out = 0;
$sql = "SELECT * FROM section_numbers LIMIT 1";
$result = $conn_numbers->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $deqa_in = (int)$row['deqa_in'];
    $deqa_out = (int)$row['deqa_out'];
    $rabia_in = (int)$row['rabia_in'];
    $rabia_out = (int)$row['rabia_out'];
    $dk_in = (int)$row['dk_in'];
    $dk_out = (int)$row['dk_out'];
}

// حفظ القيم عند الضغط على زر الحفظ (فقط للمدير)
if ($role === 'admin') {
    if (isset($_POST['save_deqa'])) {
        $deqa_in = isset($_POST['deqa_in']) ? (int)$_POST['deqa_in'] : 0;
        $deqa_out = isset($_POST['deqa_out']) ? (int)$_POST['deqa_out'] : 0;
        $sql = "UPDATE section_numbers SET deqa_in=$deqa_in, deqa_out=$deqa_out";
        $conn_numbers->query($sql);
    }
    if (isset($_POST['save_rabia'])) {
        $rabia_in = isset($_POST['rabia_in']) ? (int)$_POST['rabia_in'] : 0;
        $rabia_out = isset($_POST['rabia_out']) ? (int)$_POST['rabia_out'] : 0;
        $sql = "UPDATE section_numbers SET rabia_in=$rabia_in, rabia_out=$rabia_out";
        $conn_numbers->query($sql);
    }
    if (isset($_POST['save_dk'])) {
        $dk_in = isset($_POST['dk_in']) ? (int)$_POST['dk_in'] : 0;
        $dk_out = isset($_POST['dk_out']) ? (int)$_POST['dk_out'] : 0;
        $sql = "UPDATE section_numbers SET dk_in=$dk_in, dk_out=$dk_out";
        $conn_numbers->query($sql);
    }
    // إعادة جلب القيم بعد التحديث
    $result = $conn_numbers->query("SELECT * FROM section_numbers LIMIT 1");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $deqa_in = (int)$row['deqa_in'];
        $deqa_out = (int)$row['deqa_out'];
        $rabia_in = (int)$row['rabia_in'];
        $rabia_out = (int)$row['rabia_out'];
        $dk_in = (int)$row['dk_in'];
        $dk_out = (int)$row['dk_out'];
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الرئيسية | منصة الرابعة</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --main1: #4e54c8;   /* أزرق بنفسجي */
            --main2: #8f94fb;   /* أزرق فاتح */
            --accent: #ffb347;  /* برتقالي ذهبي */
            --danger: #e57373;  /* أحمر هادئ */
            --success: #43cea2; /* أخضر تركوازي */
            --white: #fff;
            --gray-bg: #f5f7fa;
        }
        body {
            font-family: 'Cairo', Tahoma, Arial, sans-serif;
            background: linear-gradient(135deg, var(--gray-bg) 0%, var(--main2) 100%);
            margin: 0;
            min-height: 100vh;
            color: #222;
        }
        header {
            background: linear-gradient(90deg, var(--main1) 0%, var(--main2) 100%);
            box-shadow: 0 2px 12px rgba(78, 84, 200, 0.08);
            padding: 0 0 8px 0;
            border-bottom-left-radius: 32px;
            border-bottom-right-radius: 32px;
        }
        .header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1100px;
            margin: 0 auto;
            padding: 12px 24px 0 24px;
        }
        .slo_img {
            height: 70px;
            width: auto;
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(78, 84, 200, 0.08);
            padding: 6px;
            margin: 0 0 0 12px;
        }
        .user-info-box {
            display: flex;
            align-items: center;
            gap: 18px;
            background: var(--white);
            border-radius: 12px;
            padding: 8px 18px;
            box-shadow: 0 1px 8px rgba(78, 84, 200, 0.08);
        }
        .username {
            font-weight: 700;
            color: var(--main1);
            font-size: 1.15em;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .user-icon {
            display: inline-flex;
            align-items: center;
            margin-left: 4px;
        }
        .role-inline {
            background: var(--main2);
            color: var(--main1);
            border-radius: 8px;
            padding: 2px 10px;
            font-size: 0.95em;
            margin-right: 8px;
            margin-left: 2px;
        }
        .logout-btn {
            background: linear-gradient(90deg, var(--main1) 0%, var(--main2) 100%);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 7px 18px;
            font-size: 1em;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            margin-right: 8px;
        }
        .logout-btn:hover {
            background: linear-gradient(90deg, var(--main2) 0%, var(--main1) 100%);
            color: var(--main1);
        }
        nav {
            background: var(--white);
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(78, 84, 200, 0.07);
            margin: 32px auto 18px auto;
            max-width: 900px;
            padding: 0 0 0 0;
            display: flex;
            justify-content: center;
        }
        nav ul {
            display: flex;
            gap: 0;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        nav li {
            margin: 0;
        }
        nav .tab-link {
            display: block;
            padding: 18px 38px;
            font-size: 1.15em;
            font-weight: 700;
            color: var(--main1);
            background: none;
            border: none;
            border-radius: 0;
            cursor: pointer;
            transition: background 0.18s, color 0.18s;
            text-decoration: none;
            position: relative;
        }
        nav .tab-link.active, nav .tab-link:hover {
            background: linear-gradient(90deg, var(--main2) 0%, var(--main1) 100%);
            color: var(--white);
            border-radius: 0 0 18px 18px;
        }
        main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 18px 40px 18px;
        }
        .alert {
            max-width: 600px;
            margin: 18px auto;
            padding: 14px 22px;
            border-radius: 12px;
            font-size: 1.08em;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(78, 84, 200, 0.07);
            text-align: center;
        }
        .alert-success {
            background: #e6f9f0;
            color: var(--success);
            border: 1.5px solid #b6e7d8;
        }
        .alert-error {
            background: #fff0f3;
            color: var(--danger);
            border: 1.5px solid #f8bbd0;
        }
        .data-table {
            background: var(--white);
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(78, 84, 200, 0.09);
            margin-bottom: 38px;
            padding: 28px 18px 18px 18px;
            display: none;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .data-table.visible {
            display: block;
            opacity: 1;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .data-table h2 {
            color: var(--main1);
            font-size: 1.45em;
            margin-bottom: 18px;
            text-align: center;
            letter-spacing: 1px;
        }
        .search-input {
            border-radius: 10px;
            border: 1.5px solid var(--main2);
            padding: 8px 16px;
            font-size: 1.08em;
            background: #f7fafd;
            transition: border 0.2s;
            width: 260px;
            margin-bottom: 8px;
        }
        .search-input:focus {
            border: 1.5px solid var(--main1);
            outline: none;
            background: #fff;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 8px rgba(78, 84, 200, 0.06);
        }
        th, td {
            padding: 13px 10px;
            text-align: center;
            font-size: 1.08em;
        }
        th {
            background: #f7fafd;
            color: var(--main1);
            font-weight: 700;
            border-bottom: 2px solid var(--main2);
        }
        tr:nth-child(even) td {
            background: #f0f3fa;
        }
        tr:hover td {
            background: #e3e7fa;
            transition: background 0.2s;
        }
        .file-link {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
            justify-content: center;
        }
        .file-link .upload-btn {
            background: linear-gradient(90deg, var(--main1) 0%, var(--main2) 100%);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 5px 16px;
            font-size: 0.98em;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            font-weight: 700;
        }
        .file-link .upload-btn:hover {
            background: linear-gradient(90deg, var(--main2) 0%, var(--main1) 100%);
            color: var(--main1);
        }
        .file-size {
            color: var(--main1);
            font-size: 0.95em;
            margin-right: 4px;
        }
        .upload-form {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 8px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .upload-form input[type="text"] {
            font-size: 0.97em;
            padding: 5px 10px;
            border-radius: 8px;
            border: 1px solid #b3c6e0;
            width: 120px;
            background: #f7fafd;
            transition: border 0.2s;
        }
        .upload-form input[type="text"]:focus {
            border: 1.5px solid var(--main1);
            outline: none;
        }
        .upload-form input[type="file"] {
            display: none;
        }
        .upload-form label.upload-file-label {
            background: linear-gradient(90deg, var(--main2) 0%, var(--main1) 100%);
            color: var(--white);
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.97em;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .upload-form label.upload-file-label:hover {
            background: linear-gradient(90deg, var(--main1) 0%, var(--main2) 100%);
        }
        .upload-form .upload-btn {
            font-size: 0.97em;
            padding: 6px 14px;
            border-radius: 8px;
            margin-bottom: 0;
            background: linear-gradient(90deg, var(--main1) 0%, var(--main2) 100%);
            color: var(--white);
            border: none;
            font-weight: 700;
            transition: background 0.2s;
        }
        .upload-form .upload-btn:last-child {
            background: #eee;
            color: var(--main1);
            border: 1px solid var(--main2);
        }
        .upload-form .upload-btn:last-child:hover {
            background: #fbeaf4;
            color: var(--main1);
        }
        #toTopBtn {
            position: fixed;
            bottom: 32px;
            left: 32px;
            z-index: 99;
            background: linear-gradient(90deg, var(--main1) 0%, var(--main2) 100%);
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            font-size: 1.5em;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(78, 84, 200, 0.13);
            display: none;
            transition: background 0.2s;
        }
        #toTopBtn:hover {
            background: linear-gradient(90deg, var(--main2) 0%, var(--main1) 100%);
            color: var(--main1);
        }
        footer {
            text-align: center;
            padding: 24px 0 18px 0;
            background: var(--white);
            margin-top: 40px;
            color: var(--main1);
            font-size: 1.08em;
            border-top-left-radius: 32px;
            border-top-right-radius: 32px;
            box-shadow: 0 -2px 12px rgba(78, 84, 200, 0.07);
            letter-spacing: 1px;
        }
        .main-hero {
            background: linear-gradient(120deg, #ffb347 0%, var(--main2) 50%, var(--success) 100%);
            color: #fff;
            padding: 60px 24px;
            border-radius: 18px;
            box-shadow: 0 2px 24px rgba(78,84,200,0.13);
            margin: 32px auto;
            max-width: 900px;
            text-align: center;
        }
        .main-hero h1 {
            font-size: 2.5em;
            margin-bottom: 12px;
            letter-spacing: 1px;
        }
        .main-hero p {
            font-size: 1.15em;
            margin-bottom: 24px;
            line-height: 1.4;
        }
        .main-btn {
            display: inline-block;
            padding: 12px 28px;
            font-size: 1.1em;
            font-weight: 700;
            color: var(--white);
            background: linear-gradient(90deg, var(--main1) 0%, var(--main2) 100%);
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.2s;
        }
        .main-btn:hover {
            background: linear-gradient(90deg, var(--main2) 0%, var(--main1) 100%);
            color: var(--main1);
        }
        .section-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
            margin: 0 auto;
            max-width: 1100px;
            padding: 0 18px;
        }
        .card {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(78, 84, 200, 0.07);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 16px rgba(78, 84, 200, 0.1);
        }
        @media (max-width: 800px) {
            .header-flex, main { max-width: 98vw; padding: 0 4vw; }
            nav { max-width: 98vw; }
            .data-table { padding: 18px 4vw 12px 4vw; }
            table th, table td { font-size: 0.98em; }
            nav .tab-link { padding: 12px 10vw; font-size: 1em; }
        }
        @media (max-width: 500px) {
            .header-flex { flex-direction: column; gap: 10px; }
            .user-info-box { flex-direction: column; gap: 6px; }
            nav .tab-link { padding: 10px 4vw; font-size: 0.98em; }
            .data-table h2 { font-size: 1.1em; }
            .search-input { width: 98vw; }
            .main-hero h1 { font-size: 2em; }
            .main-hero p { font-size: 1em; }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-flex">
            <img class="slo_img" src="img/شعار_قناة_الرابعة.png" alt="شعار قناة الرابعة" style="height:60px;width:auto;object-fit:contain;display:block;margin-top:8px;margin-bottom:8px;box-shadow:0 1px 4px rgba(0,0,0,0.08);background:#fff;border-radius:12px;padding:4px;">
            <div class="user-info-box">
                <span class="username">
                    <span class="user-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <circle cx="10" cy="7" r="4" fill="#fff" fill-opacity="0.7"/>
                            <ellipse cx="10" cy="15.2" rx="6.5" ry="3.2" fill="#fff" fill-opacity="0.4"/>
                        </svg>
                    </span>
                    <?php echo $is_logged_in ? 'مرحباً، ' . htmlspecialchars($username) : 'مرحباً بك في منصة الرابعة'; ?>
                </span>
                <?php if ($is_logged_in): ?>
                    <a href="index2.php" class="logout-btn">لوحة التحكم</a>
                <?php else: ?>
                    <a href="login.php" class="main-btn login">تسجيل الدخول</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main>
        <section class="main-hero">
            <h1>منصة الرابعة</h1>
            <p>
                منصة متكاملة لإدارة أقسام قناة الرابعة: الذكاء الإبداعي، تطبيق هسه، دقة الفكرة، موظفي الرابعة، الرابعة الرياضية، نجوم الرابعة.<br>
                استكشف الأقسام، أضف وحرر البيانات، وكن جزءاً من التميز المؤسسي.
            </p>
            <?php if ($is_logged_in): ?>
                <a href="index2.php" class="main-btn">دخول لوحة التحكم</a>
            <?php else: ?>
                <a href="login.php" class="main-btn login">تسجيل الدخول</a>
            <?php endif; ?>
        </section>
        <section class="section-cards">
            <!-- صناديق الأرقام للأقسام المطلوبة -->
            <div style="display: flex; flex-wrap: wrap; gap: 18px; justify-content: center; margin-bottom: 24px;">
                <!-- دقة الفكرة -->
                <div style="background: var(--white); border-radius: 10px; box-shadow: 0 1px 8px rgba(78,84,200,0.08); padding: 16px 18px; min-width: 170px; text-align: center;">
                    <div style="font-weight:700; color:var(--main1); margin-bottom:6px;">دقة الفكرة</div>
                    <form method="post" style="display:flex; flex-direction:column; gap:8px; align-items:center;" autocomplete="off">
                        <div style="display:flex; gap:8px; align-items:center;">
                            <label style="font-size:0.98em; color:var(--main2);">الداخل</label>
                            <input type="number" name="deqa_in" min="0" value="<?php echo isset($_POST['deqa_in']) ? (int)$_POST['deqa_in'] : (isset($deqa_in) ? (int)$deqa_in : 0); ?>" style="width:60px; text-align:center; border-radius:8px; border:1.5px solid var(--main2); padding:4px 0; font-size:1.1em;" <?php if($role!=='admin') echo 'readonly'; ?>>
                            <label style="font-size:0.98em; color:var(--main2);">الخارج</label>
                            <input type="number" name="deqa_out" min="0" value="<?php echo isset($_POST['deqa_out']) ? (int)$_POST['deqa_out'] : (isset($deqa_out) ? (int)$deqa_out : 0); ?>" style="width:60px; text-align:center; border-radius:8px; border:1.5px solid var(--main2); padding:4px 0; font-size:1.1em;" <?php if($role!=='admin') echo 'readonly'; ?>>
                        </div>
                        <?php if($role==='admin'): ?>
                        <button type="submit" name="save_deqa" style="margin-top:6px; background:var(--success); color:#fff; border:none; border-radius:7px; padding:5px 0; font-weight:700; width:100px;">حفظ</button>
                        <?php endif; ?>
                    </form>
                </div>
                <!-- الرابعة -->
                <div style="background: var(--white); border-radius: 10px; box-shadow: 0 1px 8px rgba(78,84,200,0.08); padding: 16px 18px; min-width: 170px; text-align: center;">
                    <div style="font-weight:700; color:var(--main1); margin-bottom:6px;">الرابعة</div>
                    <form method="post" style="display:flex; flex-direction:column; gap:8px; align-items:center;" autocomplete="off">
                        <div style="display:flex; gap:8px; align-items:center;">
                            <label style="font-size:0.98em; color:var(--main2);">الداخل</label>
                            <input type="number" name="rabia_in" min="0" value="<?php echo isset($_POST['rabia_in']) ? (int)$_POST['rabia_in'] : (isset($rabia_in) ? (int)$rabia_in : 0); ?>" style="width:60px; text-align:center; border-radius:8px; border:1.5px solid var(--main2); padding:4px 0; font-size:1.1em;" <?php if($role!=='admin') echo 'readonly'; ?>>
                            <label style="font-size:0.98em; color:var(--main2);">الخارج</label>
                            <input type="number" name="rabia_out" min="0" value="<?php echo isset($_POST['rabia_out']) ? (int)$_POST['rabia_out'] : (isset($rabia_out) ? (int)$rabia_out : 0); ?>" style="width:60px; text-align:center; border-radius:8px; border:1.5px solid var(--main2); padding:4px 0; font-size:1.1em;" <?php if($role!=='admin') echo 'readonly'; ?>>
                        </div>
                        <?php if($role==='admin'): ?>
                        <button type="submit" name="save_rabia" style="margin-top:6px; background:var(--success); color:#fff; border:none; border-radius:7px; padding:5px 0; font-weight:700; width:100px;">حفظ</button>
                        <?php endif; ?>
                    </form>
                </div>
                <!-- الذكاء الإبداعي -->
                <div style="background: var(--white); border-radius: 10px; box-shadow: 0 1px 8px rgba(78,84,200,0.08); padding: 16px 18px; min-width: 170px; text-align: center;">
                    <div style="font-weight:700; color:var(--main1); margin-bottom:6px;">الذكاء الإبداعي</div>
                    <form method="post" style="display:flex; flex-direction:column; gap:8px; align-items:center;" autocomplete="off">
                        <div style="display:flex; gap:8px; align-items:center;">
                            <label style="font-size:0.98em; color:var(--main2);">الداخل</label>
                            <input type="number" name="dk_in" min="0" value="<?php echo isset($_POST['dk_in']) ? (int)$_POST['dk_in'] : (isset($dk_in) ? (int)$dk_in : 0); ?>" style="width:60px; text-align:center; border-radius:8px; border:1.5px solid var(--main2); padding:4px 0; font-size:1.1em;" <?php if($role!=='admin') echo 'readonly'; ?>>
                            <label style="font-size:0.98em; color:var(--main2);">الخارج</label>
                            <input type="number" name="dk_out" min="0" value="<?php echo isset($_POST['dk_out']) ? (int)$_POST['dk_out'] : (isset($dk_out) ? (int)$dk_out : 0); ?>" style="width:60px; text-align:center; border-radius:8px; border:1.5px solid var(--main2); padding:4px 0; font-size:1.1em;" <?php if($role!=='admin') echo 'readonly'; ?>>
                        </div>
                        <?php if($role==='admin'): ?>
                        <button type="submit" name="save_dk" style="margin-top:6px; background:var(--success); color:#fff; border:none; border-radius:7px; padding:5px 0; font-weight:700; width:100px;">حفظ</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <div class="card">
                <h3>الذكاء الإبداعي</h3>
                <p>إدارة كتب الذكاء الإبداعي، الإضافة والتعديل والحذف بسهولة.</p>
                <a href="<?php echo $is_logged_in ? 'index2.php' : 'login.php'; ?>" class="main-btn"<?php if (!$is_logged_in) echo ' style=\"pointer-events:none;opacity:0.5;\"'; ?>>عرض القسم</a>
            </div>
            <div class="card">
                <h3>تطبيق هسه</h3>
                <p>سجّل بيانات تطبيق هسه وتابع كل جديد في القسم.</p>
                <a href="<?php echo $is_logged_in ? 'index2.php' : 'login.php'; ?>" class="main-btn"<?php if (!$is_logged_in) echo ' style=\"pointer-events:none;opacity:0.5;\"'; ?>>عرض القسم</a>
            </div>
            <div class="card">
                <h3>دقة الفكرة</h3>
                <p>أضف وتابع كتب دقة الفكرة وحرر بياناتها.</p>
                <a href="<?php echo $is_logged_in ? 'index2.php' : 'login.php'; ?>" class="main-btn"<?php if (!$is_logged_in) echo ' style=\"pointer-events:none;opacity:0.5;\"'; ?>>عرض القسم</a>
            </div>
            <div class="card">
                <h3>موظفي الرابعة</h3>
                <p>إدارة بيانات الموظفين والمباشرة والمسمى الوظيفي.</p>
                <a href="<?php echo $is_logged_in ? 'index2.php' : 'login.php'; ?>" class="main-btn"<?php if (!$is_logged_in) echo ' style=\"pointer-events:none;opacity:0.5;\"'; ?>>عرض القسم</a>
            </div>
            <div class="card">
                <h3>الرابعة الرياضية</h3>
                <p>سجّل كتب الرابعة الرياضية وتابع كل جديد.</p>
                <a href="<?php echo $is_logged_in ? 'index2.php' : 'login.php'; ?>" class="main-btn"<?php if (!$is_logged_in) echo ' style=\"pointer-events:none;opacity:0.5;\"'; ?>>عرض القسم</a>
            </div>
            <div class="card">
                <h3>نجوم الرابعة</h3>
                <p>إدارة بيانات وكتب نجوم الرابعة بكل سهولة.</p>
                <a href="<?php echo $is_logged_in ? 'index2.php' : 'login.php'; ?>" class="main-btn"<?php if (!$is_logged_in) echo ' style=\"pointer-events:none;opacity:0.5;\"'; ?>>عرض القسم</a>
            </div>
        </section>

        <?php if ($show_sports): ?>
            <section>
                <h2>قسم الرياضة</h2>
                <!-- محتوى القسم -->
                <?php if ($can_edit): ?>
                    <button>تعديل</button>
                    <button>حذف</button>
                    <button>إضافة</button>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php if ($show_stars): ?>
            <section>
                <h2>قسم نجوم الرابعة</h2>
                <!-- محتوى القسم -->
                <?php if ($can_edit): ?>
                    <button>تعديل</button>
                    <button>حذف</button>
                    <button>إضافة</button>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <section>
            <h2>قسم آخر (مثال)</h2>
            <!-- محتوى القسم الآخر -->
            <?php if ($can_edit): ?>
                <button>تعديل</button>
                <button>حذف</button>
                <button>إضافة</button>
            <?php endif; ?>
        </section>
    </main>
    <footer style="text-align: center; padding: 20px; background: #f8f9fa; margin-top: 30px;">
        جميع الحقوق محفوظة &copy; <?= date('Y') ?>
    </footer>
</body>
</html>
