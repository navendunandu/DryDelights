<?php 
include("../Assets/Connection/Connection.php");
session_start();
$sellerid=$_SESSION['sid'];
$SelSeller="select * from tbl_seller where seller_id=".$sellerid;
$resSeller=$con->query($SelSeller);
$data=$resSeller->fetch_assoc();
 if(isset($_POST["btn_submit"]))
 {
   $oldpassword=$_POST["txt_oldpassword"];
   $newpassword=$_POST["txt_newpassword"];
   $retypepassword=$_POST["txt_retypepassword"];
	 if($data['seller_password']==$oldpassword)
	 {
		 if($newpassword=$retypepassword)
         {
	         $upQry="update tbl_seller SET seller_password='$newpassword' WHERE seller_id='".$_SESSION['sid']."'";
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
 ob_start();
include("Head.php");
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<br><br><br>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Change Password</h2>

    <form id="form1" name="form1" method="post" action="">
        <div class="mb-3 row">
            <label for="txt_oldpassword" class="col-sm-2 col-form-label">Old Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="txt_oldpassword" name="txt_oldpassword" placeholder="Enter Old Password">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="txt_newpassword" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="txt_newpassword" name="txt_newpassword" placeholder="Enter New Password">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="txt_retypepassword" class="col-sm-2 col-form-label">Re-Type Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="txt_retypepassword" name="txt_retypepassword" placeholder="Re-Type New Password">
            </div>
        </div>

        <div class="mb-3 row text-center">
            <div class="col-sm-12">
                <input type="submit" name="btn_submit" id="btn_submit" value="Change Password" class="btn btn-primary">
                <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" class="btn btn-secondary ms-2">
            </div>
        </div>
    </form>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><br><br>
<?php
include("Foot.php");
ob_flush();
?>