<?php
include("../Assets/Connection/Connection.php");
session_start();
$name=$_SESSION['uname'];
$userid=$_SESSION['uid'];
$SelUser="select * from tbl_user where user_id=".$userid;
$resUser=$con->query($SelUser);
$data=$resUser->fetch_assoc();
ob_start();
include("Head.php");	
	
?>
<br><br><br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        /* Custom styling */
        .profile-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-container img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .profile-header {
            text-align: center;
        }
        .table-profile td {
            padding: 10px;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container profile-container">
    <div class="profile-header">
        <img src="../Assets/Files/Userdocs/<?php echo htmlspecialchars($data['user_photo']); ?>" alt="User Photo">
    </div>

    <table class="table table-borderless table-profile mt-4">
        <tr>
            <td><strong>Name</strong></td>
            <td><?php echo htmlspecialchars($data['user_name']); ?></td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td><?php echo htmlspecialchars($data['user_email']); ?></td>
        </tr>
        <tr>
            <td><strong>Contact</strong></td>
            <td><?php echo htmlspecialchars($data['user_contact']); ?></td>
        </tr>
        <?php
        $selQry = "SELECT * FROM tbl_user n INNER JOIN tbl_place p ON n.place_id = p.place_id INNER JOIN tbl_district d ON p.district_id = d.district_id";
        $result = $con->query($selQry);
        $data = $result->fetch_assoc();
        ?>
        <tr>
            <td><strong>District</strong></td>
            <td><?php echo htmlspecialchars($data['district_name']); ?></td>
        </tr>
        <tr>
            <td><strong>Place</strong></td>
            <td><?php echo htmlspecialchars($data['place_name']); ?></td>
        </tr>
    </table>

    <div class="btn-group">
        <a href="EditProfile.php" class="btn btn-primary">Edit Profile</a>
        <a href="ChangePassword.php" class="btn btn-secondary">Change Password</a>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>
</html>
</body>
</html>
<br><br>
<?php
include("Foot.php");
ob_flush();
?>