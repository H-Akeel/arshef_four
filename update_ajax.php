<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id           = intval($_POST['id']);
    $type         = $_POST['type'] ?? '';

    if ($type === 'creative') {
        $book_title   = $_POST['book_title'] ?? '';
        $book_date    = $_POST['book_date'] ?? '';
        $book_number  = $_POST['book_number'] ?? '';
        $book_subject = $_POST['book_subject'] ?? '';

        // اتصال مباشر بقاعدة البيانات
        $conn = mysqli_connect("localhost", "root", "", "reative_intelligence", 3305);
        if (!$conn) {
            die("فشل الاتصال: " . mysqli_connect_error());
        }

        $sql = "UPDATE intelligene_tp SET 
                    book_title='$book_title', 
                    book_date='$book_date', 
                    book_number='$book_number', 
                    book_subject='$book_subject' 
                WHERE ID = $id";

        if (mysqli_query($conn, $sql)) {
            header("Location: index2.php");
            exit;
        } else {
            echo "❌ خطأ في التعديل: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "❌ نوع الجدول غير صحيح أو مفقود.";
    }
}
?>
