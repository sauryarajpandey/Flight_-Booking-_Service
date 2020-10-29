<?php
  require_once("otpget.php");
  require_once("db.php");
  require_once("textlocal.class.php");
  echo "OTP sent sucessfully to the registered mobile number";
  if (isset($_POST["otpsub"])){
    if ($_COOKIE["otp"] == $_POST["otpver"]){
        header("Location: passengerchoice.html");
    }
    else{
      echo "OTP is incorrect";
    }
  }
  if (isset($_POST["reotp"])){
    $reget = new otpget($con,$_SESSION["userLoggedIn"]);
    $address = $reget->getcred();
    $number = array($address);
    $otp = $reget->generate_otp();
    setcookie('otp',$otp,time() + 120);
    $reget->send($number, $otp);
    echo "OTP resend successfull";
    }
 ?>

 <!DOCTYPE HTML>
 <html>
 <head>
   <style>
 		*{
 			margin: 0;
 			padding: 0;
 			font-family: Century Gothic;
 		}
 		body{
 background-color:black;
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
   <div class="title"><h1> ENTER YOUR OTP</h1> </div>
   <form method ="POST" action="">

   	<table class="a" width=40%>
       <tr>
         <td>
   <input type="text" name="otpver"><br>
 </td>
 </tr>
 <tr>
   <td>
   <input  type="submit" name="otpsub" value="Submit" class="sendotpbutton">
   <input type="submit" name="reotp" value="Resend" class="reotpbutton">
 </td>
 </tr>
   </form>
 </body>
 </html>
