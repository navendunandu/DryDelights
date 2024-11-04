<?php
include("../Assets/Connection/Connection.php");
session_start();
 if(isset($_POST["btn_login"]))
 {
	 $email=$_POST["txt_email"];
      $password=$_POST["txt_password"];
	  
	  $selUser="select * from tbl_user where user_email='".$email."' and user_password='".$password."'";
	   $selAdmin="select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";
	  $selSeller="select * from tbl_seller where seller_email='".$email."' and seller_password='".$password."'";
	  $SelDAgent="select * from tbl_deliveryagent where deliveryagent_email='".$email."' and deliveryagent_password='".$password."'";
	  
	  $resUser=$con->query($selUser);
	   $resAdmin=$con->query($selAdmin);
	 $resSeller=$con->query($selSeller);
	 $resDAgent=$con->query($SelDAgent);
	 
	  if($userData=$resUser->fetch_assoc())
	  {
		   $_SESSION['uid']=$userData['user_id'];
		  $_SESSION['uname']=$userData['user_name'];
		  header("location:../User/HomePage.php");
	  }
	  else if($adminData=$resAdmin->fetch_assoc())
	  {
		  $_SESSION['aid']=$adminData['admin_id'];
		  $_SESSION['aname']=$adminData['admin_name'];
		  header("location:../Admin/HomePage.php");
	  }
	  else if($sellerData=$resSeller->fetch_assoc())
	  {
		   $_SESSION['sid']=$sellerData['seller_id'];
		  $_SESSION['sname']=$sellerData['seller_name'];
		  header("location:../Seller/SellerHomePage.php");
	  }
	  else if($DAgentData=$resDAgent->fetch_assoc())
	  {
		  $_SESSION['did']=$DAgentData['deliveryagent_id'];
		  $_SESSION['dname']=$DAgentData['deliveryagent_name'];
	      header("location:../DeliveryAgent/HomePage.php");
	  
	  
	  }
	  else
	 {
		?>
        	<script>
			alert('Invalid Credential')
			</script>
        <?php  
	  }
 }
?> 
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" /></td>
    </tr>
	<tr>
		<a href="ForgetPassword.php">ForgetPassword</a>
</tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_login" id="btn_login" value="Login" /></td>
    </tr>
  </table>
</form>
</body>
</html> -->



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../Assets/Templates/Login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="../Assets/Templates/Login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">

    <title>Login #2</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('../Assets/Templates/Login/images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <!-- <h3>Login to <strong>Colorlib</strong></h3>
            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
            <form action="#" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="txt_email" placeholder="your-email@gmail.com" id="username">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="txt_password" placeholder="Your Password" id="password">
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="ForgetPassword.php" class="forgot-pass">Forgot Password</a></span> 
              </div>

              <input type="submit" value="Log In" name="btn_login" class="btn btn-block btn-primary">

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="../Assets/Templates/Login/js/jquery-3.3.1.min.js"></script>
    <script src="../Assets/Templates/Login/js/popper.min.js"></script>
    <script src="../Assets/Templates/Login/js/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Login/js/main.js"></script>
  </body>
</html>