<?php 
    include("./config/conndb.php"); 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <title>Anyar</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <!-- <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div> -->
                <div class="sidebar-brand-text mx-3">Anyar</div>
            </a>
            <hr class="sidebar-divider my-0">

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="./donduocgiao_shipper.php">
                    <i class="fas fa-edit"></i>
                    <span>Đơn được giao</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                    aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Quản lý giao hàng</span>
                </a>
                <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Forms</h6> -->
                        <a class="collapse-item" href="./chonhanhang_shipper.php">Chờ lấy hàng</a>
                        <a class="collapse-item  active" href="./danggiao_shipper.php">Đang giao</a>
                        <a class="collapse-item" href="./giaothanhcong_shipper.php">Giao thành công</a>
                        <a class="collapse-item" href="./donhoan_shipper.php">Hoàn hàng</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                                <?php if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $selectMa = "SELECT * FROM `user` WHERE email= '$email'";
                    $query = mysqli_query($conn,$selectMa);
                    $kh = mysqli_fetch_assoc($query);
                    $ma= $kh['ma'];
                    $ten = $kh['hoten'];
                    ?>
                                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $ten; ?></span>
                                <?php 
                                   
                    // var_dump($ma);
                    // echo $ma['diachi'];
                    } 
                ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="./logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <!-- ============================================================= -->
                    <div class="login_form" id="login-register">
                        <main>
                            <div class="exit" id="exit"><a href="">X</a></div>
                            <div class="container">
                                <div class="login-form" id="login">
                                    <form action="" method="post" id="form1">
                                        <h6 class="m-0 font-weight-bold text-primary">Lý do hoàn hàng</h6>
                                        <div class="input-box">
                                            <textarea class="form-control" id="exampleFormControlTextarea12" rows="3"
                                                placeholder="Lý do" name="lydo" value="NULL"></textarea>

                                        </div>

                                        <div class="btn-box">
                                            <input type="submit" value="Ok" name="ok" class="btn btn-warning mb-1">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </main>
                    </div>
                    <style>
                    .login_form {
                        display: none;
                        position: fixed;
                        z-index: 1;
                        padding-top: 100px;
                        left: 0;
                        top: 0;
                        width: 100%;
                        height: 100%;
                        overflow: auto;
                        background-color: rgb(0, 0, 0);
                        background-color: rgba(0, 0, 0, 0.4);

                    }

                    .exit {
                        float: right;

                    }

                    main {
                        background-color: #dddddd;
                        min-height: 300px;
                        padding: 7.5px 15px;
                        width: 500px;
                        margin: 0 auto;

                    }

                    .container {
                        width: 100%;
                        max-width: 1200px;
                        margin-left: auto;
                        margin-right: auto;
                    }

                    .login-form {
                        display: block;
                        width: 100%;
                        max-width: 400px;
                        margin: 20px auto;
                        background-color: #ffffff;
                        padding: 15px;
                        border: 2px dotted #cccccc;
                        border-radius: 10px;
                    }

                    .register-form {
                        display: none;
                        width: 100%;
                        max-width: 400px;
                        margin: 20px auto;
                        background-color: #ffffff;
                        padding: 15px;
                        border: 2px dotted #cccccc;
                        border-radius: 10px;
                    }

                    .login-form a {
                        color: #D10024;
                        font-size: 10px;
                    }

                    h1 {
                        color: #D10024;
                        font-size: 20px;
                        margin-bottom: 30px;
                    }

                    .input-box {
                        margin-bottom: 20px;
                    }

                    .input-box input {
                        padding: 7.5px 15px;
                        width: 100%;
                        border: 1px solid #cccccc;
                        outline: none;
                    }

                    .btn-box {
                        text-align: right;
                        margin-top: 30px;
                    }

                    .btn-box button {
                        padding: 12px 30px;
                        background-color: #D10024;
                        border: none;
                        border-radius: 40px;
                        color: #FFF;
                        text-transform: uppercase;
                        font-weight: 700;
                        text-align: center;
                        -webkit-transition: 0.2s all;
                        transition: 0.2s all;
                    }

                    .message {
                        position: absolute;
                        padding-left: 3px;
                        color: red;
                        font-size: 13px;
                        margin-bottom: 35px;
                    }

                    .err {
                        position: absolute;
                        padding-left: 3px;
                        color: red;
                        font-size: 13px;
                        margin-bottom: 35px;
                    }
                    </style>
                    <script>
                    document.getElementById("lydo").onclick = function() {
                        document.getElementById("login-register").style.display = "block";
                    };

                    document.getElementById("myUser").onclick = function() {
                        var item1 = document.getElementById("logout");
                        if (item1.style.display === "none") {
                            item1.style.display = "block";
                        } else {
                            item1.style.display = "none";
                        }
                    };

                    document.getElementById("exit").onclick = function() {
                        getElementById("login-register").style.display = "none";
                    };
                    </script>
                    <!-- ============================================================= -->


                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Đang giao</h6>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush" id="dataTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th></th>
                                            <th>Mã đơn</th>
                                            <th>Thông tin gói hàng</th>
                                            <th>Tiền thu hộ COD</th>
                                            <th>Họ tên bên nhận</th>
                                            <th>Số điện thoại bên nhận</th>
                                            <th>Địa chỉ bên nhận</th>
                                            <th>Ghi chú</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                        //lấy các sp có trạng thái 'Đang giao'
                       
                        $sql="SELECT * from donhang JOIN user ON donhang.makh=user.ma WHERE mashipper = '$ma' AND  trangthai='4'";
                        $query = mysqli_query($conn,$sql);	
                        $row = array();
                        while($data = mysqli_fetch_assoc($query)){
                            $row[] = array($data['madh'],$data['tensp'],$data['tienthuho'],$data['tenNN'],$data['sdtNN'],$data['diachiNN'],$data['diachi'],$data['img'],$data['goicuoc'],$data['tuychon'],$data['ghichu'],$data['hinhthuc'],$data['trangthai']);
                        }
                        for($j=0;$j<count($row);$j++){                                         
                            if($row[$j][9]=="Bên nhận trả phí"){
                                   $tien = $row[$j][8] + $row[$j][2];
                            }else{
                                $tien = $row[$j][2];
                            }                                                                     
                        ?>
                                        <form action="./updateTrangThai.php" method="post">
                                            <tr>
                                                <td><img src="./img/<?php echo $row[$j][7]; ?>" alt=""
                                                        style="width: 60px; height: 60px;"> </td>
                                                <td><?php echo $row[$j][0]; ?></td>
                                                <td><?php echo $row[$j][1]; ?></td>
                                                <td><?php echo $tien; ?></td>
                                                <td><?php echo $row[$j][3]; ?></td>
                                                <td><?php echo $row[$j][4]; ?></td>
                                                <td><?php echo $row[$j][5]; ?></td>
                                                <td><?php echo $row[$j][10]; ?></td>
                                                <td> <input type="submit" value="Thành công" name="xong"
                                                        class="btn btn-warning mb-1"></td>
                                                <td> <button type="button" class="btn btn-warning mb-1"
                                                        data-toggle="modal" data-target=".bd-example-modal">Hoàn
                                                        hàng</button></td>
                                                <input type="hidden" name="id" value="<?php echo $row[$j][0]; ?>">
                                            </tr>
                                        </form>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Logout -->
                    <div class="modal fade bd-example-modal" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <?php
                        //lấy các sp có trạng thái 'Đang giao'
                       
                        $sql="SELECT * from donhang JOIN user ON donhang.makh=user.ma WHERE mashipper = '$ma' AND  trangthai='4'";
                        $query = mysqli_query($conn,$sql);	
                        $row = array();
                        while($data = mysqli_fetch_assoc($query)){
                            $row[] = array($data['madh'],$data['tensp'],$data['tienthuho'],$data['tenNN'],$data['sdtNN'],$data['diachiNN'],$data['diachi'],$data['img'],$data['goicuoc'],$data['tuychon'],$data['ghichu'],$data['hinhthuc'],$data['trangthai']);
                        }
                        for($j=0;$j<count($row);$j++){                                         
                            if($row[$j][9]=="Bên nhận trả phí"){
                                   $tien = $row[$j][8] + $row[$j][2];
                            }else{
                                $tien = $row[$j][2];
                            }                                                                     
                        ?>
                                        <form action="./updateTrangThai.php" method="post">
                                            <thead class="input-group mb-3">
                                                <td><?php echo $row[$j][0]; ?></td>
                                                <td>
                                                    <input name="lydo" class="form-control"
                                                        placeholder="Lý do hoàn đơn">

                                                </td>
                                                <div class="input-group-append">
                                                    <td> <input type="submit" value="Hoàn hàng" name="hoan"
                                                            class="btn btn-warning mb-1" id="lydo">
                                                    </td>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $row[$j][0]; ?>">
                                            </thead>
                                        </form>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Container Fluid-->
                </div>

            </div>
        </div>

        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/ruang-admin.min.js"></script>
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="js/demo/chart-area-demo.js"></script>
</body>

</html>