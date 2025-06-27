
<?php
// استخدم الاتصال المركزي
require_once 'conacted_db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    $type = $_POST['type'];
    if ($type === 'idea') {
        // قاعدة بيانات دقة الفكرة
        if (!isset($conn_idea) || !$conn_idea) {
            $conn_idea = mysqli_connect('localhost', 'root', '', 'accuracy_idea', '3305');
        }
        $book_name = $_POST['book_name'] ?? '';
        $book_num  = $_POST['book_num'] ?? '';
        $book_date = $_POST['book_date'] ?? '';
        $query = "INSERT INTO idea_tp (book_name, book_num, book_date) VALUES ('$book_name', '$book_num', '$book_date')";
        $conn = $conn_idea;
    } elseif ($type === 'hessa') {
        // قاعدة بيانات تطبيق هسه
        if (!isset($conn_hessa) || !$conn_hessa) {
            $conn_hessa = mysqli_connect('localhost', 'root', '', 'app_hasa', '3305');
        }
        $emp_name   = $_POST['emp_name']   ?? '';
        $start_date = $_POST['start_date'] ?? '';
        $depart     = $_POST['depart']     ?? '';
        $charact    = $_POST['charact']    ?? '';
        $appo_order = $_POST['appo_order'] ?? '';
        $book_num   = $_POST['book_num']   ?? '';
        $query = "INSERT INTO app_tp (emp_name, start_date, depart, charact, appo_order, book_num) VALUES ('$emp_name', '$start_date', '$depart', '$charact', '$appo_order', '$book_num')";
        $conn = $conn_hessa;
    } elseif ($type === 'creative') {
        // قاعدة بيانات الذكاء الإبداعي
        if (!isset($conn_intell) || !$conn_intell) {
            $conn_intell = mysqli_connect('localhost', 'root', '', 'reative_intelligence', '3305');
        }
        $book_title   = $_POST['book_title']   ?? '';
        $book_date    = $_POST['book_date']    ?? '';
        $book_number  = $_POST['book_number']  ?? '';
        $book_subject = $_POST['book_subject'] ?? '';
        $query = "INSERT INTO intelligene_tp (book_title, book_date, book_number, book_subject) VALUES ('$book_title', '$book_date', '$book_number', '$book_subject')";
        $conn = $conn_intell;
    } elseif ($type === 'emp') {
        // قاعدة بيانات موظفي الرابعة
        if (!isset($conn_emp) || !$conn_emp) {
            $conn_emp = mysqli_connect('localhost', 'root', '', 'rap_emp', '3305');
        }
        $emp_name   = $_POST['emp_name']   ?? '';
        $jop_title  = $_POST['jop_title']  ?? '';
        $start_date = $_POST['start_date'] ?? '';
        $query = "INSERT INTO emp_tp (emp_name, jop_title, start_date) VALUES ('$emp_name', '$jop_title', '$start_date')";
        $conn = $conn_emp;
    } elseif ($type === 'sport') {
        // قاعدة بيانات الرابعة الرياضية
        if (!isset($conn_sport) || !$conn_sport) {
            $conn_sport = mysqli_connect('localhost', 'root', '', 'rap_sport', '3305');
        }
        $book_title   = $_POST['book_title']   ?? '';
        $book_date    = $_POST['book_date']    ?? '';
        $book_number  = $_POST['book_number']  ?? '';
        $book_subject = $_POST['book_subject'] ?? '';
        $query = "INSERT INTO sport_tp (book_title, book_date, book_number, book_subject) VALUES ('$book_title', '$book_date', '$book_number', '$book_subject')";
        $conn = $conn_sport;
    } elseif ($type === 'star') {
        // قاعدة بيانات نجوم الرابعة
        if (!isset($conn_star) || !$conn_star) {
            $conn_star = mysqli_connect('localhost', 'root', '', 'rap_star', '3305');
        }
        $book_title   = $_POST['book_title']   ?? '';
        $book_date    = $_POST['book_date']    ?? '';
        $book_number  = $_POST['book_number']  ?? '';
        $book_subject = $_POST['book_subject'] ?? '';
        $query = "INSERT INTO star_tp (book_title, book_date, book_number, book_subject) VALUES ('$book_title', '$book_date', '$book_number', '$book_subject')";
        $conn = $conn_star;
    } else {
        die("نوع الجدول غير معروف.");
    }

    if (mysqli_query($conn, $query)) {
        // إعادة التوجيه للصفحة الرئيسية بعد الإجراء
        header("Location: index2.php");
        exit;
    } else {
        echo "خطأ في الإضافة: " . mysqli_error($conn);
    }
}
