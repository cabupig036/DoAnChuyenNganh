<?php
   include('./conndb.php');
   session_start();
    unset($_SESSION['user']);
    echo '<script language="javascript">alert("Đăng xuất thành công"); window.location="../Anyar/index.html";</script>';
    exit;
    
?>