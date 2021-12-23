<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db,"select * from donhang where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $tenNG = $_POST['tenNG'];
    $tenNN = $_POST['tenNN'];
	$sdtNG = $_POST['sdtNG'];
	$sdtNN = $_POST['sdtNN'];
	$diachiNG = $_POST['diachiNG'];
	$diachiNN = $_POST['diachiNN'];
	$tendh = $_POST['tendh'];
	$tienthuho = $_POST['tienthuho'];
	$ghichu = $_POST['ghichu'];
	$trangthai = $_POST['trangthai'];
	$thanhtoan = $_POST['thanhtoan'];
	$ngay = $_POST['ngay'];

    $edit = mysqli_query($db,"update donhang set tenNG='$tenNG', tenNN='$tenNN', sdtNG='$sdtNG', sdtNN='$sdtNN', diachiNG='$diachiNG', diachiNN='$diachiNN', tendh='$tendh', tienthuho='$tienthuho', ghichu='$ghichu', trangthai='$trangthai', thanhtoan='$thanhtoan', ngay='$ngay' where id='$id'");
	
    if($edit)
    {
        mysqli_close($db); // Close connection
        header("location:Admin_Donhang.php"); // redirects to all records page
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

  Tên người gửi:<input type="text" name="tenNG" value="<?php echo $data['tenNG'] ?>" placeholder="Enter Full Name" Required> <br/>
  <br/>  
  Tên người nhận:<input type="text" name="tenNN" value="<?php echo $data['tenNN'] ?>" placeholder="Enter Name" Required> <br/> 
  <br/> 
  SDT người gửi:<input type="number" name="sdtNG" value="<?php echo $data['sdtNG'] ?>" placeholder="Enter Phone" Required> <br/> 
  <br/> 
  SDT người nhận:<input type="number" name="sdtNN" value="<?php echo $data['sdtNN'] ?>" placeholder="Enter Phone" Required> <br/> 
  <br/> 
  Địa chỉ người gửi:<input type="text" name="diachiNG" value="<?php echo $data['diachiNG'] ?>" placeholder="Enter Address" Required>  <br/>
  <br/> 
  Địa chỉ người nhận:<input type="text" name="diachiNN" value="<?php echo $data['diachiNN'] ?>" placeholder="Enter Address" Required> <br/> 
  <br/> 
  Tên đơn hàng:<input type="text" name="tendh" value="<?php echo $data['tendh'] ?>" placeholder="Enter Name" Required> <br/> 
  <br/> 
  Tiền thu hộ:<input type="number" name="tienthuho" value="<?php echo $data['tienthuho'] ?>" placeholder="Enter Money" Required> <br/> 
  <br/> 
  Ghi chú:<input type="text" name="ghichu" value="<?php echo $data['ghichu'] ?>" placeholder="Enter Note" Required>  <br/> 
  <br/> 
  Trạng thái
  <select name="trangthai" Required>
	  <option name="Đang chờ">Đang chờ</option>
      <option name="Đang giao">Đang giao</option>
	  <option name="Hoàn tất">Hoàn tất</option>
      <option name="Hoàn tất">Hoàn tất</option>
  </select>
  <br/> 
  <br/> 
  Thanh toán:
  <select name="thanhtoan" Required>
	  <option value="Bên gửi thanh toán">Bên gửi thanh toán</option>
	  <option value="Bên nhận thanh toán">Bên nhận thanh toán</option>
  </select>
  <br/> 
  <br/> 
  <br/> 
  Ngày:<input type="timestamp" name="ngay" value="<?php echo $data['ngay'] ?>" placeholder="Enter Date" Required> <br/> 
  <br/>

  <input type="submit" name="update" value="Update">

</form>