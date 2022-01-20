<?php

include "./config/conndb.php"; // Using database connection file here

$madh = $_GET['madh']; // get id through query string

$delUser = mysqli_query($conn,"DELETE from donhang where madh = '$madh'"); // delete query

if($delUser)
{
    header("location:Admin_Donhang.php"); // redirects to all records page
    mysqli_close($conn); // Close connection
    exit;	
}
else
{
    echo '<script language="javascript">alert("Đơn hàng đã được nhận"); window.location="./Admin_Donhang.php";</script>';
}
