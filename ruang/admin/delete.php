<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$delUser = mysqli_query($db,"delete from users where id = '$id'"); // delete query

if($delUser)
{
    mysqli_close($db); // Close connection
    header("location:Admin_User.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
