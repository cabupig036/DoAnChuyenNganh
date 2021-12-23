<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db,"select * from users where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $name = $_POST['name'];
    $email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$role = $_POST['role'];
    $edit = mysqli_query($db,"update users set name='$name', email='$email', phone='$phone', address='$address', role='$role' where id='$id'");
	
    if($edit)
    {
        mysqli_close($db); // Close connection
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
	
  Tên người dùng:<input type="text" name="name" value="<?php echo $data['name'] ?>" placeholder="Enter Full Name" Required> 
  <br/>
  <br/>
  Email: <input type="text" name="email" value="<?php echo $data['email'] ?>" placeholder="Enter Email" Required>
  <br/>
  <br/>
  Số điện thoại: <input type="number" name="phone" value="<?php echo $data['phone'] ?>" placeholder="Enter Phone" Required>
  <br/>
  <br/>
  Địa chỉ: <input type="text" name="address" value="<?php echo $data['address'] ?>" placeholder="Enter Address" Required>
  <br/>
  <br/>
  Chức vụ:
  <select name="role" Required>
	  <option value="kh">kh</option>
	  <option value="sp">sp</option>
	  <option value="ad">ad</option>
  </select>
  <br/>

  <input type="submit" name="update" value="Update">
</form>