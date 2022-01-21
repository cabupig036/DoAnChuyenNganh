<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php

include "./config/conndb.php"; // Using database connection file here

$ma = $_GET['ma']; // get id through query string
$qry = mysqli_query($conn,"select * from user where ma='$ma'"); // select query
$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{

  $hoten = $_POST['hoten'];
  $sdt = $_POST['sdt'];
	$email = $_POST['email'];
	$diachi = $_POST['diachi'];
  $edit = mysqli_query($conn,"update user set hoten='$hoten', sdt='$sdt', email='$email', diachi='$diachi' where ma='$ma'");
  
  if (strlen($hoten) > 30) {
    // Sử dụng javascript để thông báo
    echo '<script language="javascript">alert("Tên vượt quá 30 ký tự"); window.location="Admin_edit.php";</script>';
    // Dừng chương trình
    die();
}
if (strlen($sdt) != 10) {
    // Sử dụng javascript để thông báo
    echo '<script language="javascript">alert("Số điện thoại không hợp lệ"); window.location="Admin_edit.php";</script>';
    // Dừng chương trình
    die();
}

//Kiểm tra ký tự đặc biệt
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $hoten)) {
    echo '<script language="javascript">alert("Tên không được chứa kí tự đặc biệt"); window.location="Admin_edit.php";</script>';
    die();
}
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $diachi)) {
    echo '<script language="javascript">alert("Địa chỉ không được chứa kí tự đặc biệt"); window.location="Admin_edit.php";</script>';
    die();
}
    if($edit)
    {
        mysqli_close($conn); // Close connection
        header("location:Admin_User.php"); // redirects to all records page
        exit;
    }
    else
    {
        die("Connection failed: " . mysqli_connect_error());
    }    	
}
?>

<h3>Update Data</h3>

<form method="POST">
    <table class="table table-hover">
        <td>
            Tên người dùng:<input type="text" name="hoten" value="<?php echo $data['hoten'] ?>"
                placeholder="Enter Full Name" Required>
        </td>
        <td>
            Email: <input type="email" name="email" value="<?php echo $data['email'] ?>" placeholder="Enter Email"
                Required>
        </td>
        <td>
            Số điện thoại: <input type="number" name="sdt" value="<?php echo $data['sdt'] ?>" placeholder="Enter Phone"
                Required>
        </td>
        <td>
            Địa chỉ: <input type="text" name="diachi" value="<?php echo $data['diachi'] ?>" placeholder="Enter Address"
                Required>
        </td>
        </tr>

    </table>
    <input type="submit" class="btn btn-success" name="update" value="Update">
</form>