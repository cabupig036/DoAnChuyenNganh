<!DOCTYPE html>
<html lang="en">

<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="get">
					<span class="login100-form-title">
						Member Register
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid name is required">
						<input class="input100" type="text" name="name" placeholder="Name" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Valid name is required">
						<input class="input100" type="number" name="phone" placeholder="Phone" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Valid name is required">
						<input class="input100" type="text" name="address" placeholder="Address" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="confirmpass" placeholder="Confirm Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
						</button></a>
					</div>
					<div class="text-center p-t-20">
						<a class="txt2" href="../Login_v1/Login.php">
							If you already have an account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	//Create connect data 
	require('db.php');
	if (isset($_REQUEST['name'])) {
		// removes backslashes
		$name = stripslashes($_REQUEST['name']);
		$email    = stripslashes($_REQUEST['email']);
		$phone    = stripslashes($_REQUEST['phone']);
		$address    = stripslashes($_REQUEST['address']);
		$password = stripslashes($_REQUEST['password']);
		$confirmpass = stripslashes($_REQUEST['confirmpass']);

		//Ki???m tra ????? d??i email c?? v?????t qu?? 20 kh??ng
		if (strlen($name) > 30) {
			// S??? d???ng javascript ????? th??ng b??o
			echo '<script language="javascript">alert("Name v?????t qu?? 30 k?? t???"); window.location="Register.php";</script>';
			// D???ng ch????ng tr??nh
			die();
		}

		// Ki???m tra password c?? v?????t qu?? 20 kh??ng
		if (strlen($password) > 30) {
			echo '<script language="javascript">alert("Password v?????t qu?? 30 k?? t???"); window.location="Register.php";</script>';
			die();
		}

		//Xem x??c nh???n passoword c?? tr??ng kh???p kh??ng
		if ($password != $confirmpass) {
			echo '<script language="javascript">alert("X??c nh???n password kh??ng tr??ng kh???p"); window.location="Register.php";</script>';
			die();
		}

		//Ki???m tra k?? t??? ?????c bi???t
		if (preg_match('/[\'^??$%&*()}{@#~?><>,|=_+??-]/', $name)) {
			echo '<script language="javascript">alert("T??n kh??ng ???????c ch???a k?? t??? ?????c bi???t"); window.location="Register.php";</script>';
			die();
		}

		//Ki???m tra d??? li???u c?? b??? tr??ng kh??ng
		// Th???c thi c??u truy v???n
		$sql = "SELECT * FROM  `user` WHERE  email = '$email'";
		echo $sql;
		$result = mysqli_query($conn, $sql);
		//N???u k???t qu??? tr??? v??? l???n h??n 1 th?? ngh??a l?? name ho???c email ???? t???n t???i trong CSDL
		if (mysqli_num_rows($result) > 0) {
			echo '<script language="javascript">alert("Email ???? t???n t???i"); window.location="Register.php";</script>';
			die();
		} else {
			// Ng?????c l???i th?? th??m b??nh th?????ng
			$sql = "INSERT INTO `user` (`ma`, `hoten`, `sdt`, `email`, `password`, `diachi`, `role`)
			 VALUES (NULL, '$name', '$phone', '$email', '" . md5($password) . "', '$address', '1');";

			if (mysqli_query($conn, $sql)) {
				session_start();
				if (!isset($_SESSION["name"])) {
					echo '<script language="javascript">alert("????ng k?? th??nh c??ng"); window.location="../Login_v1/Login.php";</script>';
					exit();
				}
			} else {
				echo '<script language="javascript">alert("C?? l???i trong qu?? tr??nh x??? l??"); window.location="Register.php";</script>';
			}
		}
	}
	?>
	<!--===============================================================================================-->

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>