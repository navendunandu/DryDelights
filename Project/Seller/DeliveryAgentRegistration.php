
<?php
session_start();
include("../Assets/Connection/Connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

function deliveryAgentWelcomeEmail($agentEmail, $agentName, $sellerName) {
    $mail = new PHPMailer(true);
    $webMail="drydelights36@gmail.com";
    $app_password="";
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $webMail; // Your Gmail
    $mail->Password = $app_password; // Your Gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($webMail, 'DryDelights'); // Your Gmail with sender name

    $mail->addAddress($agentEmail);

    $mail->isHTML(true);
    $message = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Welcome to DryDelights Delivery Team</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px; }
            .container { background: #fff; border-radius: 5px; padding: 20px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
            .header { font-size: 24px; margin-bottom: 20px; color: #3498db; }
            .footer { font-size: 12px; color: #999; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                Welcome to DryDelights, Delivery Agent!
            </div>
            <p>Dear " . htmlspecialchars($agentName) . ",</p>
            <p>We are excited to welcome you to the DryDelights team as a delivery agent. You were registered by " . htmlspecialchars($sellerName) . " and are now part of our growing network of trusted delivery partners.</p>
            <p>Here are some important next steps to help you get started:</p>
            <ul>
                <li>Review your account details and ensure all information is up-to-date.</li>
                <li>Check out our Delivery Guidelines and Best Practices to provide excellent service.</li>
                <li>Stay connected with your seller to receive delivery assignments.</li>
            </ul>
            <p>If you have any questions or need support, please do not hesitate to reach out to us.</p>
            <p>Best regards,<br>DryDelights Team</p>
            <div class='footer'>
                This is an automated message. Please do not reply.
            </div>
        </div>
    </body>
    </html>
    ";

    $mail->Subject = "Welcome to DryDelights, Delivery Agent!";
    $mail->Body = $message;

    if($mail->send()) {
        echo "<script>
                alert('Delivery agent welcome email sent successfully');
              </script>";
    } else {
        echo "<script>
                alert('Failed to send delivery agent welcome email');
              </script>";
    }
}


  if(isset($_POST["btn_submit"]))
  {
	  $sellerid=$_SESSION['sid'];
	  $name=$_POST["txt_name"];
	  $gender=$_POST["rd_gender"];
	  $email=$_POST["txt_email"];
	  $password=$_POST["txt_password"];
	  $confirm=$_POST["txt_confirm"];
	  
	  
	   $photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/'.$photo);
	 $contact=$_POST["txt_contact"];
	 
	 $insQry="insert into tbl_deliveryagent(deliveryagent_name,deliveryagent_gender,deliveryagent_email,deliveryagent_password,deliveryagent_photo,deliveryagent_contact,seller_id)values('$name','$gender','$email','$password','$photo','$contact',$sellerid)";
	  if($con->query($insQry))
	  {
        deliveryAgentWelcomeEmail($email, $name, $_SESSION['sname']);
	  }
	  else
	  {
		  echo "Error";
	  }
  }
  ob_start();
include("Head.php");
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<br><br><br>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<div class="container my-5">
    <h2 class="text-center mb-4">Delivery Agent Registration</h2>

    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="txt_name" class="form-label">Name</label>
            <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rd_gender" id="rd_gender1" value="Male" required>
                <label class="form-check-label" for="rd_gender1">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rd_gender" id="rd_gender2" value="Female">
                <label class="form-check-label" for="rd_gender2">Female</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="txt_email" class="form-label">Email</label>
            <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
            <label for="txt_password" class="form-label">Password</label>
            <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Enter your password" required>
        </div>

        <div class="mb-3">
            <label for="txt_confirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="txt_confirm" id="txt_confirm" placeholder="Confirm your password" required>
        </div>

        <div class="mb-3">
            <label for="file_photo" class="form-label">Photo</label>
            <input type="file" class="form-control" name="file_photo" id="file_photo" required>
        </div>

        <div class="mb-3">
            <label for="txt_contact" class="form-label">Contact</label>
            <input type="text" class="form-control" name="txt_contact" id="txt_contact" placeholder="Enter your contact number" required>
        </div>

        <div class="d-grid gap-2 d-md-block text-center">
            <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
            <button type="reset" name="btn_cancel" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html><br><br><br>
<?php
include("Foot.php");
ob_flush();
?>

