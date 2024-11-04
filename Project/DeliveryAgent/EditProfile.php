<?php
include("../Assets/Connection/Connection.php");
session_start();
$dagentid=$_SESSION['did'];
ob_start();
include("Head.php");

 if(isset($_POST["btn_submit"]))
  {
	 
	  $name=$_POST["txt_name"];
	  $email=$_POST["txt_email"];
	  $contact=$_POST["txt_contact"];
		  $upQry="update tbl_deliveryagent SET deliveryagent_name='$name',deliveryagent_email='$email',deliveryagent_contact='$contact' WHERE deliveryagent_id='".$_SESSION['did']."'";
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
 $SelDAgent="select * from tbl_deliveryagent WHERE deliveryagent_id='".$_SESSION['did']."'";
 
  $resDAgent=$con->query($SelDAgent);
$data=$resDAgent->fetch_assoc();
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <br><br><br>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>/* Custom CSS for the form */
.container {
  margin-top: 20px;
}

.card-header {
  font-weight: bold;
}

.form-control {
  border-radius: 0;
}

.btn-success {
  width: 100%;
}

h4 {
  margin: 0;
}
</style>
</head>

<br><br>
<body>
<div class="container mt-5">
  <div class="card mx-auto" style="max-width: 500px;">
    <div class="card-header bg-primary text-white text-center">
      <h4>Edit Delivery Agent Profile</h4>
    </div>
    <div class="card-body">
      <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
          <label for="txt_name">Name</label>
          <input type="text" class="form-control" name="txt_name" id="txt_name" 
                 value="<?php echo $data['deliveryagent_name'];?>" placeholder="Enter name">
        </div>
        <div class="form-group">
          <label for="txt_email">Email</label>
          <input type="email" class="form-control" name="txt_email" id="txt_email" 
                 value="<?php echo $data['deliveryagent_email'];?>" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="txt_contact">Contact</label>
          <input type="text" class="form-control" name="txt_contact" id="txt_contact" 
                 value="<?php echo $data['deliveryagent_contact'];?>" placeholder="Enter contact number">
        </div>
        <div class="text-center">
          <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-success">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
<br><br><br>
<?php
include("Foot.php");
ob_flush();
?>