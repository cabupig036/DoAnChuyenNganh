<?php


if (!isset($_SESSION))
session_start();
unset($_SESSION['email']) ;
echo '<script language="javascript">alert("Đăng xuất thành công"); window.location="../pcoint/Homepage.php";</script>';
?>
