<?php
include("../Assets/Connection/Connection.php");
session_start();
$userid=$_SESSION['uid'];

 if(isset($_POST["btn_submit"]))
  {
	 
	  $name=$_POST["txt_name"];
	  $email=$_POST["txt_email"];
	  $contact=$_POST["txt_contact"];
		  $upQry="update tbl_user SET user_name='$name',user_email='$email',user_contact='$contact' WHERE user_id='".$_SESSION['uid']."'";
		  if($con->query($upQry))
	  {
		?>
        <script>
		window.location="MyProfile.php";
		</script>
		<?php
	  }
	  else
	  {
		 echo "Error";
	  }
  }
 $SelUser="select * from tbl_user WHERE user_id='".$_SESSION['uid']."'";
 
  $resUser=$con->query($SelUser);
$data=$resUser->fetch_assoc();
ob_start();
include("Head.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Edit Profile</h2>
            <form id="form1" name="form1" method="post" action="">
                <div class="mb-3">
                    <label for="txt_name" class="form-label">Name</label>
                    <input type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo $data['user_name']; ?>" required />
                </div>
                <div class="mb-3">
                    <label for="txt_email" class="form-label">Email</label>
                    <input type="email" name="txt_email" id="txt_email" class="form-control" value="<?php echo $data['user_email']; ?>" required />
                </div>
                <div class="mb-3">
                    <label for="txt_contact" class="form-label">Contact</label>
                    <input type="text" name="txt_contact" id="txt_contact" class="form-control" value="<?php echo $data['user_contact']; ?>" required />
                </div>
                <div class="d-grid gap-2">
                    <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Edit" />
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>