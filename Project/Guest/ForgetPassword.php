<?php

session_start();

include("../Assets/Connection/Connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

function generateOTP($length = 6) {
    $digits = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $digits[rand(0, strlen($digits) - 1)];
    }
    return $otp;
}

function otpEmail($email,$otp){
    $webMail="drydelights36@gmail.com";
$app_password="";
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $webMail; // Your gmail
    $mail->Password = $app_password; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
  
    $mail->setFrom($webMail, 'DryDelights'); // Your gmail
  
    $mail->addAddress($email);
  
    $mail->isHTML(true);
    $message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #fff;
            border-radius: 5px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Your OTP Code
        </div>
        <p>Hello,</p>
        <p>Here is your One-Time Password (OTP) for verification:</p>
        <h2 style="font-size: 36px; color: #333;">' . $otp . '</h2>
       <p>This OTP is valid for the next 5 minutes. Please use it to complete your verification process.</p>
        <p>If you did not request this OTP, please ignore this email or contact support if you have concerns.</p>
        <p>Best regards,<br>Dry Delights</p>
        <div class="footer">
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
';
    $mail->Subject = "Reset your password";  //Your Subject goes here
    $mail->Body = $message; //Mail Body goes here
  if($mail->send())
  {
    ?>
<script>
    alert("Email Send")
    window.location="OTP_Validator.php";
</script>
    <?php
  }
  else
  {
    ?>
<script>
    alert("Email Failed")
</script>
    <?php
  }
}

if(isset($_POST['btn_submit'])){
    $email=$_POST['txt_email'];
    $selUser="select * from tbl_user where user_email='".$email."'";	
	$selAdmin="select * from tbl_admin where admin_email='".$email."'";
	$selseller="select * from tbl_seller where seller_email='".$email."'";
	$seldeliveryagent="select * from tbl_deliveryagent where deliveryagent_email='".$email."'";
	$resUser=$con->query($selUser);
    $resAdmin=$con->query($selAdmin);
	$resseller=$con->query($selseller);
	$resdeliveryagent=$con->query($seldeliveryagent);
    $otp = generateOTP();
    $_SESSION['otp'] = $otp;
    if($userData=$resUser->fetch_assoc())
	{
		$_SESSION['ruid'] = $userData['user_id'];
		otpEmail($email,$otp);
	}
	else if($adminData=$resAdmin->fetch_assoc())
	{
		$_SESSION['raid'] = $adminData['admin_id'];
		otpEmail($email,$otp);
	}
	else if($sellerData=$resseller->fetch_assoc())
	{
		$_SESSION['rwid'] = $sellerData['seller_id'];
		otpEmail($email,$otp);
	}
	else if($deliveryagentData=$resdeliveryagent->fetch_assoc())
	{
		$_SESSION['rsid'] = $deliveryagentData['deliveryagent_id'];
		otpEmail($email,$otp);
	}
	else{
	?>
    	<script>
		alert("Account Doesn't Exists")
		</script>
    <?php	
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-header h2 {
            font-weight: bold;
            color: #333;
        }
        .btn-primary {
            width: 100%;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Forgot Password</h2>
            <p>Please enter your email to reset your password.</p>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="txt_email">Email</label>
                <input type="email" class="form-control" name="txt_email" id="txt_email" required placeholder="Enter your email">
            </div>
            <button type="submit" class="btn btn-primary" name="btn_submit">Reset</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>
</html>