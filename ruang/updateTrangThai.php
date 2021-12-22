<?php 
    include("./config/conndb.php"); 
    //lay ma don hang tu form
    if(isset($_POST['nhan'])&&($_POST['nhan'])){
        $ma = $_POST['id'];
    }
    var_dump(($_POST['nhan']));
    //update lại cột trạng thái sau khi shipper nhận đơn, thành "chờ lấy hàng"    
    $update = "update donhang set trangthai = 'Chờ lấy hàng' where madh = '$ma'";
    var_dump($ma);
?>