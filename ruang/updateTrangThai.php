<?php 
    include("./config/conndb.php"); 
    //================SHIPPER========================
    //cập nhật trạng thái sau khi shipper nhấn "Nhận"    
    if(isset($_POST['nhan'])&&($_POST['nhan'])){
        $ma = $_POST['id'];
        $update = "update donhang set trangthai = '1' where madh = '$ma'";
        $query = mysqli_query($conn,$update);
        header('location: chonhanhang.php');
    }
    
    //cập nhật lại trạng thái sau khi shipper đã lấy hàng từ người gửi    
    if(isset($_POST['dalay'])&&($_POST['dalay'])){
        $ma = $_POST['id'];
        $tt = $_POST['trangthai'] + 1;
        $update = "update donhang set trangthai = '$tt' where madh = '$ma'";
        $query = mysqli_query($conn,$update);
        header('location: danggiao_shipper.php');
    }
    
    //cập nhật lại trạng thái sau khi shipper đã giao hàng xong
    if(isset($_POST['xong'])&&($_POST['xong'])){
        $ma = $_POST['id'];
        $update = "update donhang set trangthai = '4' where madh = '$ma'";
        $query = mysqli_query($conn,$update);
        header('location: giaothanhcong.php');
    }elseif(isset($_POST['hoan'])&&($_POST['hoan'])){
        $ma = $_POST['id'];
        $update1 = "update donhang set trangthai = '5' where madh = '$ma'";
        $query1 = mysqli_query($conn,$update1);
        header('location: donhoan_shipper.php');
    }
    //======================KHÁCH HÀNG==================
    //tạo đơn mới
    if(isset($_POST['tao'])&&($_POST['tao'])){
        $htNG = $_POST['tuychon'];
        //var_dump($ma);
        // $update = "update donhang set trangthai = '1' where madh = '$ma'";
        // $query = mysqli_query($conn,$update);
        // header('location: chonhanhang.php');
    }

    //cập nhật lại trạng thái khi đã gửi hàng cho shipper
    if(isset($_POST['guihang'])&&($_POST['guihang'])){
        $ma = $_POST['id'];
        $tt = $_POST['trangthai'] + 2;
        $update = "update donhang set trangthai = '$tt' where madh = '$ma'";
        $query = mysqli_query($conn,$update);
        header('location: danggiao.php');
       
    }
?>