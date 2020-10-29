<?php
  require_once("db.php");
  require_once("otpget.php");
    if (isset($_POST["submit"])){
    $query =  $con -> prepare("SELECT * FROM dd WHERE Name = :un AND Pass = :pw ");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query -> bindValue(":un",$username);
    $query -> bindValue(":pw", $password);
    $query -> execute();
    if ($query -> rowCount() == 1){
      $_SESSION["userLoggedIn"] = $username;
            $get = new otpget($con,$_SESSION["userLoggedIn"]);
            $address = $get->getcred();
            $number = array($address);
            $otp = $get->generate_otp();
            setcookie('otp',$otp,time() + 120);
            $get->send($number, $otp);
            header("Location: otp.php");
    }
    else{
      echo '<script>window.alert("Either the username or password is incorrect");</script>';
    }




}




?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		*{
			margin: 0;
			padding: 0;
			font-family: Century Gothic;
		}
		body{

			background-image:url(plane.jpg);
			height: 100vh;
			background-size: cover;
			background-position: center;
		}
		ul{
			float: right;
			list-style-type: none;
			margin-top: 25px;
		}
		ul li{
			display: inline-block;
		}
		ul li a{
			text-decoration: none;
			color: #fff;
			padding: 5px 20px;
			border: 1px solid #fff;
			transition: 0.6s ease;
		}
		ul li a:hover{
			background-color: #fff;
			color: #000;
		}
		ul li.active a{
			background-color: #fff;
			color: #000;
		}
		.title{
			position: absolute;
			top: 30%;
			left: 50%;
			transform: translate(-50%,-50%);
		}
		.title h1{
			color: #fff;
			font-size: 70px;
		}
		table.a{
			position: absolute;
			top: 60%;
			left: 50%;
			transform: translate(-50%,-50%);
			border: 1px solid #fff;
			padding: 10px 30px;
			color: #fff;
			text-decoration: none;
			transition: 0.6s ease;
			font-size: 25px;
		}
		input[type=submit]{
			border: 1px solid #fff;
			padding: 10px 30px;
			text-decoration: none;
			transition: 0.6s ease;
		}
		input[type=submit]:hover{
			background-color: #fff;
			color: #000;
		}
		input[type=text],input[type=password]{
		  width: 100%;
		  padding: 12px 20px;
		  margin: 8px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		}
	</style>
</head>
<body>

	<div class="title">
		<h1>Login to your account</h1>
	</div>
	<form action="" method="POST">
		<table class="a" width=40%>
			<tr>
				<td>
					User Name:
        </td>
				<td>
					<input type="text" placeholder="User Name" name="username" required>
				</td>
			</tr>

			<tr>
				<td>
					Password:
				</td>
				<td>
					<input type="password" placeholder="Password" name="password" required>
				</td>
			</tr>

			<tr>
				<td>
					<input type="submit" name="submit">

				</td>

			</tr>
    </form>
</body>
</html>
