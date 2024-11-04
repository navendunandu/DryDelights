<?php
session_start();
include("../Assets/Connection/Connection.php");
 if(isset($_POST["btn_submit"]))
  {
	  $userid=$_SESSION["uid"]; 
	  $pid=$_GET["pID"];  
	  $title=$_POST["txt_title"];
	  $description=$_POST["txt_description"];
	   $file=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/'.$file);
	  
	   $insQry="insert into tbl_complaint(complaint_title,complaint_description,complaint_date,complaint_file,product_id,user_id)values('$title',' $description',curdate(),'$file','$pid','$userid')";
	  if($con->query($insQry))
	  {
		  ?>
	<script>
				alert("Inserted");
				window.location="MyComplaint.php";
				</script>
    <?php
	  }
	  else
	  {
		  echo "Error";
	  }
  }
  ob_start();
include("Head.php");	
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COMPLAINT</title>
</head>

<body>
<br>
<br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Complaint</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styling */
        .complaint-form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container complaint-form-container">
    <h2 class="form-title">Post a Complaint</h2>
    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="txt_title" class="form-label">Title</label>
            <input type="text" name="txt_title" id="txt_title" class="form-control" placeholder="Enter title" required>
        </div>
        <div class="form-group">
            <label for="txt_description" class="form-label">Description</label>
            <textarea name="txt_description" id="txt_description" class="form-control" rows="5" placeholder="Enter description" required></textarea>
        </div>
        <div class="form-group">
            <label for="file_photo" class="form-label">File</label>
            <input type="file" name="file_photo" id="file_photo" class="form-control-file">
        </div>
        <div class="text-center">
            <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>