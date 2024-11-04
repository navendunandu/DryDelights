<?php
include("../Assets/Connection/Connection.php");
session_start();
$name = $_SESSION['dname'];
$dagentid = $_SESSION['did'];
$SelDAgent = "SELECT * FROM tbl_deliveryagent WHERE deliveryagent_id = " . $dagentid;
$resDAgent = $con->query($SelDAgent);
$data = $resDAgent->fetch_assoc();
ob_start();
include("Head.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Agent Profile</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .profile-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 30px 0;
        }
        .profile-card img {
            border-radius: 50%;
            border: 3px solid #007bff;
            margin-bottom: 20px;
        }
        .profile-info {
            font-size: 1.2rem;
        }
        .profile-info h4 {
            font-weight: bold;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>

<body>
  <br>
  <br>
  <br>
<div class="container">
    <div class="profile-card text-center">
        <img src="../Assets/Files/Userdocs/<?php echo $data['deliveryagent_photo']; ?>" width="150" height="150" alt="Profile Picture" />
        <h4><?php echo $data['deliveryagent_name']; ?></h4>
        <div class="profile-info">
            <p><strong>Email:</strong> <?php echo $data['deliveryagent_email']; ?></p>
            <p><strong>Contact:</strong> <?php echo $data['deliveryagent_contact']; ?></p>
        </div>
        <div class="mt-4">
            <a href="EditProfile.php" class="btn btn-custom mr-2">Edit Profile</a>
            <a href="ChangePassword.php" class="btn btn-custom">Change Password</a>
        </div>
    </div>
</div>


</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>
