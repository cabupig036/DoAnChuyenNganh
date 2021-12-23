<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
	$con = mysqli_connect("localhost","root","","dbgiaohang");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
// When form submitted, insert values into the database.

    //escapes special characters in a string
    if (!isset($_SESSION))
        session_start();
 
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($con, $email);
    $pass = stripslashes($_REQUEST['password']);

    $pass = mysqli_real_escape_string($con, $pass);
    $pass= substr(md5($pass),0,500);

    $sql = "SELECT * FROM  `users` WHERE  email = '$email' and password ='$pass' ";

    $result = mysqli_query($con, $sql);

  
    if (mysqli_num_rows($result) > 0 ) {
       
      $_SESSION["email"]=$email;
     
        echo '<script language="javascript">alert("Đăng nhập thành công"); window.location="../../ruang-admin/User_index.php";</script>';
        exit;
    }
    
     else {
        
            echo '<script language="javascript">alert("Đăng nhập không thành công"); window.location="../Login_v1/Login.php";</script>';
    }

?>

