<?php

include("../Assets/Connection/Connection.php");
$name = '';
$email = '';
$password = '';
$aId=0;
ob_start();
include("Head.php");
  if(isset($_POST["btn_submit"]))
  {
	  $aId = $_POST['txt_aid'];
	  $name=$_POST["txt_name"];
      $email=$_POST["txt_email"];
	  $password=$_POST["txt_password"];
	  
	  if($aId!=0)
	  {
		  $upQry = "update tbl_admin SET admin_name = '$name', admin_email = '$email', admin_password = '$password' WHERE admin_id = '$aId'";
		  if($con->query($upQry))
		  {
			  ?>
			<script>
						alert("Updated");
						window.location="AdminRegistration.php";
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
		  $insqry="insert into tbl_admin(admin_name,admin_email,admin_password)values('$name','$email','$password')";
		  if($con->query($insqry))
		  {
				  ?>
			<script>
						alert("Inserted");
						window.location="AdminRegistration.php";
			</script>
			<?php
		  }
	  else
	  {
		  echo "Error";
	  }
	  }
	 
  }
  
  
  
  if(isset($_GET["delID"]))
 {
	 $adminID=$_GET["delID"];
	 $delQry="delete from tbl_admin where admin_id=$adminID";
	 if($con->query($delQry))
 
{
?>
	<script>
				alert("Deleted");
				window.location="AdminRegistration.php";
	</script>
 <?php     

 }
	  else
	  {
		  echo "Error";
	  }	 
	  
 }
 
 
 if(isset($_GET["eID"]))
 {
	 $aId= $_GET["eID"];
	$selqry="select * from tbl_admin where admin_id = '$aId'";
	$result=$con->query($selqry);
	$data = $result->fetch_assoc();
	$name = $data['admin_name'];
	$email = $data['admin_email'];
	$password = $data['admin_password'];
	
	
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AdminRegistration</title>
</head>

<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Admin Registration</h2>

    <!-- Admin Form -->
    <form id="form1" name="form1" method="post" action="" class="p-4 border rounded bg-light">
        <input type="hidden" name="txt_aid" id="txt_aid" value="<?php echo $aId; ?>" />
        
        <div class="mb-3">
            <label for="txt_name" class="form-label">Name</label>
            <input required type="text" class="form-control" name="txt_name" pattern="^[A-Z]+[a-zA-Z ]*$" title="Name allows only alphabets, spaces, and the first letter must be capitalized" id="txt_name" value="<?php echo $name; ?>" />
        </div>

        <div class="mb-3">
            <label for="txt_email" class="form-label">Email</label>
            <input required type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo $email; ?>" />
        </div>

        <div class="mb-3">
            <label for="txt_password" class="form-label">Password</label>
            <input required type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" name="txt_password" id="txt_password" value="<?php echo $password; ?>" />
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </form>

    <!-- Admin List Table -->
    <div class="table-responsive my-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selqry="select * from tbl_admin";
                $result=$con->query($selqry);
                $i=0;
                while($data=$result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['admin_name']; ?></td>
                    <td><?php echo $data['admin_email']; ?></td>      
                    <td><?php echo $data['admin_password']; ?></td>
                    <td>
                        <a href="AdminRegistration.php?delID=<?php echo $data['admin_id']?>" class="btn btn-danger btn-sm">Delete</a>
                        <a href="AdminRegistration.php?eID=<?php echo $data['admin_id']?>" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
<?php
include("Foot.php");
ob_flush();
?>
  