<?php
include("../Assets/Connection/Connection.php");
session_start();
$sellerid=$_SESSION['sid'];
ob_start();
include("Head.php");
 if(isset($_POST["btn_submit"]))
  {
	 
	  $name=$_POST["txt_name"];
	  $email=$_POST["txt_email"];
	  $contact=$_POST["txt_contact"];
		  $upQry="update tbl_seller SET seller_name='$name',seller_email='$email',seller_contact='$contact' WHERE seller_id='".$_SESSION['sid']."'";
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
 $SelSeller="select * from tbl_seller WHERE seller_id='".$_SESSION['sid']."'";
 
  $resSeller=$con->query($SelSeller);
$data=$resSeller->fetch_assoc();
	

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
    <h2 class="text-center mb-4">Edit Seller Profile</h2>

    <form id="form1" name="form1" method="post" action="">
        <div class="mb-3">
            <label for="txt_name" class="form-label">Name</label>
            <input type="text" class="form-control" name="txt_name" id="txt_name" value="<?php echo $data['seller_name'];?>" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
            <label for="txt_email" class="form-label">Email</label>
            <input type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo $data['seller_email'];?>" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
            <label for="txt_contact" class="form-label">Contact</label>
            <input type="text" class="form-control" name="txt_contact" id="txt_contact" value="<?php echo $data['seller_contact'];?>" placeholder="Enter your contact number" required>
        </div>

        <div class="text-center">
            <button type="submit" name="btn_submit" class="btn btn-primary">Edit</button>
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
