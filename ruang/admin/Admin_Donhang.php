<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <a href=""></a>
    <link rel="stylesheet" href="../css/dinhdo/gird.css">
    <link rel="stylesheet" href="../css/dinhdo/responsive.css">
    <link rel="stylesheet" href="../pcoint/css/Admin/Post_Admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/AE_Admin.css">
    <link rel="stylesheet" href="../css/Admin.css">
    <title>Anyar</title>

</head>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        /* border: 1px solid #dddddd; */
        text-align: center;
        padding: 5px;
        text-indent: 20px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    table a {
        text-decoration: none;
    }
</style>

<body>
    <!--  menu -->
    <div class="menu">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">Manager Page</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="Admin_User.php">User</a></li>
                    <li class="active"><a href="Admin_ListUser.php">Level User</a></li>
                    <li><a href="#">Page 2</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>

                </ul>
            </div>
        </nav>
    </div>
    <!--     end menu -->
    <!-- list -->
    <div class="container">

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-7">
                        <h2>Level User <b>Details</b></h2>
                    </div>
                    <div class="col-sm-4">
                        <nav class="navbar navbar-light bg-light">
                            <form class="form-inline">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </nav>

                    </div>
                </div>
            </div>
            <div class="app__container">
                <div class="grid wide">
                    <div class="row">

                        <div class="col l-12 m-12 c-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Người Gửi</th>
                                        <th>Tên Người Nhận</th>
                                        <th>SDT Người Gửi</th>
                                        <th>SDT Người Nhận</th>
                                        <th>DC Người Gửi</th>
                                        <th>DC Người Nhận</th>
                                        <th>Tên Đơn Hàng</th>
                                        <th>Tiền thu hộ</th>
                                        <th>Ghi chú</th>
                                        <th>Trạng thái</th>
                                        <th>Thanh toán</th>
                                        <th>Ngày</th>
                                        <th colspan="2">Function</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "dbConn.php"; // Using database connection file here

                                    $records = mysqli_query($db, "select * from donhang"); // fetch data from database

                                    while ($data = mysqli_fetch_array($records)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $data['id'] ?></td>
                                            <td><?php echo $data['tenNG'] ?></td>
                                            <td><?php echo $data['tenNN'] ?></td>
                                            <td><?php echo $data['sdtNG'] ?></td>
                                            <td><?php echo $data['sdtNN'] ?></td>
                                            <td><?php echo $data['diachiNG'] ?></td>
                                            <td><?php echo $data['diachiNN'] ?></td>
                                            <td><?php echo $data['tendh'] ?></td>
                                            <td><?php echo $data['tienthuho'] ?></td>
                                            <td><?php echo $data['ghichu'] ?></td>
                                            <td><?php echo $data['trangthai'] ?></td>
                                            <td><?php echo $data['thanhtoan'] ?></td>
                                            <td><?php echo $data['ngay'] ?></td>
                                            <td><a href="editDH.php?id=<?php echo $data['id']; ?>">Edit</a></td>
                                            <td><a href="deleteDH.php?id=<?php echo $data['id']; ?>">Delete</a></td>

                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!--     end list -->
</body>

</html>