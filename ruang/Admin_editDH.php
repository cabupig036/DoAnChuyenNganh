<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php

include "./config/conndb.php"; // Using database connection file here

$madh = $_GET['madh']; // get id through query string

$qry = mysqli_query($conn,"SELECT * FROM `donhang` INNER JOIN `user` ON `user`.`ma`=`donhang`.`makh` where madh='$madh'"); // select query

$data = mysqli_fetch_array($qry);

if(isset($_POST['update'])) // when click on Update button
{
  $tensp = $_POST['tensp'];
	$hoten = $_POST['hoten'];
	$sdt = $_POST['sdt'];
	$diachi = $_POST['diachi'];
	$tenNN = $_POST['tenNN'];
	$sdtNN = $_POST['sdtNN'];
	$diachiNN = $_POST['diachiNN'];
	$tienthuho = $_POST['tienthuho'];
	$goicuoc = $_POST['goicuoc'];
	$ghichu = $_POST['ghichu'];

    $edit = mysqli_query($conn,"UPDATE `donhang` INNER JOIN `user` ON `user`.`ma`=`donhang`.`makh` set tensp='$tensp', hoten='$hoten', sdt='$sdt', diachi='$diachi', tenNN='$tenNN', sdtNN='$sdtNN', diachiNN='$diachiNN', tienthuho='$tienthuho', goicuoc='$goicuoc', ghichu='$ghichu' where madh='$madh'");
    if (strlen($tensp) > 50) {
        // Sử dụng javascript để thông báo
        echo '<script language="javascript">alert("Tên sản phẩm vượt quá 50 ký tự"); window.location="Admin_editDH.php";</script>';
        // Dừng chương trình
        die();
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tensp)) {
        echo '<script language="javascript">alert("Tên sản phẩm không được chứa kí tự đặc biệt"); window.location="Admin_editDH.php";</script>';
        die();
    }
    if (strlen($hoten) > 30) {
        // Sử dụng javascript để thông báo
        echo '<script language="javascript">alert("Tên vượt quá 30 ký tự"); window.location="Admin_editDH.php";</script>';
        // Dừng chương trình
        die();
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $hoten)) {
        echo '<script language="javascript">alert("Tên không được chứa kí tự đặc biệt"); window.location="Admin_editDH.php";</script>';
        die();
    }
    if (strlen($sdt) != 10) {
        // Sử dụng javascript để thông báo
        echo '<script language="javascript">alert("Số điện thoại không hợp lệ"); window.location="Admin_editDH.php";</script>';
        // Dừng chương trình
        die();
    }
    if (strlen($sdtNN) != 10) {
        // Sử dụng javascript để thông báo
        echo '<script language="javascript">alert("Số điện thoại không hợp lệ"); window.location="Admin_editDH.php";</script>';
        // Dừng chương trình
        die();
    }
    if ($tienthuho < 0) {
        // Sử dụng javascript để thông báo
        echo '<script language="javascript">alert("Tiền không hợp lệ"); window.location="Admin_editDH.php";</script>';
        // Dừng chương trình
        die();
    }
    if ($goicuoc < 0) {
        // Sử dụng javascript để thông báo
        echo '<script language="javascript">alert("Gói cước không hợp lệ"); window.location="Admin_editDH.php";</script>';
        // Dừng chương trình
        die();
    }
    //Kiểm tra ký tự đặc biệt

    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $diachi)) {
        echo '<script language="javascript">alert("Địa chỉ không được chứa kí tự đặc biệt"); window.location="Admin_editDH.php";</script>';
        die();
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $ghichu)) {
        echo '<script language="javascript">alert("Địa chỉ không được chứa kí tự đặc biệt"); window.location="Admin_editDH.php";</script>';
        die();
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $diachiNN)) {
        echo '<script language="javascript">alert("Địa chỉ không được chứa kí tự đặc biệt"); window.location="Admin_editDH.php";</script>';
        die();
    }
    if (strlen($tenNN) > 30) {
        // Sử dụng javascript để thông báo
        echo '<script language="javascript">alert("Tên vượt quá 30 ký tự"); window.location="Admin_editDH.php";</script>';
        // Dừng chương trình
        die();
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tenNN)) {
        echo '<script language="javascript">alert("Tên sản phẩm không được chứa kí tự đặc biệt"); window.location="Admin_editDH.php";</script>';
        die();
    }
    if($edit)
    {
        mysqli_close($conn); // Close connection
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
    <table class="table align-items-center table-flush">
        <tbody>
            <thead class="thead-light">
                <tr class="header">
                    <td>
                        Tên Đơn Hàng:<input type="text" name="tensp" value="<?php echo $data['tensp'] ?>" Required>
                    </td>
                    <td>
                        Hình ảnh: <img src="./img/<?php echo $r['img'] ?>" style="width: 40px; height: 40px;">
                    </td>
                    <td>
                        Tên người gửi: <input type="text" name="hoten" value="<?php echo $data['hoten'] ?>" Required>

                    </td>

                    <td>
                        SDT người gửi:<input type="number" name="sdt" value="<?php echo $data['sdt'] ?>" Required>

                    </td>
                </tr>
                <td>
                    Địa chỉ người gửi:<input type="text" name="diachi" value="<?php echo $data['diachi'] ?>" Required>

                </td>
                <td>
                    Tên người nhận:<input type="text" name="tenNN" value="<?php echo $data['tenNN'] ?>" Required>

                </td>
                <td>
                    SDT người nhận:<input type="text" name="sdtNN" value="<?php echo $data['sdtNN'] ?>" Required>

                </td>
                <td>
                    Địa chỉ người nhận:
                    <input type="text" name="diachiNN" value="<?php echo $data['diachiNN'] ?>" Required>

                </td>
                <tr>
                    <td>
                        Tiền thu hộ:
                        <input type="number" name="tienthuho" value="<?php echo $data['tienthuho'] ?>" Required>

                    </td>
                    <td>
                        Cước phí:
                        <input type="number" name="goicuoc" value="<?php echo $data['goicuoc'] ?>" Required>

                    </td>
                    <td>
                        Ghi Chú:
                        <input type="text" name="ghichu" value="<?php echo $data['ghichu'] ?>" Required>

                    </td>
                </tr>
            </thead>
        </tbody>
    </table>

    <input type="submit" class="btn btn-success" name="update" value="Update">
</form>