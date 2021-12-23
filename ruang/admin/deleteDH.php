<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$delDH = mysqli_query($db,"delete from donhang where id = '$id'"); // delete query

if($delDH)
{
    mysqli_close($db); // Close connection
    header("location:Admin_DonHang.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
