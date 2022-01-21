<?php
   include('./config/conndb.php');
   session_start();
   session_destroy();
    echo '<script language="javascript">alert("Đăng xuất thành công"); window.location="../Anyar/index.html";</script>';
    exit;
    
?>