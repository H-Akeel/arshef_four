<?php
// بدء الجلسة بشكل آمن (يجب أن يكون أول الملف)
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'read_and_close'  => false,
    ]);
}

include 'conacted_db.php';


// تعريف متغيرات الجلسة بشكل صحيح
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
$username = $_SESSION['username'];
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';

$can_edit = ($role === 'admin');
$show_sports = ($role === 'admin' || $role === 'sports' || $role === 'user');
$show_stars = ($role === 'admin' || $role === 'stars' || $role === 'user');
$show_all = ($role === 'admin' || $role === 'user');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <link rel="icon" type="image/png" href="favicon.png">
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
                <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>
                <span class="role-inline"><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?></span>
            </span>
            <a href="logout.php" class="logout-btn">تسجيل الخروج</a>
        </div>
    </div>
</header>

<main>
    <!-- واجهة ترحيبية ديناميكية -->
    <section id="welcome-section" style="background: linear-gradient(120deg, #ffb347 0%, var(--main2) 50%, var(--success) 100%); color: #fff; border-radius: 18px; box-shadow: 0 2px 24px rgba(78,84,200,0.13); margin: 32px auto 38px auto; max-width: 900px; padding: 36px 24px 30px 24px; text-align: center; position: relative; overflow: hidden; border: 2.5px solid var(--main1);">
        <svg width="120" height="120" viewBox="0 0 120 120" fill="none" style="position:absolute;left:24px;top:18px;opacity:0.10;z-index:0;">
            <circle cx="60" cy="60" r="60" fill="#fff"/>
        </svg>
        <div style="position:relative;z-index:1;">
            <h1 style="font-size:2.1em;margin-bottom:10px;letter-spacing:1px;">
                <?php
                if ($role === 'admin') {
                    echo "👋 أهلاً بك أيها المدير " . htmlspecialchars($username);
                } elseif ($role === 'viewer') {
                    echo "👋 مرحباً بك ضيفنا الكريم";
                } else {
                    echo "👋 أهلاً بك " . htmlspecialchars($username);
                }
                ?>
            </h1>
            <p style="font-size:1.15em;margin-bottom:0;">
                <?= ($role === 'admin')
                    ? "يمكنك إدارة البيانات ورفع الملفات ومتابعة كل جديد في لوحة التحكم."
                    : (($role === 'viewer')
                        ? "استعرض البيانات وتابع آخر الملفات المضافة في أقسام الموقع."
                        : "نتمنى لك يوماً سعيداً وتجربة رائعة في لوحة التحكم."); ?>
            </p>
            <div style="margin-top:22px;">
                <?php
                function arabicDay($en) {
                    $days = [
                        'Saturday' => 'السبت',
                        'Sunday' => 'الأحد',
                        'Monday' => 'الإثنين',
                        'Tuesday' => 'الثلاثاء',
                        'Wednesday' => 'الأربعاء',
                        'Thursday' => 'الخميس',
                        'Friday' => 'الجمعة'
                    ];
                    return $days[$en] ?? $en;
                }

                function arabicMonth($en) {
                    $months = [
                        'January' => 'يناير',
                        'February' => 'فبراير',
                        'March' => 'مارس',
                        'April' => 'إبريل',
                        'May' => 'مايو',
                        'June' => 'يونيو',
                        'July' => 'يوليو',
                        'August' => 'أغسطس',
                        'September' => 'سبتمبر',
                        'October' => 'أكتوبر',
                        'November' => 'نوفمبر',
                        'December' => 'ديسمبر'
                    ];
                    return $months[$en] ?? $en;
                }

                $day_ar = arabicDay(date('l'));
                $month_ar = arabicMonth(date('F'));
                $date_ar = $day_ar . ' ' . date('d') . ' ' . $month_ar . ' ' . date('Y');

                $h = date('g');
                $m = date('i');
                $ampm = date('a') === 'am' ? 'صباحاً' : 'مساءً';
                $time_ar = $h . ':' . $m . ' ' . $ampm;
                ?>
                <span style="display:inline-block;background:var(--white);color:var(--main1);padding:7px 22px;border-radius:12px;font-size:1.08em;font-weight:700;box-shadow:0 2px 8px rgba(78,84,200,0.07);letter-spacing:1px;">
                    <?= $date_ar ?> | <?= $time_ar ?>
                </span>
            </div>
        </div>
    </section>
    <?php if (isset($_SESSION['upload_success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['upload_success']) ?></div>
        <?php unset($_SESSION['upload_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['upload_error'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($_SESSION['upload_error']) ?></div>
        <?php unset($_SESSION['upload_error']); ?>
    <?php endif; ?>
    <nav>
        <ul>
            <li><a href="#" class="tab-link" data-target="dk-table">الذكاء الإبداعي</a></li>
            <li><a href="#" class="tab-link" data-target="hessa-table">تطبيق هسه</a></li>
            <li><a href="#" class="tab-link" data-target="deqa-table">دقة الفكرة</a></li>
            <li><a href="#" class="tab-link" data-target="emp-table">موظفي الرابعة</a></li>
            <li><a href="#" class="tab-link" data-target="sport-table">الرابعة الرياضية</a></li>
            <li><a href="#" class="tab-link" data-target="star-table">نجوم الرابعة</a></li>
        </ul>
    </nav>
    <!-- قسم الذكاء الإبداعي -->
     <?php if ($role== 'admin' || $role == 'user'): ?> 
    <div id="dk-table" class="data-table" style="display:none;">
        <h2>الذكاء الإبداعي</h2>
        <input type="text" class="search-input" placeholder="بحث في الجدول..." onkeyup="filterTableRows(this, 'dk-table')">
        <?php if ($role== 'admin'): ?>
        <form method="POST" action="insert_all.php">
            <input type="hidden" name="type" value="creative">
            <label>عنوان الكتاب</label>
            <input type="text" name="book_title" placeholder="عنوان الكتاب">
            <br>
            <label>تاريخ الكتاب</label>
            <input type="text" name="book_date" placeholder="تاريخ الكتاب">
            <br>
            <label>رقم الكتاب</label>
            <input type="text" name="book_number" placeholder="رقم الكتاب">
            <br>
            <label>موضوع الكتاب</label>
            <input type="text" name="book_subject" placeholder="موضوع الكتاب">
            <br>
            <input type="submit" value="إضافة" name="add_book" class="upload-btn" style="background:var(--success);color:#fff;">
        </form>
        <?php endif; ?>
        

        <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>عنوان الكتاب</th>
                    <th>تاريخ الكتاب</th>
                    <th>رقم الكتاب</th>
                    <th>موضوع الكتاب</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
<?php
include 'conacted_db.php';
$query = mysqli_query($conn_intell, "SELECT * FROM intelligene_tp");
while ($row = mysqli_fetch_array($query)) {
?>
    <!-- الصف الرئيسي -->
    <tr>
        <td><?php echo $row["ID"]; ?></td>
        <td><?php echo $row['book_title']; ?></td>
        <td><?php echo $row['book_date']; ?></td>
        <td><?php echo $row['book_number']; ?></td>
        <td><?php echo $row['book_subject']; ?></td>
        <td>
            <button type="button" onclick="toggleEditRow(<?php echo $row['ID']; ?>)">تعديل</button>
        </td>
        <td>
            <a href="delete_all.php?type=creative&id=<?php echo $row['ID']; ?>" class="upload-btn" onclick='return confirm("هل أنت متأكد من الحذف؟")' style="background:var(--danger);color:#fff;">حذف</a>
        </td>
    </tr>

    <!-- صف نموذج التعديل المخفي -->
    <tr id="edit-row-<?php echo $row['ID']; ?>" style="display:none; background:#fdfdfd;">
        <td colspan="7">
            <form method="POST" action="update_ajax.php" style="display: flex; gap: 8px; align-items: center;">
                <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                <input type="hidden" name="type" value="creative">
                <input type="text" name="book_title" value="<?php echo htmlspecialchars($row['book_title']); ?>">
                <input type="text" name="book_date" value="<?php echo htmlspecialchars($row['book_date']); ?>">
                <input type="text" name="book_number" value="<?php echo htmlspecialchars($row['book_number']); ?>">
                <input type="text" name="book_subject" value="<?php echo htmlspecialchars($row['book_subject']); ?>">
                <button type="submit">💾 حفظ</button>
                <button type="button" onclick="toggleEditRow(<?php echo $row['ID']; ?>)">❌ إلغاء</button>
            </form>
        </td>
    </tr>
<?php 
}
?>
</tbody>

        </table>
    </div>
    <?php endif; ?>

    <!-- قسم تطبيق هسه -->
    <?php if ($role== 'admin' || $role == 'user'): ?>
    <div id="hessa-table" class="data-table" style="display:none;">
        <h2>تطبيق هسه</h2>
        <input type="text" class="search-input" placeholder="بحث في الجدول..." onkeyup="filterTableRows(this, 'hessa-table')">
        <?php if ($role== 'admin'): ?>
        <form method="POST" action="insert_all.php">
            <input type="hidden" name="type" value="hessa">
            <label>اسم الموظف</label>
            <input type="text" name="emp_name" placeholder="اسم الموظف">
            <br>
            <label>تاريخ البداية</label>
            <input type="text" name="start_date" placeholder="تاريخ البداية">
            <br>
            <label>القسم</label>
            <input type="text" name="depart" placeholder="القسم">
            <br>
            <label>الصفة</label>
            <input type="text" name="charact" placeholder="الصفة">
            <br>
            <label>أمر التعيين</label>
            <input type="text" name="appo_order" placeholder="أمر التعيين">
            <br>
            <label>رقم الكتاب</label>
            <input type="text" name="book_num" placeholder="رقم الكتاب">
            <br>
            <input type="submit" value="إضافة" name="add_hessa" class="upload-btn" style="background:var(--success);color:#fff;">
        </form>
        <?php endif; ?>
        <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>اسم الموظف</th>
                    <th>تاريخ البداية</th>
                    <th>القسم</th>
                    <th>الصفة</th>
                    <th>أمر التعيين</th>
                    <th>رقم الكتاب</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // استخدام الاتصال من conacted_db.php مباشرة
                if (isset($conn_hessa) && $conn_hessa) {
                    $query = mysqli_query($conn_hessa, "SELECT * FROM app_tp");
                    if ($query && mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $row["ID"]; ?></td>
                    <td><?php echo $row['emp_name']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['depart']; ?></td>
                    <td><?php echo $row['charact']; ?></td>
                    <td><?php echo $row['appo_order']; ?></td>
                    <td><?php echo $row['book_num']; ?></td>
                    <td><a href="edit_all.php?type=hessa&id=<?php echo $row['ID']; ?>" class="upload-btn">تعديل</a></td>
                    <td><a href="delete_all.php?type=hessa&id=<?php echo $row['ID']; ?>" class="upload-btn" onclick='return confirm("هل أنت متأكد من الحذف؟")' style="background:var(--danger);color:#fff;">حذف</a></td>
                </tr>
                <?php 
                        }
                    } else {
                        echo '<tr><td colspan="9" style="color:gray;">لا توجد بيانات لعرضها في هذا القسم.</td></tr>';
                    }
                } else {
                    echo '<tr><td colspan="9" style="color:red;">فشل الاتصال بقاعدة بيانات تطبيق هسه.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- قسم  دقة الفكرة -->
    <?php if ($role== 'admin' || $role == 'user'): ?>          
    <div id="deqa-table" class="data-table" style="display:none;">
        <h2>دقة الفكرة</h2>
        <input type="text" class="search-input" placeholder="بحث في الجدول..." onkeyup="filterTableRows(this, 'deqa-table')">
        <?php if ($role== 'admin'): ?>
        <form method="POST" action="insert_all.php">
            <input type="hidden" name="type" value="idea">
            <label>اسم الكتاب</label>
            <input type="text" name="book_name" placeholder="اسم الكتاب">
            <br>
            <label>رقم الكتاب</label>
            <input type="text" name="book_num" placeholder="رقم الكتاب">
            <br>
            <label>تاريخ الكتاب</label>
            <input type="text" name="book_date" placeholder="تاريخ الكتاب">
            <br>
            <input type="submit" value="إضافة" name="add_idea" class="upload-btn" style="background:var(--success);color:#fff;">
        </form>
        <?php endif; ?>
        <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>اسم الكتاب</th>
                    <th>رقم الكتاب</th>
                    <th>تاريخ الكتاب</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // استخدام الاتصال من conacted_db.php مباشرة
                if (isset($conn_idea) && $conn_idea) {
                    $query_idea = mysqli_query($conn_idea, "SELECT * FROM idea_tp");
                    if ($query_idea && mysqli_num_rows($query_idea) > 0) {
                        while($row = mysqli_fetch_array($query_idea)){
                ?>
                <tr>
                    <td><?php echo $row["ID"]; ?></td>
                    <td><?php echo $row['book_name']; ?></td>
                    <td><?php echo $row['book_num']; ?></td>
                    <td><?php echo $row['book_date']; ?></td>
                    <td><a href="edit_all.php?type=idea&id=<?php echo $row['ID']; ?>" class="upload-btn">تعديل</a></td>
                    <td><a href="delete_all.php?type=idea&id=<?php echo $row['ID']; ?>" class="upload-btn" onclick='return confirm("هل أنت متأكد من الحذف؟")' style="background:var(--danger);color:#fff;">حذف</a></td>
                </tr>
                <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" style="color:gray;">لا توجد بيانات لعرضها في هذا القسم.</td></tr>';
                    }
                } else {
                    echo '<tr><td colspan="6" style="color:red;">فشل الاتصال بقاعدة بيانات دقة الفكرة.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- قسم موظفي الرابعة -->
     <?php if ($role== 'admin' || $role == 'user'): ?>
    <div id="emp-table" class="data-table" style="display:none;">
        <h2>موظفي الرابعة</h2>
        <input type="text" class="search-input" placeholder="بحث في الجدول..." onkeyup="filterTableRows(this, 'emp-table')">
        <?php if ($role== 'admin'): ?>
        <form method="POST" action="insert_all.php">
            <input type="hidden" name="type" value="emp">
            <label>اسم الموظف</label>
            <input type="text" name="emp_name" placeholder="اسم الموظف">
            <br>
            <label>المسمى الوظيفي</label>
            <input type="text" name="jop_title" placeholder="المسمى الوظيفي">
            <br>
            <label>تاريخ المباشرة</label>
            <input type="text" name="start_date" placeholder="تاريخ المباشرة">
            <br>
            <input type="submit" value="إضافة" name="add_emp" class="upload-btn" style="background:var(--success);color:#fff;">
        </form>
        <?php endif; ?>
        <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>اسم الموظف</th>
                    <th>المسمى الوظيفي</th>
                    <th>تاريخ المباشرة</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn_emp = mysqli_connect("localhost", "root", "", "rap_emp", "3305");
                if ($conn_emp) {
                    $query_emp = mysqli_query($conn_emp, "SELECT * FROM emp_tp");
                    while($row = mysqli_fetch_array($query_emp)){
                ?>
                <tr>
                    <td><?php echo $row["ID"]; ?></td>
                    <td><?php echo $row['emp_name']; ?></td>
                    <td><?php echo $row['jop_title']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><a href="edit_all.php?type=emp&id=<?php echo $row['ID']; ?>" class="upload-btn">تعديل</a></td>
                    <td><a href="delete_all.php?type=emp&id=<?php echo $row['ID']; ?>" class="upload-btn" onclick='return confirm("هل أنت متأكد من الحذف؟")' style="background:var(--danger);color:#fff;">حذف</a></td>
                </tr>
                <?php
                    }
                    mysqli_close($conn_emp);
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- قسم الرابعه الرياضية -->
     <?php if ($role!== 'star_emp'): ?>
    <div id="sport-table" class="data-table" style="display:none;">
        <h2>الرابعة الرياضية</h2>
        <input type="text" class="search-input" placeholder="بحث في الجدول..." onkeyup="filterTableRows(this, 'sport-table')">
        <?php if ($role!== 'user'): ?>

        <form method="POST" action="insert_all.php">
            <input type="hidden" name="type" value="sport">
            <label>عنوان الكتاب</label>
            <input type="text" name="book_title" placeholder="عنوان الكتاب">
            <br>
            <label>تاريخ الكتاب</label>
            <input type="text" name="book_date" placeholder="تاريخ الكتاب">
            <br>
            <label>رقم الكتاب</label>
            <input type="text" name="book_number" placeholder="رقم الكتاب">
            <br>
            <label>موضوع الكتاب</label>
            <input type="text" name="book_subject" placeholder="موضوع الكتاب">
            <br>
            <input type="submit" value="إضافة" name="add_sport" class="upload-btn" style="background:var(--success);color:#fff;">
        </form>
        <?php endif; ?>
        <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>عنوان الكتاب</th>
                    <th>تاريخ الكتاب</th>
                    <th>رقم الكتاب</th>
                    <th>موضوع الكتاب</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn_sport = mysqli_connect("localhost", "root", "", "rap_sport", "3305");
                if ($conn_sport) {
                    $query_sport = mysqli_query($conn_sport, "SELECT * FROM sport_tp");
                    while($row = mysqli_fetch_array($query_sport)){
                ?>
                <tr>
                    <td><?php echo $row["ID"]; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['book_date']; ?></td>
                    <td><?php echo $row['book_number']; ?></td>
                    <td><?php echo $row['book_subject']; ?></td>
                    <td><a href="edit_all.php?type=sport&id=<?php echo $row['ID']; ?>" class="upload-btn">تعديل</a></td>
                    <td><a href="delete_all.php?type=sport&id=<?php echo $row['ID']; ?>" class="upload-btn" onclick='return confirm("هل أنت متأكد من الحذف؟")' style="background:var(--danger);color:#fff;">حذف</a></td>
                </tr>
                <?php
                    }
                    mysqli_close($conn_sport);
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- قسم نجوم الرابعة -->
     <?php if ($role!== 'sport_emp'): ?>
    <div id="star-table" class="data-table" style="display:none;">
        <h2>نجوم الرابعة</h2>
        <input type="text" class="search-input" placeholder="بحث في الجدول..." onkeyup="filterTableRows(this, 'star-table')">
        <?php if ($role!== 'user'): ?>

        <form method="POST" action="insert_all.php">
            <input type="hidden" name="type" value="star">
            <label>عنوان الكتاب</label>
            <input type="text" name="book_title" placeholder="عنوان الكتاب">
            <br>
            <label>تاريخ الكتاب</label>
            <input type="text" name="book_date" placeholder="تاريخ الكتاب">
            <br>
            <label>رقم الكتاب</label>
            <input type="text" name="book_number" placeholder="رقم الكتاب">
            <br>
            <label>موضوع الكتاب</label>
            <input type="text" name="book_subject" placeholder="موضوع الكتاب">
            <br>
            <input type="submit" value="إضافة" name="add_star" class="upload-btn" style="background:var(--success);color:#fff;">
        </form>
        <?php endif; ?>
        <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>عنوان الكتاب</th>
                    <th>تاريخ الكتاب</th>
                    <th>رقم الكتاب</th>
                    <th>موضوع الكتاب</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn_star = mysqli_connect("localhost", "root", "", "rap_star", "3305");
                if ($conn_star) {
                    $query_star = mysqli_query($conn_star, "SELECT * FROM star_tp");
                    while($row = mysqli_fetch_array($query_star)){
                ?>
                <tr>
                    <td><?php echo $row["ID"]; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['book_date']; ?></td>
                    <td><?php echo $row['book_number']; ?></td>
                    <td><?php echo $row['book_subject']; ?></td>
                    <td><a href="edit_all.php?type=star&id=<?php echo $row['ID']; ?>" class="upload-btn">تعديل</a></td>
                    <td><a href="delete_all.php?type=star&id=<?php echo $row['ID']; ?>" class="upload-btn" onclick='return confirm("هل أنت متأكد من الحذف؟")' style="background:var(--danger);color:#fff;">حذف</a></td>
                </tr>
                <?php
                    }
                    mysqli_close($conn_star);
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
 </main>

<button onclick="topFunction()" id="toTopBtn" title="العودة للأعلى">↑</button>


<footer style="text-align: center; padding: 20px; background: #f8f9fa; margin-top: 30px;">
    جميع الحقوق محفوظة &copy; <?= date('Y') ?>
</footer>

<script>
    function toggleEditRow(id) {
    const row = document.getElementById('edit-row-' + id);
    if (row.style.display === 'none') {
        row.style.display = 'table-row';
    } else {
        row.style.display = 'none';
    }
}
// زر العودة للأعلى
document.addEventListener('DOMContentLoaded', function () {
    const toTopBtn = document.getElementById('toTopBtn');
    if (toTopBtn) {
        window.onscroll = function () {
            toTopBtn.style.display = (window.scrollY > 200) ? 'block' : 'none';
        };
        toTopBtn.onclick = function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
    }

    // التبويبات
    const tabs = document.querySelectorAll('.tab-link');
    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const targetTable = document.getElementById(targetId);
            // إخفاء كل الجداول
            document.querySelectorAll('.data-table').forEach(table => {
                table.classList.remove('visible');
                table.style.display = 'none';
            });
            tabs.forEach(t => t.classList.remove('active'));
            // تفعيل التبويب
            this.classList.add('active');
            if (targetTable) {
                targetTable.style.display = 'block';
                setTimeout(() => targetTable.classList.add('visible'), 10);
                sessionStorage.setItem('activeSection', targetId);
            }
        });
    });
    // تفعيل التبويب النشط
    const active = sessionStorage.getItem('activeSection');
    const firstTab = document.querySelector('.tab-link');
    if (active) {
        const tab = document.querySelector(`.tab-link[data-target="${active}"]`);
        if (tab) tab.click();
    } else if (firstTab) {
        firstTab.click();
    }
});

// دالة تصفية الصفوف في الجدول بناءً على البحث
function filterTableRows(inputOrSection, tableId) {
    // دعم طريقتين: (input, tableId) أو (sectionId)
    if (typeof inputOrSection === 'string') {
        // (sectionId) فقط
        var sectionId = inputOrSection;
        var table = document.querySelector(`#${sectionId} table`);
        var input = document.querySelector(`#${sectionId} .search-input`);
        if (!table || !input) return;
        var filter = input.value.toLowerCase();
    } else {
        // (input, tableId)
        var input = inputOrSection;
        var filter = input.value.toLowerCase();
        var table = document.querySelector('#' + tableId + ' table');
        if (!table) return;
    }
    var trs = table.querySelectorAll('tbody tr');
    trs.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.indexOf(filter) > -1 ? '' : 'none';
    });
}
</script>
</body>
</html>
