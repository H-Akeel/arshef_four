<?php
require_once 'db.php';

$type = $_GET['type'] ?? '';
$id   = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($type === 'idea') {
    $conn = getDbConnection("accuracy_idea");
    $query = "SELECT * FROM idea_tp WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $book_name = $_POST['book_name'] ?? '';
        $book_num  = $_POST['book_num'] ?? '';
        $book_date = $_POST['book_date'] ?? '';
        $update = "UPDATE idea_tp SET book_name='$book_name', book_num='$book_num', book_date='$book_date' WHERE ID = $id";
        if (mysqli_query($conn, $update)) {
            header("Location: index2.php");
            exit;
        } else {
            echo "خطأ في التعديل: " . mysqli_error($conn);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ar">
    <head><meta charset="UTF-8"><title>تعديل دقة الفكرة</title></head>
    <body>
    <form method="POST">
        <label>اسم الكتاب</label>
        <input type="text" name="book_name" value="<?php echo htmlspecialchars($row['book_name']); ?>"><br>
        <label>رقم الكتاب</label>
        <input type="text" name="book_num" value="<?php echo htmlspecialchars($row['book_num']); ?>"><br>
        <label>تاريخ الكتاب</label>
        <input type="text" name="book_date" value="<?php echo htmlspecialchars($row['book_date']); ?>"><br>
        <input type="submit" value="حفظ التعديلات">
    </form>
    </body>
    </html>
    <?php
    exit;
} elseif ($type === 'hessa') {
    $conn = getDbConnection("app_hasa");
    $query = "SELECT * FROM app_tp WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $emp_name   = $_POST['emp_name']   ?? '';
        $start_date = $_POST['start_date'] ?? '';
        $depart     = $_POST['depart']     ?? '';
        $charact    = $_POST['charact']    ?? '';
        $appo_order = $_POST['appo_order'] ?? '';
        $book_num   = $_POST['book_num']   ?? '';
        $update = "UPDATE app_tp SET emp_name='$emp_name', start_date='$start_date', depart='$depart', charact='$charact', appo_order='$appo_order', book_num='$book_num' WHERE ID = $id";
        if (mysqli_query($conn, $update)) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "خطأ في التعديل: " . mysqli_error($conn);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ar">
    <head><meta charset="UTF-8"><title>تعديل تطبيق هسه</title></head>
    <body>
    <form method="POST">
        <label>اسم الموظف</label>
        <input type="text" name="emp_name" value="<?php echo htmlspecialchars($row['emp_name']); ?>"><br>
        <label>تاريخ البداية</label>
        <input type="text" name="start_date" value="<?php echo htmlspecialchars($row['start_date']); ?>"><br>
        <label>القسم</label>
        <input type="text" name="depart" value="<?php echo htmlspecialchars($row['depart']); ?>"><br>
        <label>الصفة</label>
        <input type="text" name="charact" value="<?php echo htmlspecialchars($row['charact']); ?>"><br>
        <label>أمر التعيين</label>
        <input type="text" name="appo_order" value="<?php echo htmlspecialchars($row['appo_order']); ?>"><br>
        <label>رقم الكتاب</label>
        <input type="text" name="book_num" value="<?php echo htmlspecialchars($row['book_num']); ?>"><br>
        <input type="submit" value="حفظ التعديلات">
    </form>
    </body>
    </html>
    <?php
    exit;
} elseif ($type === 'creative') {
    $conn = getDbConnection("reative_intelligence");
    $query = "SELECT * FROM intelligene_tp WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $book_title   = $_POST['book_title']   ?? '';
        $book_date    = $_POST['book_date']    ?? '';
        $book_number  = $_POST['book_number']  ?? '';
        $book_subject = $_POST['book_subject'] ?? '';
        $update = "UPDATE intelligene_tp SET book_title='$book_title', book_date='$book_date', book_number='$book_number', book_subject='$book_subject' WHERE ID = $id";
        if (mysqli_query($conn, $update)) {
            header("Location: index2.php");
            exit;
        } else {
            echo "خطأ في التعديل: " . mysqli_error($conn);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ar">
    <head><meta charset="UTF-8"><title>تعديل الذكاء الإبداعي</title></head>
    <body>
    <form method="POST">
        <label>عنوان الكتاب</label>
        <input type="text" name="book_title" value="<?php echo htmlspecialchars($row['book_title']); ?>"><br>
        <label>تاريخ الكتاب</label>
        <input type="text" name="book_date" value="<?php echo htmlspecialchars($row['book_date']); ?>"><br>
        <label>رقم الكتاب</label>
        <input type="text" name="book_number" value="<?php echo htmlspecialchars($row['book_number']); ?>"><br>
        <label>موضوع الكتاب</label>
        <input type="text" name="book_subject" value="<?php echo htmlspecialchars($row['book_subject']); ?>"><br>
        <input type="submit" value="حفظ التعديلات">
    </form>
    </body>
    </html>
    <?php
    exit;
} elseif ($type === 'emp') {
    $conn = getDbConnection("rap_emp");
    $query = "SELECT * FROM emp_tp WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $emp_name   = $_POST['emp_name']   ?? '';
        $jop_title  = $_POST['jop_title']  ?? '';
        $start_date = $_POST['start_date'] ?? '';
        $update = "UPDATE emp_tp SET emp_name='$emp_name', jop_title='$jop_title', start_date='$start_date' WHERE ID = $id";
        if (mysqli_query($conn, $update)) {
            header("Location: index2.php");
            exit;
        } else {
            echo "خطأ في التعديل: " . mysqli_error($conn);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ar">
    <head><meta charset="UTF-8"><title>تعديل موظفي الرابعة</title></head>
    <body>
    <form method="POST">
        <label>اسم الموظف</label>
        <input type="text" name="emp_name" value="<?php echo htmlspecialchars($row['emp_name']); ?>"><br>
        <label>المسمى الوظيفي</label>
        <input type="text" name="jop_title" value="<?php echo htmlspecialchars($row['jop_title']); ?>"><br>
        <label>تاريخ المباشرة</label>
        <input type="text" name="start_date" value="<?php echo htmlspecialchars($row['start_date']); ?>"><br>
        <input type="submit" value="حفظ التعديلات">
    </form>
    </body>
    </html>
    <?php
    exit;
} elseif ($type === 'sport') {
    $conn = getDbConnection("rap_sport");
    $query = "SELECT * FROM sport_tp WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $book_title   = $_POST['book_title']   ?? '';
        $book_date    = $_POST['book_date']    ?? '';
        $book_number  = $_POST['book_number']  ?? '';
        $book_subject = $_POST['book_subject'] ?? '';
        $update = "UPDATE sport_tp SET book_title='$book_title', book_date='$book_date', book_number='$book_number', book_subject='$book_subject' WHERE ID = $id";
        if (mysqli_query($conn, $update)) {
            header("Location: index2.php");
            exit;
        } else {
            echo "خطأ في التعديل: " . mysqli_error($conn);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ar">
    <head><meta charset="UTF-8"><title>تعديل الرابعة الرياضية</title></head>
    <body>
    <form method="POST">
        <label>عنوان الكتاب</label>
        <input type="text" name="book_title" value="<?php echo htmlspecialchars($row['book_title']); ?>"><br>
        <label>تاريخ الكتاب</label>
        <input type="text" name="book_date" value="<?php echo htmlspecialchars($row['book_date']); ?>"><br>
        <label>رقم الكتاب</label>
        <input type="text" name="book_number" value="<?php echo htmlspecialchars($row['book_number']); ?>"><br>
        <label>موضوع الكتاب</label>
        <input type="text" name="book_subject" value="<?php echo htmlspecialchars($row['book_subject']); ?>"><br>
        <input type="submit" value="حفظ التعديلات">
    </form>
    </body>
    </html>
    <?php
    exit;
} elseif ($type === 'star') {
    $conn = getDbConnection("rap_star");
    $query = "SELECT * FROM star_tp WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $book_title   = $_POST['book_title']   ?? '';
        $book_date    = $_POST['book_date']    ?? '';
        $book_number  = $_POST['book_number']  ?? '';
        $book_subject = $_POST['book_subject'] ?? '';
        $update = "UPDATE star_tp SET book_title='$book_title', book_date='$book_date', book_number='$book_number', book_subject='$book_subject' WHERE ID = $id";
        if (mysqli_query($conn, $update)) {
            header("Location: index2.php");
            exit;
        } else {
            echo "خطأ في التعديل: " . mysqli_error($conn);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ar">
    <head><meta charset="UTF-8"><title>تعديل نجوم الرابعة</title></head>
    <body>
    <form method="POST">
        <label>عنوان الكتاب</label>
        <input type="text" name="book_title" value="<?php echo htmlspecialchars($row['book_title']); ?>"><br>
        <label>تاريخ الكتاب</label>
        <input type="text" name="book_date" value="<?php echo htmlspecialchars($row['book_date']); ?>"><br>
        <label>رقم الكتاب</label>
        <input type="text" name="book_number" value="<?php echo htmlspecialchars($row['book_number']); ?>"><br>
        <label>موضوع الكتاب</label>
        <input type="text" name="book_subject" value="<?php echo htmlspecialchars($row['book_subject']); ?>"><br>
        <input type="submit" value="حفظ التعديلات">
    </form>
    </body>
    </html>
    <?php
    exit;
} else {
    echo "نوع الجدول غير معروف.";
}
?>
