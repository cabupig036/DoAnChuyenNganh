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

    * {
        box-sizing: border-box;
    }

    #myInput {
        background-image: url('/css/searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }

    #myTable {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 18px;
    }

    #myTable th,
    #myTable td {
        text-align: left;
        padding: 12px;
    }

    #myTable tr {
        border-bottom: 1px solid #ddd;
    }

    #myTable tr.header,
    #myTable tr:hover {
        background-color: #f1f1f1;
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
                                    <h2>Quản lý Shipper</h2>
                                </div>
                                <div class="col-sm-4">
                                    <nav class="navbar navbar-light bg-light">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                    </nav>

                                </div>
                            </div>
                        </div>
                        <!--List-->
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-warning mb-1" data-toggle="modal" data-target="#myModal"><i
                            class="fa fa-plus"></i> Add New</button>
                    <!--  popup add -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Shipper</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="./Admin_addSP.php" method='post' enctype='multipart/form-data'>
                                        Name <input type="text" name='name' class="form-control"> <br>
                                        Email <input type="email" name='email' class="form-control"> <br>
                                        Phone <input type="number" name='phone' class="form-control"> <br>
                                        Address <input type="text" name='address' class="form-control"> <br>
                                        Password<input type="password" name='password' class="form-control"> <br>
                                        Confirm Password<input type="password" name='confirmpass' class="form-control">
                                        <br>

                                        <input type="submit" value='Them moi'>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!--   end   poup add -->
                        </div>
                    </div>
                </div>
</body>
<form method="post">
    <table class="table align-items-center table-flush" id="myTable">
        <thead class="thead-light">
            <tr class="header">

                <th>Mã Shipper</th>
                <th>Họ Tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th colspan="2">Function</th>
            </tr>
        </thead>
        <tbody>
            <?php
                        include "./config/conndb.php"; // Using database connection file here
                        $records = mysqli_query($conn, "select * from user WHERE role = '2'"); // fetch data from database
                        while ($data = mysqli_fetch_array($records)) {
                        ?>
            <tr>
                <td><?php echo $data['ma'] ?></td>
                <td><?php echo $data['hoten'] ?></td>
                <td><?php echo $data['sdt'] ?></td>
                <td><?php echo $data['email'] ?></td>
                <td><?php echo $data['diachi'] ?></td>
                <td><a href="Admin_edit.php?ma=<?php echo $data['ma']; ?>">Edit</a></td>
                <td><a href="Admin_delete.php?ma=<?php echo $data['ma']; ?>">Delete</a></td>
            </tr>
            <?php
                        }
                        ?>
        </tbody>
    </table>
    </div>
    </div>
    <!--  endlist -->
</form>


<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<script>
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>
<script type="text/javascript">
  $(document).ready(function() {
      window.history.pushState(null, "", window.location.href);        
      window.onpopstate = function() {
          window.history.pushState(null, "", window.location.href);
      };
  });
</script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</body>

</html>