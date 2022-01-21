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
      
      <li class="nav-item active">
        <a class="nav-link" href="./lendon_user.php">
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
            <a class="collapse-item" href="./chobangiao_user.php">Chờ bàn giao</a>
            <a class="collapse-item" href="./cholayhang_user.php">Chờ lấy hàng</a>
            <a class="collapse-item" href="./danggiao_user.php">Đang giao</a>
            <a class="collapse-item" href="./hoantat_user.php">Hoàn tất</a>
            <a class="collapse-item" href="./hoantat_user.php">Hoàn hàng</a>
          </div>
        </div>
      </li>
      
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link " href="./doisoat_user.php">
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

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Lên đơn hàng</h1>
              
            </div>
            <?php
                //phi giao hang
                $selGHC =  mysqli_query($conn,"SELECT * FROM phi WHERE ten = 'Giao hàng chuẩn'");
                $GHC = mysqli_fetch_array($selGHC);
                $selGHN =  mysqli_query($conn,"SELECT * FROM phi WHERE ten = 'Giao hàng nhanh'");
                $GHN = mysqli_fetch_array($selGHN);
            ?>
            <form action="./updateTrangThai.php" method = "post" enctype="multipart/form-data" onsubmit="return validateForm()" name="formLenDon">
            <input type="hidden" name="maKH" value="<?php echo $kh['ma'];?>">
              <div class="row">
                <div class="col-lg-6">
                  <!-- Select2 -->
                  <!-- nếu đăng nhập rồi thì lấy thông tin có sẳn trong database -->
                  <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Bên gửi</h6>
                    </div>
                    <div class="card-body">        
                      <div class="form-group">
                          <label for="hoten1">Họ tên</label>
                          <input id="hoten1" type="text" class="form-control" name="htenNG" value="<?php echo $kh['hoten'];?>">
                          <label for="hoten1" class="mess"id="hoten1_mess">Vui lòng nhập trường này!</label>
                      </div>
                      <div class="form-group">
                          <label for="sdt1">Số điện thoại</label>
                          <input id="sdt1" type="text" class="form-control" name="sdtNG" value="<?php echo $kh['sdt'];?>">
                          <label for="sdt1" class="mess">Vui lòng nhập trường này!</label>
                      </div>
                      <div class="form-group">
                          <label for="diachi1">Địa chỉ</label>
                          <input id="diachi1" type="text" class="form-control" name="dcNG" value="<?php echo $kh['diachi'];?>">
                          <label for="diachi1" class="mess">Vui lòng nhập trường này!</label>
                      </div>
                      
                    </div>
                  </div>
    
                </div>
               
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Bên nhận</h6>
                    </div>
                    <div class="card-body">                                      
                      <div class="form-group">
                          <label for="hoten">Họ tên</label>
                          <input id="hoten" type="text" class="form-control"name="htenNN">
                          <label for="hoten" class="mess">Vui lòng nhập trường này!</label>
                      </div>
                      <div class="form-group">
                          <label for="sdt">Số điện thoại</label>
                          <input id="sdt" type="text" class="form-control" name="sdtNN">
                          <label for="sdt" class="mess">Vui lòng nhập trường này!</label>
                      </div>
                      <div class="form-group">
                          <label for="diachi">Địa chỉ</label>
                          <input id="diachi" type="text" class="form-control"name="dcNN">
                          <label for="diachi" class="mess">Vui lòng nhập trường này!</label>
                      </div>
                     
                    </div>
                  </div>
                </div>
              </div>
              <!--Row-->
    
              <div class="row">
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Thông tin gói hàng</h6>
                    </div>
                    <div class="card-body">                   
                      <div class="form-group">
                        <label for="touchSpin1">Tên sản phẩm</label>
                        <input id="touchSpin1" type="text" class="form-control" name="tensp">
                        <label for="touchSpin1" class="mess">Vui lòng nhập trường này!</label>
                      </div>
                      <div class="form-group ">
                        <label for="touchSpin2">Hình ảnh</label>
                        <input id="touchSpin2" type="file" class="form-control" name="hinh" >
                        <label for="touchSpin2" class="mess">Vui lòng nhập trường này!</label>
                      </div>
                  
                      <div class="form-group">
                        <label for="touchSpin3">Tiền thu hộ</label>
                        <input id="touchSpin3" type="text" class="form-control" name="tien">
                        <label for="touchSpin3" class="mess">Vui lòng nhập trường này!</label>
                      </div>
                      <div class="form-group">
                          <label for="select2SinglePlaceholder">Tùy chọn thanh toán</label>
                          <select class="select2-single-placeholder form-control" name="tuychon" id="select2SinglePlaceholder" >
                              
                            <option value="Bên gửi trả phí">Bên gửi trả phí</option>
                            <option value="Bên nhận trả phí">Bên nhận trả phí</option>                                                                       
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="select2SinglePlaceholder1">Gói cước</label>
                          <select class="select2-single-placeholder form-control" name="goicuoc" id="select2SinglePlaceholder1" >
                              
                            <option value="<?php echo $GHC[1];?>"><?php echo $GHC[0];?> - <?php echo $GHC[1];?>đ</option>
                            <option value="<?php echo $GHN[1];?>"><?php echo $GHN[0];?> - <?php echo $GHN[1];?>đ</option>                                                                       
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="select2SinglePlaceholder2">Hình thức gửi hàng</label>
                          <select class="select2-single-placeholder form-control" name="guihang" id="select2SinglePlaceholder2" >
                              
                            <option value="Lấy hàng tận nơi">Lấy hàng tận nơi</option>
                            <option value="Gửi hàng tại bưu cục">Gửi hàng tại bưu cục</option>                                                                       
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleFormControlTextarea1">Ghi chú</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Vd: cho xem hàng" name="ghichu"  value="NULL"></textarea>
                      </div>                     
                      <input type="submit" value="Tạo đơn" name="tao" class="btn btn-warning mb-1">
                    </div>
                  </div>
                </div>             
              </div>
              <style>
                  .erro{
                      border-color: red;
                  }
                  .mess{
                    color:red;
                    display: none;
                  }
                  
                </style>
                <script>
                      function validateForm() {                         
                          var htNG = document.getElementById("hoten1");
                          var sdtNG = document.getElementById("sdt1");
                          var dcNG = document.getElementById("diachi1");
                          var htNN = document.getElementById("hoten");
                          var sdtNN = document.getElementById("sdt");
                          var dcNN = document.getElementById("diachi");
                          var tensp = document.getElementById("touchSpin1");
                          var hinh = document.getElementById("touchSpin2");
                          var tien = document.getElementById("touchSpin3");

                          if (htNG.value == null || htNG.value == "") {  
                              alert("Thông tin không đầy đủ!");                           
                              htNG.classList.add('erro');
                              return false;
                          }else if (sdtNG.value == null || sdtNG.value == "") {
                              alert("Thông tin không đầy đủ!");
                              sdtNG.classList.add('erro');
                              return false;                          
                          }else if(dcNG.value == null || dcNG.value == ""){
                            alert("Thông tin không đầy đủ!");
                            dcNG.classList.add('erro');
                            return false;
                          }else if(htNN.value == null || htNN.value == ""){
                            alert("Thông tin không đầy đủ!");
                            htNN.classList.add('erro');
                            return false;
                          }else if(sdtNN.value == null || sdtNN.value == ""){
                            alert("Thông tin không đầy đủ!");
                            sdtNN.classList.add('erro');
                            return false;
                          }else if(dcNN.value == null || dcNN.value == ""){
                            alert("Thông tin không đầy đủ!");
                            dcNN.classList.add('erro');
                            return false;
                          }else if(tensp.value == null || tensp.value == ""){
                            alert("Thông tin không đầy đủ!");
                            sdtNN.classList.add('erro');
                            return false;
                          }else if(hinh.value == null || hinh.value == ""){
                            alert("Thông tin không đầy đủ!");
                            hinh.classList.add('erro');
                            return false;
                          }else if(tien.value == null || tien.value == ""){
                            alert("Thông tin không đầy đủ!");
                            tien.classList.add('erro');
                            return false;
                          }
                          var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                          var mobile = $('#sdt').val();
                          if(mobile !==''){
                              if (vnf_regex.test(mobile) == false) 
                              {
                                  alert('Số điện thoại của bạn không đúng định dạng!');
                                  sdtNN.classList.add('erro');
                                  return false;
                              }
                          }else if($('#sdt1').val() !==''){
                              if (vnf_regex.test(mobile) == false) 
                              {
                                  alert('Số điện thoại của bạn không đúng định dạng!');
                                  sdtNG.classList.add('erro');
                                  return false;
                              }
                          }  
                          const file = hinh.files[0];
                          const  fileType = file['type'];
                          const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
                          if (!validImageTypes.includes(fileType)) {                             
                              alert('Không phải file ảnh!');
                              hinh.classList.add('erro');
                              return false;
                          }   
                          if(typeof tien.value !=='string' || tien.value <0){
                            alert("Tiền thu hộ không đúng định dạng!");
                            tien.classList.add('erro');
                            return false;
                          }                     
                        
                      }
                </script>
              <!-- Row -->
            </form>
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