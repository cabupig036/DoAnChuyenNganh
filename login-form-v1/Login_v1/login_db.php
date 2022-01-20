<?php
session_start();
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
	$conn = mysqli_connect("localhost:3307","root","","dbgiaohang");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
// When form submitted, insert values into the database.

    //escapes special characters in a string
    if (!isset($_SESSION))
    session_start();
 
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($conn, $email);
    $pass = stripslashes($_REQUEST['password']);

    $pass = mysqli_real_escape_string($conn, $pass);
    $pass= substr(md5($pass),0,500);

    $sql = "SELECT * FROM  `user` WHERE  email = '$email' and password ='$pass' ";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0 ) {
      $_SESSION["email"]=$email;
      $row = $result->fetch_assoc();
      if($row["role"] == '2')	
      {
          echo '<script language="javascript">alert("Đăng nhập thành công"); window.location="../../ruang/index_shipper.php";</script>';
          exit;
      }
      elseif($row["role"] == '1') {
          echo '<script language="javascript">alert("Đăng nhập thành công"); window.location="../../ruang/index_user.php";</script>';
          exit;
      }

      echo($row["level"]);
      $conn->close();
    }      else{
        echo '<script language="javascript">alert("Đăng nhập thất bại"); window.location="Login.php";</script>';
        exit;
      }
?>

