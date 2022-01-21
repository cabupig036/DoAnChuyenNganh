<?php 
  session_start(); 
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
        <a class="nav-link" href="./lendon.php">
          <i class="fas fa-edit"></i>
          <span>Lên đơn hàng</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
          aria-controls="collapseForm">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Quản lý đơn</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Forms</h6> -->
            <a class="collapse-item" href="./chobangiao.php">Chờ bàn giao</a>
            <a class="collapse-item" href="./cholayhang.php">Chờ lấy hàng</a>
            <a class="collapse-item" href="./danggiao.php">Đang giao</a>
            <a class="collapse-item" href="./hoantat.php">Hoàn tất</a>
            <a class="collapse-item" href="./hoanhang.php">Hoàn hàng</a>
            
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <li class="nav-item  active">
        <a class="nav-link " href="./doisoat.php">
        <i class="fas fa-fw fa-columns"></i>
          <span>Đối soát</span>
        </a>
      </li>
      
     
      
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
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
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
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="./logout.php" >
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
        <style>
            .left{
                float:left;
            }
            .right{
                float:right;
            }
        </style>
        <?php 
          //tinh tong tien da thu ho
          $selTienTH = mysqli_query($conn,"SELECT SUM(tienthuho) FROM `donhang` WHERE makh = '$ma' AND  trangthai='5'");
          $tienTH = mysqli_fetch_array($selTienTH);
          if($tienTH[0] == NULL){
            $tien = 0;
          }else{
            $tien = $tienTH[0];
          }
          // var_dump($tienTH[0]);

          //tinh phi giao hang
          $selPhiGH =  mysqli_query($conn,"SELECT SUM(goicuoc) FROM `donhang` WHERE makh = '$ma' AND  trangthai='5' AND tuychon = 'Bên gửi trả phí'");
          $phiGH = mysqli_fetch_array($selPhiGH);
          if($phiGH[0] == NULL){
            $tienGH = 0;
          }else{
            $tienGH = $phiGH[0];
          }
          //tinh tien ship ma ben nhan tra tien voi cac don hoan ve
          $selPhiGHHH =  mysqli_query($conn,"SELECT SUM(goicuoc) FROM `donhang` WHERE makh = '$ma' AND  trangthai='6' AND tuychon = 'Bên nhận trả phí'");
          $HH = mysqli_fetch_array($selPhiGHHH);
          if($HH[0] == NULL){
            $tienHH = 0;
          }else{
            $tienHH = $HH[0];
          }
          $tongGH = $tienGH + $tienHH;
          
          //tinh phi hoan hang==========================================================         
          //tien phi hoan hang
          $selPhiHH =  mysqli_query($conn,"SELECT SUM(goicuoc) FROM `donhang` WHERE makh = '$ma' AND  trangthai='6' ");
          $hh = mysqli_fetch_array($selPhiHH);
          if($hh[0] == NULL){
            $phiHH = 0;
          }else{
            $phiHH = $hh[0];
          }
                    
          //phi chuyen khoan
          $selCK =  mysqli_query($conn,"SELECT gia FROM phi WHERE ten = 'Phí chuyển khoản'");
          $ck = mysqli_fetch_array($selCK);

          //tinh so du
          $sodu = $tien - $tongGH - $phiHH - $ck[0];
          
        ?>
        <!-- Container Fluid-->
        <div class="container-fluid" >
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Quản lý dòng tiền</h1>              
            </div>
            <form action="./updateTrangThai.php" method = "post">
                <input type="hidden" name="maKH" value="<?php echo $ma;?>">
                <input type="hidden" name="email" value="<?php echo $email;?>">
                <div class="row" >
                    <div class="col-lg-6">                  
                        <div class="card mb-4"> 
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Dòng tiền</h6>
                            </div>                  
                            <div class="card-body">
                                <!-- <div class="form-group">
                                    <label for="hoten">Chủ tài khoản ngân hàng</label>
                                    <input id="hoten" type="text" class="form-control" name="chutk" value="">
                                </div>         -->
                                <div class="form-group">
                                    <span class="left">Tiền đã thu hộ</span>
                                    <span class="right">+<?php echo $tien;?></span>
                                    <input type="hidden" name="tienth" value="<?php echo $tien;?>">
                                </div><br>
                                <div class="form-group">
                                    <span class="left">Phí giao hàng</span>
                                    <span class="right">-<?php echo $tongGH;?></span>
                                    <input type="hidden" name="phigh" value="<?php echo $tongGH;?>">
                                </div><br>   
                                <div class="form-group">
                                    <span class="left">Phí hoàn hàng</span>
                                    <span class="right">-<?php echo $phiHH;?></span>
                                    <input type="hidden" name="phihh" value="<?php echo $phiHH;?>">
                                </div><br>  
                                <div class="form-group">
                                    <span class="left">Phí chuyển khoản</span>
                                    <span class="right">-<?php echo $ck[0];?></span>
                                    <input type="hidden" name="phick" value="<?php echo $ck[0];?>">
                                </div><br>
                                <hr class="sidebar-divider">
                                <div class="form-group">
                                    <span class="left">Số dư</span>
                                    <span class="right"><?php echo $sodu;?></span>
                                    <input type="hidden" name="sodu" value="<?php echo $sodu;?>">
                                </div>                 
                            </div>
                        </div>    
                    </div>        
                    <div class="col-lg-6">                  
                        <div class="card mb-4"> 
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Thông tin đối soát chuyển khoản</h6>
                            </div>                  
                            <div class="card-body">                                
                                <div class="form-group">
                                    <label for="hoten">Chủ tài khoản ngân hàng</label>
                                    <input id="hoten" type="text" class="form-control" name="chutk" value="">
                                </div>        
                                <div class="form-group">
                                    <label for="hoten">Số tài khoản ngân hàng</label>
                                    <input id="hoten" type="text" class="form-control" name="stk" value="">
                                </div>
                                <div class="form-group">
                                    <label for="select2SinglePlaceholder1">Chọn ngân hàng</label>
                                    <select class="select2-single-placeholder form-control" name="tenNH" id="select2SinglePlaceholder1" >                                    
                                        <option value="Vietcombank">Vietcombank</option>
                                        <option value="Techcombank">Techcombank</option>
                                        <option value="VietinBank">VietinBank</option>
                                        <option value="BIDV">BIDV</option>
                                        <option value="Sacombank">Sacombank</option>    
                                        <option value="Agribank">Agribank</option>                                                                   
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="diachi">Chi nhánh ngân hàng</label>
                                    <input id="diachi" type="text" class="form-control" name="chinhanh" value="">
                                </div>
                                <input type="submit" value="Rút tiền" name="ruttien" class="btn btn-warning mb-1">                      
                            </div>
                        </div>    
                    </div>               
                </div> 
            </form>  
        </div>
         
          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
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