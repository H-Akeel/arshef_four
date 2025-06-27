<?php

$conn = mysqli_connect("localhost", "root", "", "users", "3305");
if (!$conn) {
    die("فشل الاتصال بقاعدة بيانات المستخدمين: " . mysqli_connect_error());
}
$conn_intell=mysqli_connect("localhost","root","","reative_intelligence","3305");
if (mysqli_connect_errno()) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

$conn_hessa = mysqli_connect("localhost", "root", "", "app_hasa", "3305");if (!$conn_hessa) {
    die("فشل الاتصال بقاعدة بيانات تطبيق هسه: " . mysqli_connect_error());
}

$conn_idea = mysqli_connect("localhost", "root", "", "accuracy_idea", "3305");
if (!$conn_idea) {
    die("فشل الاتصال بقاعدة بيانات دقة الفكرة: " . mysqli_connect_error());
}

?>