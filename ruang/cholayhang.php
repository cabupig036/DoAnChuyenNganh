<?php 
    include("./config/conndb.php");    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link href="img/logo/logo.png" rel="icon"> -->
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
                <a class="nav-link" href="./nhandon.php">
                    <i class="fas fa-edit"></i>
                    <span>Lên đơn hàng</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Quản lý đơn</span>
                </a>
                <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Forms</h6> -->
                        <a class="collapse-item" href="form_basics.html">Chờ bàn giao</a>
                        <a class="collapse-item active" href="./cholayhang.php">Chờ lấy hàng</a>
                        <a class="collapse-item" href="form_advanceds.html">Đang giao</a>
                        <a class="collapse-item" href="form_advanceds.html">Hoàn tất</a>
                        <a class="collapse-item" href="form_advanceds.html">Hoàn hàng</a>

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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">Maman Ketoprak</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">

                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Chờ lấy hàng</h6>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush" id="dataTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Mã đơn</th>
                                            <th>Thông tin gói hàng</th>
                                            <th>Tiền thu hộ COD</th>
                                            <th>Họ tên bên nhận</th>
                                            <th>Số điện thoại bên nhận</th>
                                            <th>Địa chỉ bên nhận</th>
                                            <th>Địa chỉ bên gửi</th>
                                            <th></th>                                            
                                        </tr>
                                    </thead>                               
                                    <tbody>
                                        <?php
                                            //lấy các sp có trạng thái 'Đang chờ'
                                            //thêm where makh (đăng nhập xong) hoac mashipper (KH voi shipper dung chung trang nay)
                                                $sql="SELECT * from donhang JOIN khachhang ON donhang.makh=khachhang.makh WHERE trangthai='1' OR trangthai='2'";
                                                $query = mysqli_query($conn,$sql);	
                                                $row = array();
                                                while($data = mysqli_fetch_assoc($query)){
                                                    $row[] = array($data['madh'],$data['tendh'],$data['tienthuho'],$data['tenNN'],$data['sdtNN'],$data['diachiNN'],$data['diachi'],$data['trangthai']);
                                                }
                                                for($j=0;$j<count($row);$j++){                                                
                                        ?>
                                        <form action="./updateTrangThai.php" method="post">
                                            <tr>
                                                <td><?php echo $row[$j][0]; ?></td>
                                                <td><?php echo $row[$j][1]; ?></td>
                                                <td><?php echo $row[$j][2]; ?></td>
                                                <td><?php echo $row[$j][3]; ?></td>
                                                <td><?php echo $row[$j][4]; ?></td>
                                                <td><?php echo $row[$j][5]; ?></td>
                                                <td><?php echo $row[$j][6]; ?></td>        
                                                <!-- neu la shipper thi sua lai la Da nhan hang -->
                                                <td> <input type="submit" value="Đã gửi hàng" name="guihang" class="btn btn-warning mb-1"></td>
                                                <input type="hidden" name="id" value="<?php echo $row[$j][0]; ?>">
                                                <input type="hidden" name="trangthai" value="<?php echo $row[$j][7]; ?>">
                                            </tr>
                                        </form>
                                        <?php } ?>                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to logout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                    <a href="login.html" class="btn btn-primary">Logout</a>
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