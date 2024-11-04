<?php
include("../Assets/Connection/Connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';


function welcomeEmail($email, $name){
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
    $message = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to DryDelights</title>
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
                color: #e67e22;
            }
            .footer {
                font-size: 12px;
                color: #999;
                margin-top: 20px;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                color: #fff;
                background-color: #e67e22;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                Welcome to DryDelights, ' . htmlspecialchars($name) . '!
            </div>
            <p>Hi ' . htmlspecialchars($name) . ',</p>
            <p>Thank you for joining DryDelights! We are excited to have you as part of our community, where you wll find a wide range of quality products to explore and enjoy.</p>
            <p>To get the most out of your experience, feel free to browse our collections, save your favorite items, and reach out if you have any questions.</p>
            <a href="https://drydelights.com" class="button">Explore Now</a>
            <p>We are here to support you along the way. Welcome aboard!</p>
            <p>Warm regards,<br>DryDelights Team</p>
            <div class="footer">
                This is an automated message. Please do not reply.
            </div>
        </div>
    </body>
    </html>
    ';

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
    $place = $_POST["selPlace"];
    $name = $_POST["txt_name"];
    $address = $_POST["txt_address"];
    $gender = $_POST["rd_gender"];
    $contact = $_POST["txt_contact"];
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];
    $confirm = $_POST["txt_confirm"];

    $selUser = "select * from tbl_user where user_email='" . $email . "'";
    $selAdmin = "select * from tbl_admin where admin_email='" . $email . "'";
    $selSeller = "select * from tbl_seller where seller_email='" . $email . "'";
    $SelDAgent = "select * from tbl_deliveryagent where deliveryagent_email='" . $email . "'";

    $resUser = $con->query($selUser);
    $resAdmin = $con->query($selAdmin);
    $resSeller = $con->query($selSeller);
    $resDAgent = $con->query($SelDAgent);

    if ($resAdmin->num_rows > 0 || $resDAgent->num_rows > 0 || $resSeller->num_rows > 0 || $resUser->num_rows > 0) {
        echo "<script>alert('Mail id already exists');</script>";
    } else {
        $photo = $_FILES['file_photo']['name'];
        $tempphoto = $_FILES['file_photo']['tmp_name'];
        move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/' . $photo);

        $profile = $_FILES['file_proof']['name'];
        $tempphoto = $_FILES['file_proof']['tmp_name'];
        move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/' . $profile);

        $insQry = "insert into tbl_user(district_id, place_id, user_name, user_address, user_gender, user_contact, user_email, user_password, user_photo, user_proof) values ('$district', '$place', '$name', '$address', '$gender', '$contact', '$email', '$password', '$photo', '$profile')";

        if ($con->query($insQry)) {
            welcomeEmail($email, $name);
        } else {
            echo "Error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New User Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f0f2f5;
        /* background-image:url('../Assets/Templates/image.png');
        background-size:cover; */

        font-family: Arial, sans-serif;
    }
    .registration-card {
        max-width: 900px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .form-header {
        font-size: 1.7rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #495057;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #495057;
    }
</style>
</head>

<body>
<div class="container">
    <div class="registration-card">
        <div class="form-header text-center">
            User Registration
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="txt_name" class="form-label">Full Name</label>
                    <input type="text" name="txt_name" id="txt_name" class="form-control" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="txt_email" class="form-label">Email Address</label>
                    <input type="email" name="txt_email" id="txt_email" class="form-control" placeholder="name@example.com" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="txt_password" class="form-label">Password</label>
                    <input type="password" name="txt_password" id="txt_password" class="form-control" placeholder="Choose a password" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="txt_confirm" class="form-label">Confirm Password</label>
                    <input type="password" name="txt_confirm" id="txt_confirm" class="form-control" placeholder="Re-enter password" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="txt_contact" class="form-label">Contact Number</label>
                    <input type="tel" name="txt_contact" id="txt_contact" class="form-control" placeholder="Enter your contact number" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="txt_address" class="form-label">Address</label>
                    <input type="text" name="txt_address" id="txt_address" class="form-control" placeholder="Enter your address" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="selDistrict" class="form-label">District</label>
                    <select name="selDistrict" id="selDistrict" class="form-select" onchange="getPlace(this.value)" required>
                        <option value="">---Select District---</option>
                        <?php
                        $selQry = "select * from tbl_district";
                        $result = $con->query($selQry);
                        while ($data = $result->fetch_assoc()) {
                            echo "<option value='{$data['district_id']}'>{$data['district_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="selPlace" class="form-label">Place</label>
                    <select name="selPlace" id="place" class="form-select" required>
                        <option value="">---Select Place---</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <div class="form-check">
                        <input type="radio" name="rd_gender" id="male" value="Male" class="form-check-input" required>
                        <label for="male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="rd_gender" id="female" value="Female" class="form-check-input" required>
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="file_photo" class="form-label">Upload Profile Photo</label>
                    <input type="file" name="file_photo" id="file_photo" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="file_proof" class="form-label">Upload Proof Document</label>
                    <input type="file" name="file_proof" id="file_proof" class="form-control" required>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" name="btn_submit" class="btn btn-primary px-5">Register</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function getPlace(cid) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php?cid=" + cid,
            success: function (result) {
                $("#place").html(result);
            }
        });
    }
</script>
</body>
</html>
