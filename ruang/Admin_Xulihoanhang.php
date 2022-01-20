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
    <style>
    .zoom {
        transition: transform .2s;
        /* Animation */
        width: 100px;
        height: 100px;
        margin: auto;
    }

    .zoom:hover {
        transform: scale(5.0);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
    </style>
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
                <a class="nav-link" href="./Admin_Xulidonhang.php">
                    <i class="fas fa-edit"></i>
                    <span>Xử lý đơn hàng</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Admin_Donhang.php">
                    <i class="fas fa-edit"></i>
                    <span>Quản lý Đơn Hàng</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Admin_User.php">
                    <i class="fas fa-edit"></i>
                    <span>Quản lý Shipper</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                    aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Quản lý giao hàng</span>
                </a>


                <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Forms</h6> -->

                        <a class="collapse-item" href="./Admin_Xulidanggiao.php">Đang giao cho shipper</a>
                        <a class="collapse-item" href="./Admin_Xuligiaothanhcong.php">Giao thành công</a>
                        <a class="collapse-item" href="./Admin_Xulihoanhang.php">Hoàn hàng</a>

                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!--List-->
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
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h2>Admin <b>Details</b></h2>
                                </div>
                                <div class="col-sm-4">
                                    <nav class="navbar navbar-light bg-light">
                                        <form class="form-inline">
                                            <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                                aria-label="Search">
                                            <button class="btn btn-outline-success my-2 my-sm-0"
                                                type="submit">Search</button>
                                        </form>
                                    </nav>

                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên đơn hàng</th>
                                        <th>Hình ảnh</th>
                                        <th>Mã shipper</th>
                                        <th>Họ tên Shipper</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Email Shipper</th>

                                    </tr>
                                </thead>
                            <tbody>
                                <?php
include("./config/conndb.php");   
  $sql = "SELECT * FROM `donhang` INNER JOIN `user` ON `user`.`ma`=`donhang`.`mashipper` WHERE `donhang`.`trangthai` = N'6'";
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($data as $r) {
  ?>
                                <tr>
                                    <form action="./updateXulidon.php" method="post">
                                        <td><?php echo $r['madh'] ?></td>
                                        <td><?php echo $r['tensp'] ?></td>
                                        <td class="zoom">
                                            <img src="./img/<?php echo $r['img'] ?>" style="width: 40px; height: 40px;">
                                        </td>
                                        <td><?php echo $r['mashipper'] ?></td>
                                        <td><?php echo $r['hoten'] ?></td>
                                        <td><?php echo $r['diachi'] ?></td>
                                        <td><?php echo $r['sdt'] ?></td>
                                        <td><?php echo $r['email'] ?></td>
                                    </form>

                                </tr>
                                </form>
                                <?php } ?>
                            </tbody>
                        </table>

                        <!--List-->
                    </div>
                </div>
            </div>
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