<?php
include("../Assets/Connection/Connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';


function welcomeEmail($email, $name){
    $webMail="drydelights36@gmail.com";
$app_password="";
    $mail = new PHPMailer(true);

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
    <title>Welcome to DryDelights</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px; }
        .container { background: #fff; border-radius: 5px; padding: 20px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { font-size: 24px; margin-bottom: 20px; color: #e67e22; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            Welcome to DryDelights, " . htmlspecialchars($name) . "!
        </div>
        <p>Hi " . htmlspecialchars($name) . ",</p>
        <p>Thank you for joining DryDelights as a seller! We are thrilled to have you on board and can't wait to see the amazing products you will bring to our community.</p>
        <p><strong>Important:</strong> Your account is currently under review by our administrator. Once your account has been verified, you'll receive a notification, and you'll be able to log in and start selling.</p>
        <p>Warm regards,<br>DryDelights Team</p>
        <div class='footer'>
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
";


    $mail->Subject = "Welcome to DryDelights!";
    $mail->Body = $message;
  
    if($mail->send()) {
        echo "<script>
                alert('Welcome email sent successfully');
                window.location='Login.php';
              </script>";
    } else {
        echo "<script>
                alert('Email sending failed');
              </script>";
    }
}


if (isset($_POST["btn_submit"])) {
    $district = $_POST["selDistrict"];
    $place = $_POST["selplace"];
    $name = $_POST["txt_name"];
    $gender = $_POST["rd_gender"];
    $contact = $_POST["txt_contact"];
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];
    $confirm = $_POST["txt_confirm"];
    if($confirm==$password){
    $selUser = "select * from tbl_user where user_email='" . $email . "'";
    $selAdmin = "select * from tbl_admin where admin_email='" . $email . "'";
    $selSeller = "select * from tbl_seller where seller_email='" . $email . "'";
    $SelDAgent = "select * from tbl_deliveryagent where deliveryagent_email='" . $email . "'";

    $resUser = $con->query($selUser);
    $resAdmin = $con->query($selAdmin);
    $resSeller = $con->query($selSeller);
    $resDAgent = $con->query($SelDAgent);

    if ($resAdmin->num_rows > 0 || $resDAgent->num_rows > 0 || $resSeller->num_rows > 0 || $resUser->num_rows > 0) {
        echo "<script>alert('Email already exists. Please use another email address.');</script>";
    } else {
        $photo = $_FILES['file_photo']['name'];
        $tempphoto = $_FILES['file_photo']['tmp_name'];
        move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/' . $photo);

        $profile = $_FILES['file_proof']['name'];
        $tempphoto = $_FILES['file_proof']['tmp_name'];
        move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/' . $profile);

        $logo = $_FILES['file_logo']['name'];
        $tempphoto = $_FILES['file_logo']['tmp_name'];
        move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/' . $logo);

        $insQry = "insert into tbl_seller(district_id, place_id, seller_name, seller_gender, seller_contact, seller_email, seller_password, seller_photo, seller_proof, seller_logo) values('$district', '$place', '$name', '$gender', '$contact', '$email', '$password', '$photo', '$profile', '$logo')";

        if ($con->query($insQry)) {
            welcomeEmail($email,$name);
        } else {
            echo "Error";
        }
    }
    }
    else{
        ?>
        <script>
            alert('Password and Confirm Password does not match.');
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
<title>Seller Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    /* Custom CSS to make the form smaller */
    .form-container {
        max-width: 600px;
        font-size: 0.9rem;
        padding: 20px;
    }
    .form-container input, .form-container select, .form-container label {
        font-size: 0.9rem;
    }
</style>

<body>
<div class="container mt-5 form-container border shadow-sm p-4 rounded">
    <h2 class="text-center mb-4">Seller Registration</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="selDistrict" class="form-label">District</label>
                <select name="selDistrict" class="form-select" id="selDistrict" onchange="getPlace(this.value)" required>
                    <option value="">--- Select District ---</option>
                    <?php
                    $selQry = "select * from tbl_district";
                    $result = $con->query($selQry);
                    while ($data = $result->fetch_assoc()) {
                        echo "<option value='{$data['district_id']}'>{$data['district_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="selplace" class="form-label">Place</label>
                <select name="selplace" class="form-select" id="place" required>
                    <option value="">--- Select Place ---</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="txt_name" class="form-label">Name</label>
                <input type="text" name="txt_name" class="form-control" id="txt_name" required>
            </div>
            <div class="col-md-6">
                <label for="txt_contact" class="form-label">Contact</label>
                <input type="tel" name="txt_contact" class="form-control" id="txt_contact" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="txt_email" class="form-label">Email</label>
            <input type="email" name="txt_email" class="form-control" id="txt_email" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="txt_password" class="form-label">Password</label>
                <input type="password" name="txt_password" class="form-control" id="txt_password" required>
            </div>
            <div class="col-md-6">
                <label for="txt_confirm" class="form-label">Confirm Password</label>
                <input type="password" name="txt_confirm" class="form-control" id="txt_confirm" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label><br>
            <input type="radio" name="rd_gender" value="Male" required> Male
            <input type="radio" name="rd_gender" value="Female" required> Female
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="file_photo" class="form-label">Photo</label>
                <input type="file" name="file_photo" class="form-control" id="file_photo" required>
            </div>
            <div class="col-md-4">
                <label for="file_proof" class="form-label">Proof</label>
                <input type="file" name="file_proof" class="form-control" id="file_proof" required>
            </div>
            <div class="col-md-4">
                <label for="file_logo" class="form-label">Logo</label>
                <input type="file" name="file_logo" class="form-control" id="file_logo" required>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<script>
function getPlace(cid) {
    $.ajax({
        url: "../Assets/AjaxPages/Ajaxnewuser.php?cid=" + cid,
        success: function(result) {
            $("#place").html(result);
        }
    });
}
</script>

</body>
</html>
