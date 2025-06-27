<?php
require_once 'db.php';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id   = intval($_GET['id']);

    if ($type === 'idea') {
        $conn = getDbConnection("accuracy_idea");
        $query = "DELETE FROM idea_tp WHERE ID = $id";
    } elseif ($type === 'hessa') {
        $conn = getDbConnection("app_hasa");
        $query = "DELETE FROM app_tp WHERE ID = $id";
    } elseif ($type === 'creative') {
        $conn = getDbConnection("reative_intelligence");
        $query = "DELETE FROM intelligene_tp WHERE ID = $id";
    } elseif ($type === 'emp') {
        $conn = getDbConnection("rap_emp");
        $query = "DELETE FROM emp_tp WHERE ID = $id";
    } elseif ($type === 'sport') {
        $conn = getDbConnection("rap_sport");
        $query = "DELETE FROM sport_tp WHERE ID = $id";
    } elseif ($type === 'star') {
        $conn = getDbConnection("rap_star");
        $query = "DELETE FROM star_tp WHERE ID = $id";
    } else {
        die("نوع الجدول غير معروف.");
    }

    if (mysqli_query($conn, $query)) {
        header("Location: index2.php");
        exit;
    } else {
        echo "خطأ في الحذف: " . mysqli_error($conn);
    }
} else {
    echo "بيانات غير مكتملة.";
}
?>
