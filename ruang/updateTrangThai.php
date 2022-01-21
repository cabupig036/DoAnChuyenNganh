<?php 
    include("./config/conndb.php"); 
    include("./lienhe.php");
    //================SHIPPER========================
    //cập nhật trạng thái sau khi shipper nhấn "Nhận"    
    // if(isset($_POST['nhan'])&&($_POST['nhan'])){
    //     $ma = $_POST['id'];
    //     $update = "update donhang set trangthai = '1' where madh = '$ma'";
    //     $query = mysqli_query($conn,$update);
    //     header('location: chonhanhang.php');
    // }
    
    //cập nhật lại trạng thái sau khi shipper đã lấy hàng từ người gửi    
    if(isset($_POST['dalay'])&&($_POST['dalay'])){
        $ma = $_POST['id'];
        $tt = $_POST['trangthai'] + 1;
        $update = "update donhang set trangthai = '$tt' where madh = '$ma'";
        $query = mysqli_query($conn,$update);
        header('location: danggiao_shipper.php');
    }
    
    //cập nhật lại trạng thái sau khi shipper đã giao hàng xong
    if(isset($_POST['xong'])&&($_POST['xong'])){//giao hàng thành công
        $ma = $_POST['id'];
        $update = "update donhang set trangthai = '5' where madh = '$ma'";
        $query = mysqli_query($conn,$update);
        header('location: giaothanhcong_shipper.php');
    }elseif(isset($_POST['hoan'])&&($_POST['hoan'])){//hoàn hàng
        $lydo = $_POST['lydo'];
        $ma = $_POST['id'];
        $update1 = "UPDATE `donhang` SET `donhang`.`ghichu` = '$lydo', `donhang`.`trangthai` = '6' WHERE `madh` = '$ma'";
        $query1 = mysqli_query($conn,$update1);
        header('location: donhoan_shipper.php');
    }
    //======================KHÁCH HÀNG==================
    //tạo đơn mới
    if(isset($_POST['tao'])&&($_POST['tao'])){
        //nguoi gui
        $maNG = $_POST['maKH'];
        $htNG = $_POST['htenNG'];
        $sdtNG = $_POST['sdtNG'];
        $dcNG = $_POST['dcNG'];
        //nguoi nhan
        $htNN = $_POST['htenNN'];
        $sdtNN = $_POST['sdtNN'];
        $dcNN = $_POST['dcNN'];
        //thong tin goi hang
        $tensp = $_POST['tensp'];
        if(isset($_FILES['hinh'])){
            $file=$_FILES['hinh'];
            $file_name=$file['name'];
            move_uploaded_file($file['tmp_name'],'../ruang/img/'.$file_name);
        }
        $hinhthuc = $_POST['guihang'];
        $tien = $_POST['tien'];
        $tuychon = $_POST['tuychon'];
        $cuoc = $_POST['goicuoc'];
        $ghichu = $_POST['ghichu'];

        //cap nhat lai thong tin nguoi gui
        $updateNG = "update user set hoten = '$htNG', sdt='$sdtNG', diachi='$dcNG' where ma = '$maNG'";
        $query = mysqli_query($conn,$updateNG);

        //ktra goi cuoc, neu ben nhan tra phi thi se cong don vao tien thu ho
        // if($tuychon == "Bên nhận trả phí"){
        //     $tien = $tien + $cuoc;
        //     $cuoc = 0;
        // }

        // lay tong so don da co trong bang don hang
        $num= mysqli_query($conn,"select count(madh)as so from donhang ");
		$row=mysqli_fetch_assoc($num);
        $n=$row['so'];
        //ma don hang
        $madh = "dh".$n;

        //luu don hang
        $insert="INSERT INTO donhang(madh,tenNN,sdtNN,diachiNN,tensp,trangthai,makh,img,tuychon,ghichu,goicuoc,tienthuho, hinhthuc,doisoat) 
        VALUES('$madh','$htNN','$sdtNN','$dcNN','$tensp','0','$maNG','$file_name','$tuychon','$ghichu','$cuoc','$tien','$hinhthuc','0')";
        $query_insert = mysqli_query($conn,$insert);
        // var_dump($ghichu);
        header('location: chobangiao_user.php');
    }

    //cập nhật lại trạng thái khi đã gửi hàng cho shipper
    if(isset($_POST['guihang1'])&&($_POST['guihang1'])){
        $ma = $_POST['id'];
        $tt = $_POST['trangthai'] + 2;
        $update = "update donhang set trangthai = '$tt' where madh = '$ma'";
        $query = mysqli_query($conn,$update);
        header('location: danggiao_user.php');
       
    }

    //đối soát chuyển khoản
    if(isset($_POST['ruttien'])&&($_POST['ruttien'])){
        $ma = $_POST['maKH'];
        $email = $_POST['email'];
        $phigh = $_POST['phigh'];
        $tienth = $_POST['tienth'];
        $phihh = $_POST['phihh'];
        $phick = $_POST['phick'];
        $sodu = $_POST['sodu'];
        $chutk = $_POST['chutk'];
        $stk = $_POST['stk'];
        $tenNH = $_POST['tenNH'];
        $chinhanh = $_POST['chinhanh'];
        //cập nhật lại trạng thái của đơn hàng khi đã đối soát r
        

        $selDS = mysqli_query($conn,"SELECT madh FROM `donhang` WHERE makh = '$ma' AND  (trangthai='5' OR trangthai='6') AND doisoat='0'");  
           
        $row = array();
        while($data = mysqli_fetch_assoc( $selDS)){
            $row[] = array($data['madh']);
        }
       
        for($j=0;$j<count($row);$j++){ 
            $ma = $row[$j][0];                                      
            $update = "update donhang set doisoat='1' where madh = '$ma'";
            $query = mysqli_query($conn,$update);
           
        }
        //luu chi tiet doi soat
        $insert_ds="INSERT INTO doisoat(chutk,sotk,nganhang,chinhanh,tienTH,phiGH,phiHH,phiCK,sodu,makh,trangthai) 
        VALUES('$chutk','$stk','$tenNH','$chinhanh','$tienth','$phigh','$phihh','$phick','$sodu','$ma','0')";
        $query_insert_ds = mysqli_query($conn,$insert_ds);

        $ndthu = "<span>Tiền đã thu hộ: $tienth</span><br>
                    <span>Phí giao hàng: $phigh</span><br>
                    <span>Phí hoàn hàng: $phihh</span><br>
                    <span>Phí chuyển khoản: $phick</span><br>
                    <span>Số dư: $sodu</span><br>
                    <h3>Thông tin chuyển khoảng</h3><br>
                    <span>Chủ tài khoản: $chutk</span><br>
                    <span>Số tài khoản: $stk</span><br>
                    <span>Ngân hàng: $tenNH</span><br>
                    <span>Chi nhánh: $chinhanh</span><br>";
        GuiMail($email, $chutk,$ndthu);
        header('location: index_user.php');
    }
?>