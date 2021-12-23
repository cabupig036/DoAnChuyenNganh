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
            <a class="collapse-item" href="./hoantat.php">Hoàn hàng</a>
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
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">Maman Ketoprak</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
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
            <form action="./updateTrangThai.php" method = "post">
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
                          <label for="hoten">Họ tên</label>
                          <input id="hoten" type="text" class="form-control" name="htenNG">
                      </div>
                      <div class="form-group">
                          <label for="sdt">Số điện thoại</label>
                          <input id="sdt" type="text" class="form-control" name="sdtNG">
                      </div>
                      <div class="form-group">
                          <label for="diachi">Địa chỉ</label>
                          <input id="diachi" type="text" class="form-control" name="dcNG">
                      </div>
                      <!-- <div class="form-group">
                        <label for="select2Single">Phường - Xã</label>
                        <select class="select2-single form-control" name="state" id="select2Single">
                          <option value="">Select</option>
                          <option value="Aceh">Aceh</option>
                          <option value="Sumatra Utara">Sumatra Utara</option>
                          <option value="Sumatra Barat">Sumatra Barat</option>                       
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="select2SinglePlaceholder">Quận - Huyện</label>
                        <select class="select2-single-placeholder form-control" name="state" id="select2SinglePlaceholder">
                          <option value="">Select</option>
                          <option value="Aceh">Aceh</option>
                          <option value="Sumatra Utara">Sumatra Utara</option>
                          <option value="Sumatra Barat">Sumatra Barat</option>
                          <option value="Riau">Riau</option>
                          <option value="Kepulauan Riau">Kepulauan Riau</option>                                                
                        </select>
                      </div>                    -->
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
                      </div>
                      <div class="form-group">
                          <label for="sdt">Số điện thoại</label>
                          <input id="sdt" type="text" class="form-control" name="sdtNN">
                      </div>
                      <div class="form-group">
                          <label for="diachi">Địa chỉ</label>
                          <input id="diachi" type="text" class="form-control"name="dcNN">
                      </div>
                      <!-- <div class="form-group">
                        <label for="select2Single">Phường - Xã</label>
                        <select class="select2-single form-control" name="state" id="select2Single">
                          <option value="">Select</option>
                          <option value="Aceh">Aceh</option>
                          <option value="Sumatra Utara">Sumatra Utara</option>
                          <option value="Sumatra Barat">Sumatra Barat</option>                       
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="select2SinglePlaceholder">Quận - Huyện</label>
                        <select class="select2-single-placeholder form-control" name="state" id="select2SinglePlaceholder">
                          <option value="">Select</option>
                          <option value="Aceh">Aceh</option>
                          <option value="Sumatra Utara">Sumatra Utara</option>
                          <option value="Sumatra Barat">Sumatra Barat</option>
                          <option value="Riau">Riau</option>
                          <option value="Kepulauan Riau">Kepulauan Riau</option>                                                
                        </select>
                      </div>                    -->
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
                      </div>
                  
                      <div class="form-group">
                        <label for="touchSpin2">Tiền thu hộ</label>
                        <input id="touchSpin2" type="text" class="form-control" name="tien">
                      </div>
                      <div class="form-group">
                          <label for="select2SinglePlaceholder">Tùy chọn thanh toán</label>
                          <select class="select2-single-placeholder form-control" name="tuychon" id="select2SinglePlaceholder" >
                              
                            <option value="Bên gửi trả phí">Bên gửi trả phí</option>
                            <option value="Bên nhận trả phí">Bên nhận trả phí</option>                                                                       
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleFormControlTextarea1">Ghi chú</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Vd: cho xem hàng" name="ghichu"></textarea>
                      </div>                     
                      <input type="submit" value="Tạo đơn" name="tao" class="btn btn-warning mb-1">
                    </div>
                  </div>
                </div>             
              </div>
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