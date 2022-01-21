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
                                    <h2>Xử lý đơn hàng</h2>
                                </div>
                                <div class="col-sm-4">
                                    <nav class="navbar navbar-light bg-light">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                    </nav>

                                </div>
                            </div>
                        </div>

                        <table class="table align-items-center table-flush" id="myTable">

                            <thead class="thead-light">
                                <tr class="header">
                                    <th>ID Shipper</th>
                                    <th>ID Đơn hàng</th>
                                    <th>Tên đơn hàng</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên người nhận</th>
                                    <th>SDT người nhận</th>
                                    <th>Địa chỉ người nhận</th>
                                    <th>Tiền thu</th>
                                    <th>Cước phí</th>
                                    <th>Ghi chú</th>
                                    <th>Function</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
  include("./config/conndb.php"); 
  $sql = "SELECT * 
  FROM `donhang`
  JOIN `user`
  WHERE `user`.`role` = N'2' AND `donhang`.`trangthai` = N'0'";
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($data as $r) {
  ?>
                                <tr>
                                    <form action="./updateXulidon.php" method="post">
                                        <td><?php echo $r['ma'] ?></td>
                                        <td><?php echo $r['madh'] ?></td>
                                        <td><?php echo $r['tensp'] ?></td>
                                        <td class="zoom">
                                            <img src="./img/<?php echo $r['img'] ?>" style="width: 40px; height: 40px;">
                                        </td>
                                        <td><?php echo $r['tenNN'] ?></td>
                                        <td><?php echo $r['sdtNN'] ?></td>
                                        <td><?php echo $r['diachiNN'] ?></td>
                                        <td><?php echo $r['tienthuho'] ?></td>
                                        <td><?php echo $r['goicuoc'] ?></td>
                                        <td><?php echo $r['ghichu'] ?></td>

                                        <div class="input-group-append">
                                            <td> <input type="submit" value="Chọn Đơn Hàng" name="chondon1"
                                                    class="btn btn-warning mb-1" id="chondon">
                                            </td>
                                        </div>
                                        <input type="hidden" name="madh" value="<?php echo $r['madh'] ?>">
                                        <input type="hidden" name="ma" value="<?php echo $r['ma'] ?>">

                                </tr>
                                </form>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!--List-->
                    </div>
                </div>
</body>


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