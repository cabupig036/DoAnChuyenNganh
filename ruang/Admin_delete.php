<?php

include "./config/conndb.php"; // Using database connection file here

$ma = $_GET['ma']; // get id through query string

$delUser = mysqli_query($conn,"DELETE from user where ma = '$ma'"); // delete query

if($delUser)
{
    header("location:Admin_User.php"); // redirects to all records page
    mysqli_close($conn); // Close connection

    exit;	
}
else
{
    echo '<script language="javascript">alert("Nhân viên đang có đơn hàng"); window.location="./Admin_User.php";</script>';
}
