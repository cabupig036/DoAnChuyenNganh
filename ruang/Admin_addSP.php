<?php
	//Create connect data 
	require('./config/conndb.php');
    $name=isset($_POST['name'])?$_POST['name']:"";
    $email=isset($_POST['email'])?$_POST['email']:"";
    $phone=isset($_POST['phone'])?$_POST['phone']:"";
    $address=isset($_POST['address'])?$_POST['address']:"";
    $password=isset($_POST['password'])?$_POST['password']:" ";
    $confirmpass=isset($_POST['confirmpass'])?$_POST['confirmpass']:" ";

		//Kiểm tra độ dài email có vượt quá 20 không
		if (strlen($name) > 30) {
			// Sử dụng javascript để thông báo
			echo '<script language="javascript">alert("Name vượt quá 30 ký tự"); window.location="Register.php";</script>';
			// Dừng chương trình
			die();
		}

		// Kiểm tra password có vượt quá 20 không
		if (strlen($password) > 30) {
			echo '<script language="javascript">alert("Password vượt quá 30 ký tự"); window.location="Register.php";</script>';
			die();
		}

		//Xem xác nhận passoword có trùng khớp không
		if ($password != $confirmpass) {
			echo '<script language="javascript">alert("Xác nhận password không trùng khớp"); window.location="Register.php";</script>';
			die();
		}

		//Kiểm tra ký tự đặc biệt
		if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name)) {
			echo '<script language="javascript">alert("Tên không được chứa kí tự đặc biệt"); window.location="Register.php";</script>';
			die();
		}

		//Kiểm tra dữ liệu có bị trùng không
		// Thực thi câu truy vấn
		$sql = "SELECT * FROM  `user` WHERE  email = '$email'";
		echo $sql;
		$result = mysqli_query($conn, $sql);
		//Nếu kết quả trả về lớn hơn 1 thì nghĩa là name hoặc email đã tồn tại trong CSDL
		if (mysqli_num_rows($result) > 0) {
			echo '<script language="javascript">alert("Email đã tồn tại"); window.location="./Admin_User.php";</script>';
			die();
		} else {
			// Ngược lại thì thêm bình thường
			$sql = "INSERT INTO `user` (`ma`, `hoten`, `sdt`, `email`, `password`, `diachi`, `role`)
			 VALUES (NULL, '$name', '$phone', '$email', '" . md5($password) . "', '$address', '2');";

			if (mysqli_query($conn, $sql)) {
				session_start();
				if (!isset($_SESSION["name"])) {
					echo '<script language="javascript">alert("Đăng ký thành công"); window.location="./Admin_User.php";</script>';
					exit();
				}
			} else {
				echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="./Admin_User.php";</script>';
			}
		}
	?>