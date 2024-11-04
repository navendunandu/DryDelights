<?php
include("../Assets/Connection/Connection.php");
session_start();
$name=$_SESSION['sname'];
$sellerid=$_SESSION['sid'];
$SelSeller="select * from tbl_seller where seller_id=".$sellerid;
$resSeller=$con->query($SelSeller);
$data=$resSeller->fetch_assoc();
ob_start();
include("Head.php");
	
?>
<br><br><br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        /* Custom styles */
        .profile-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 30px auto;
        }
        .profile-photo img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .table th {
        }
        .btn-primary, .btn-secondary {
            min-width: 120px;
        }
        .profile-header {
            text-align: center;
        }
        .table-profile th, .table-profile td {
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


    <h2 class="text-center mb-4 mt-4">My Profile</h2>



<div class="container profile-container">
    <form id="form1" name="form1" method="post" action="">
        <div class="profile-header">
            <img src="../Assets/Files/Userdocs/<?php echo htmlspecialchars($data['seller_photo']); ?>" class="img-thumbnail" alt="Profile Photo">
        </div>

        <div class="table-responsive mt-4">
            <!-- Seller Details -->
            <table class="table table-borderless table-profile">
                <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <td><?php echo htmlspecialchars($data['seller_name']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?php echo htmlspecialchars($data['seller_email']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Contact</th>
                        <td><?php echo htmlspecialchars($data['seller_contact']); ?></td>
                    </tr>
                    <?php
                        $selQry = "SELECT * FROM tbl_user n INNER JOIN tbl_place p ON n.place_id = p.place_id INNER JOIN tbl_district d ON p.district_id = d.district_id";
                        $result = $con->query($selQry);
                        $data = $result->fetch_assoc();
                    ?>
                    <tr>
                        <th scope="row">District</th>
                        <td><?php echo htmlspecialchars($data['district_name']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Place</th>
                        <td><?php echo htmlspecialchars($data['place_name']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Buttons to Edit Profile or Change Password -->
        <div class="btn-group">
            <a href="EditProfile.php" class="btn btn-primary">Edit Profile</a>
            <a href="ChangePassword.php" class="btn btn-secondary">Change Password</a>
        </div>
    </form>
</div>

<!-- Bootstrap JS and

</body>
</html>
<br><br>
<?php
include("Foot.php");
ob_flush();
?>