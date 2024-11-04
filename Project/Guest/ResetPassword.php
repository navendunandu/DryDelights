<?php
include("../Assets/Connection/connection.php");
session_start();
if(isset($_POST['btn_change'])){
	$new=$_POST['txt_pass'];
	$retype=$_POST['txt_cpass'];
if(isset($_SESSION['rwid']))
{
	if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
  {
		$upQry="update tbl_seller set seller_password='$new' where seller_id=".$_SESSION['rwid'];
		if($con->query($upQry)){
		?>
		<script>
			alert("Password Updated")
			window.location="LogOut.php"
			</script>
		<?php
		}
	}
}
else if(isset($_SESSION['ruid']))
{
	 if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
	{
		$upQry="update tbl_user set user_password='$new' where user_id=".$_SESSION['ruid'];
		if($con->query($upQry)){
		?>
		<script>
			alert("Password Updated")
			window.location="LogOut.php"
			</script>
		<?php
}
}
}
else if(isset($_SESSION['rsid']))
{
	 if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
	{
		$upQry="update tbl_deliveryagent set deliveryagent_password='$new' where deliveryagent_id=".$_SESSION['rsid'];
		if($con->query($upQry)){
		?>
		<script>
			alert("Password Updated")
			window.location="LogOut.php"
			</script>
		<?php
}
}
}
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            <h2>Reset Password</h2>
            <p>Please enter your new password below.</p>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="txt_pass">New Password</label>
                <input type="password" class="form-control" name="txt_pass" id="txt_pass" required placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label for="txt_cpass">Confirm Password</label>
                <input type="password" class="form-control" name="txt_cpass" id="txt_cpass" required placeholder="Confirm new password">
            </div>
            <button type="submit" class="btn btn-primary" name="btn_change">Change Password</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>
</html>

