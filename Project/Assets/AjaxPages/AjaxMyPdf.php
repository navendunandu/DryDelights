<?php
session_start();
include("../Connection/Connection.php");
require '../phpMail/src/Exception.php';
require '../phpMail/src/PHPMailer.php';
require '../phpMail/src/SMTP.php';
require '../dompdf/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Print the request method for debugging



// Check if any data was received
if (isset($_POST["printContents"])) {
    // Decode the JSON data
    $selUser="SELECT * FROM tbl_user where user_id =". $_SESSION["uid"];
    $resUser=$con->query($selUser);
    $data=$resUser->fetch_assoc(); 
    $name=$data['user_name'];
    $email=$data['user_email'];
    $webMail="drydelights36@gmail.com";
    $app_password="";
    // Now you have the JSON data as an associative array
    $htmlContent = $_POST["printContents"];



    $randomNumber = rand(111111, 999999);
    // echo $randomNumber;
  

    // Replace the <img> tag in your HTML content with the base64-encoded image
    
    $html = $htmlContent;


    // Create a PDF object
    $pdf = new Dompdf\Dompdf();

    // Load HTML content
    $pdf->loadHtml($html);

    // Render the PDF (optional: set paper size, orientation, etc.)
    $pdf->setPaper('A3', 'portrait');

    // Render the PDF
    $pdf->render();

    // Get the PDF content
    $pdfContent = $pdf->output();

    $pdfFilename = sys_get_temp_dir() . '/bill.pdf'; // Specify the filename directly
    file_put_contents($pdfFilename, $pdfContent);
    $webMail="drydelights36@gmail.com";
$app_password="";
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $webMail; // Your Gmail
    $mail->Password = $app_password;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($webMail, 'DryDelights'); 
    $mail->addAddress($email);//to Gmail Address

    $mail->addAttachment($pdfFilename);

    // Content
    $mail->isHTML(true);
    $message = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Order Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px; }
        .container { background: #fff; border-radius: 5px; padding: 20px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { font-size: 24px; margin-bottom: 20px; color: #27ae60; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            Thank You for Shopping with DryDelights!
        </div>
        <p>Dear " . htmlspecialchars($name) . ",</p>
        <p>Thank you for placing an order with DryDelights. We have received your order and it is now being processed.</p>
        <p>Your order ID is <strong>#" . htmlspecialchars($randomNumber) . "</strong>. A detailed bill is attached to this email.</p>
        <p>If you have any questions, please feel free to reach out to our support team.</p>
        <p>Best regards,<br>DryDelights Team</p>
        <div class='footer'>
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
";

    $mail->Subject = "Order Confirmation - DryDelights";
    $mail->Body = $message;

    if ($mail->send()) {
        echo "Email sent successfully!";
    } else {
        echo "Email sending failed. Error: " . $mail->ErrorInfo;
    }

    unlink($pdfFilename);

} else {
    // Handle the case where no data was received in the POST request
    echo "No data received.";
}

?>