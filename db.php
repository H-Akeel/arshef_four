<?php
function getDbConnection($dbname) {
    $conn = mysqli_connect("localhost", "root", "", $dbname, "3305");
    if (mysqli_connect_errno()) {
        die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
    }
    return $conn;
}
?>
