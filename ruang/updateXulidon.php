<?php
    include("./config/conndb.php"); 
    include("./lienhe.php");
if(isset($_POST['chondon1'])&&($_POST['chondon1'])){//hoàn hàng
	$ma = $_POST['ma'];
	$madh = $_POST['madh'];
	$update = "UPDATE `donhang` SET `donhang`.`mashipper` = '$ma', `donhang`.`trangthai` = '1' WHERE `madh` = '$madh'";
	$query = mysqli_query($conn,$update);
	if($update)
	{
		header("location:Admin_Xulidanggiao.php"); // redirects to all records page
		mysqli_close($conn); // Close connection
		exit;	
	}
}
?>