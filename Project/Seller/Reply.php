<?php
include("../Assets/Connection/connection.php");
if(isset($_POST['btn_reply']))
{
	$reply=$_POST['txt_reply'];
	$upQry="update tbl_complaint set complaint_reply='$reply',complaint_status='1' where complaint_id=".$_GET['cid'];
	if($con->query($upQry))
	{		
	}
	else
	{
		echo "ERROR";
	}
}
ob_start();
include("Head.php");
?>
<br><br><br><br><br><br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Reply Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for styling */
    body {
      background-color: #f8f9fa;
    }
    .reply-form-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .form-label {
      font-weight: bold;
    }
    .btn-custom {
      background-color: #007bff;
      color: white;
    }
    .btn-custom:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="reply-form-container">
  <form id="form1" name="form1" method="post" action="">
    <div class="mb-3">
      <label for="txt_reply" class="form-label">Reply</label>
      <input type="text" class="form-control" name="txt_reply" id="txt_reply" placeholder="Type your reply">
    </div>
    <div class="text-center">
      <input type="submit" name="btn_reply" id="btn_reply" value="Reply" class="btn btn-custom">
    </div>
  </form>
</div>

<!-- Bootstrap JS (Optional for advanced functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>