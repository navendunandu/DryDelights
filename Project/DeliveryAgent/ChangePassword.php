<?php 
include("../Assets/Connection/Connection.php");
session_start();
$dagentid=$_SESSION['did'];
$SelDAgent="select * from tbl_deliveryagent where deliveryagent_id=".$dagentid;
$resDAgent=$con->query($SelDAgent);
$data=$resDAgent->fetch_assoc();
ob_start();
include("Head.php");
 if(isset($_POST["btn_submit"]))
 {
   $oldpassword=$_POST["txt_oldpassword"];
   $newpassword=$_POST["txt_newpassword"];
   $retypepassword=$_POST["txt_retypepassword"];
	 if($data['deliveryagent_password']==$oldpassword)
	 {
		 if($newpassword==$retypepassword)
         {
	         $upQry="update tbl_deliveryagent SET deliveryagent_password='$newpassword' WHERE deliveryagent_id='".$_SESSION['did']."'";
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
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <br><br><br><br>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <style> /* Custom CSS for styling the form */
.container {
  margin-top: 50px;
}

.card-header {
  font-weight: bold;
}

.btn-success, .btn-secondary {
  width: 48%;
}

h4 {
  margin: 0;
}
</style>
</head>


<body>
<div class="container mt-5">
  <div class="card mx-auto" style="max-width: 400px;">
    <div class="card-header bg-primary text-white text-center">
      <h4>Change Password</h4>
    </div>
    <div class="card-body">
      <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
          <label for="txt_oldpassword">Old Password</label>
          <input type="password" class="form-control" name="txt_oldpassword" id="txt_oldpassword" 
                 placeholder="Enter Old Password">
        </div>
        <div class="form-group">
          <label for="txt_newpassword">New Password</label>
          <input type="password" class="form-control" name="txt_newpassword" id="txt_newpassword" 
                 placeholder="Enter New Password">
        </div>
        <div class="form-group">
          <label for="txt_retypepassword">Re-Type Password</label>
          <input type="password" class="form-control" name="txt_retypepassword" id="txt_retypepassword" 
                 placeholder="Re-Type New Password">
        </div>
        <div class="text-center">
          <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-success">Change Password</button>
          <button type="reset" name="btn_cancel" id="btn_cancel" class="btn btn-secondary ml-2">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
<br><br>
<?php
include("Foot.php");
ob_flush();
?>