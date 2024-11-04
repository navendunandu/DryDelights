<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

function accountApprovedEmail($email, $name) {
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

    $mail->addAddress($email);

    $mail->isHTML(true);
    $message = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Account Approved</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px; }
        .container { background: #fff; border-radius: 5px; padding: 20px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { font-size: 24px; margin-bottom: 20px; color: #28a745; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; }
        .button { display: inline-block; padding: 10px 20px; color: #fff; background-color: #28a745; text-decoration: none; border-radius: 5px; font-size: 16px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            Congratulations, " . htmlspecialchars($name) . "!
        </div>
        <p>Hi " . htmlspecialchars($name) . ",</p>
        <p>Your seller account on DryDelights has been approved! You can now log in and start listing your products.</p>
        <p>We are excited to have you onboard and look forward to seeing your success on our platform.</p>
        <a href='https://yourwebsite.com/login' class='button'>Log in to your account</a>
        <p>Best regards,<br>DryDelights Team</p>
        <div class='footer'>
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
";

    $mail->Subject = "Your DryDelights Seller Account Has Been Approved!";
    $mail->Body = $message;

    if($mail->send()) {
        echo "<script>
                alert('Account approval email sent successfully');
              </script>";
    } else {
        echo "<script>
                alert('Failed to send approval email');
              </script>";
    }
}

function accountRejectedEmail($email, $name) {
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

    $mail->addAddress($email);

    $mail->isHTML(true);
    $message = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Account Rejection</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px; }
        .container { background: #fff; border-radius: 5px; padding: 20px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { font-size: 24px; margin-bottom: 20px; color: #d9534f; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            Account Application Status
        </div>
        <p>Dear " . htmlspecialchars($name) . ",</p>
        <p>Thank you for your interest in becoming a seller on DryDelights. After reviewing your application, we regret to inform you that your account request has been declined.</p>
        <p>If you have any questions or believe this decision was made in error, please feel free to reach out to our support team for further clarification.</p>
        <p>Thank you for your understanding.</p>
        <p>Best regards,<br>DryDelights Team</p>
        <div class='footer'>
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
";

    $mail->Subject = "DryDelights Seller Account Application Update";
    $mail->Body = $message;

    if($mail->send()) {
        echo "<script>
                alert('Account rejection email sent successfully');
              </script>";
    } else {
        echo "<script>
                alert('Failed to send rejection email');
              </script>";
    }
}




if(isset($_GET['aID']))
{
	$upQry="update tbl_seller SET seller_status='1' WHERE seller_id=".$_GET['aID'];
	if($con->query($upQry))
	{
		$selData="select * from tbl_seller where seller_id = ".$_GET['aID'];
        $selRes=$con->query($selData);
        $selRow=$selRes->fetch_assoc();
        accountApprovedEmail($selRow['seller_email'], $selRow['seller_name']);
	}
}
	if(isset($_GET['rID']))
	{
	$upQry="update tbl_seller SET seller_status='2' WHERE seller_id=".$_GET['rID'];
	if($con->query($upQry))
	{
		$selData="select * from tbl_seller where seller_id = ".$_GET['aID'];
        $selRes=$con->query($selData);
        $selRow=$selRes->fetch_assoc();
        accountRejectedEmail($selRow['seller_email'], $selRow['seller_name']);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
   
   <div class="container-fluid">
    <h2 class="text-center mb-4">New Seller List</h2>

    <form id="form1" name="form1" method="post" action="">
        <table class="table table-bordered table-hover table-striped table-responsive">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">Location</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Email</th>
                    <th scope="col">Photo</th>
                   
                    <th scope="col">Logo</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry="select * from tbl_seller n inner join tbl_place p on n.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where seller_status=0";
                $result=$con->query($selQry);
                $i=0;
                while($data=$result->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['district_name'].", ".$data['place_name'] ?></td>
                    <td><?php echo $data['seller_name']; ?></td>
                    <td><?php echo $data['seller_gender']; ?></td>
                    <td><?php echo $data['seller_contact']; ?></td>
                    <td><?php echo $data['seller_email']; ?></td>
                    <td><img src="../Assets/Files/Userdocs/<?php echo $data['seller_photo']; ?>" class="img-thumbnail" width="100" height="100"></td>
                   
                    <td><img src="../Assets/Files/Userdocs/<?php echo $data['seller_logo']; ?>" class="img-thumbnail" width="100" height="100"></td>
                    <td>
                        <a href="NewSellerList.php?aID=<?php echo $data['seller_id']?>" class="btn btn-success btn-sm">Accept</a>
                        <a href="NewSellerList.php?rID=<?php echo $data['seller_id']?>" class="btn btn-danger btn-sm">Reject</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>