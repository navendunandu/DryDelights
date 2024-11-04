<?php 
include("../Assets/Connection/Connection.php");
session_start();
$userid=$_SESSION['uid'];
$SelUser="select * from tbl_user where user_id=".$userid;
$resUser=$con->query($SelUser);
$data=$resUser->fetch_assoc();
ob_start();
include("Head.php");
 if(isset($_POST["btn_submit"]))
 {
   $oldpassword=$_POST["txt_oldpassword"];
   $newpassword=$_POST["txt_newpassword"];
   $retypepassword=$_POST["txt_retypepassword"];
	 if($data['user_password']==$oldpassword)
	 {
		 if($newpassword=$retypepassword)
         {
	         $upQry="update tbl_user SET user_password='$newpassword' WHERE user_id='".$_SESSION['uid']."'";
		     if($con->query($upQry))
	       {
		    ?>
             <script>
		 alert("Success");
		     </script>
		     <?php
	        }
	     else
	     {
            ?>
            <script>
        alert("Success");
            </script>
            <?php
	     }
      }
      else
   {
	   ?>
     <script>
	 alert('New Password and Re-Type Password does not match!');
	 </script>
     <?php
   }
	 }
   else
  {
	  ?>
	  <script>
	 alert('Incorrect Old Password!');
	 </script>
     <?php
  }
 }
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
            <h2 class="text-center mb-4">Change Password</h2>

            <form id="form1" name="form1" method="post" action="">
                <!-- Old Password -->
                <div class="form-group mb-3">
                    <label for="txt_oldpassword" class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="txt_oldpassword" id="txt_oldpassword" placeholder="Enter Old Password">
                </div>

                <!-- New Password -->
                <div class="form-group mb-3">
                    <label for="txt_newpassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="txt_newpassword" id="txt_newpassword" placeholder="Enter New Password">
                </div>

                <!-- Re-Type New Password -->
                <div class="form-group mb-3">
                    <label for="txt_retypepassword" class="form-label">Re-Type New Password</label>
                    <input type="password" class="form-control" name="txt_retypepassword" id="txt_retypepassword" placeholder="Re-Type New Password">
                </div>

                <!-- Submit and Cancel buttons -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" id="btn_submit" name="btn_submit">Change Password</button>
                    <button type="reset" class="btn btn-secondary" id="btn_cancel">Cancel</button>
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