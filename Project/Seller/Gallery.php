<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$id=$_GET['pID'];
	$photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Gallery/'.$photo);
	$InsQry="insert into tbl_gallery(gallery_image,product_id) values('$photo','$id')";
	if($con->query($InsQry))
		{
			?>
			<script>
			alert("Inserted");
			</script>
            <?php
		}
		else
		{
			?>
            <script>
			alert("Error");
			</script>
            <?php
		}
}

if(isset($_GET['did']))
{
	$DelQry="delete from tbl_gallery where gallery_id=".$_GET['did'];
	if($con->query($DelQry))
	{
			?>
			<script>
			window.location="Gallery.php";
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
    <h2 class="text-center mb-4">Seller Gallery</h2>

    <!-- Form to Upload Gallery Image -->
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="mb-3">
            <label for="file_photo" class="form-label">Gallery Image</label>
            <input type="file" class="form-control" name="file_photo" id="file_photo" required>
        </div>

        <div class="text-center">
            <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <!-- Display Uploaded Gallery Images -->
    <div class="mt-5">
        <h3 class="mb-3">Gallery Images</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Sl No.</th>
                    <th>Product Name</th>
                    <th>Gallery Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            $SelQry="SELECT * FROM tbl_gallery g INNER JOIN tbl_product p ON g.product_id=p.product_id WHERE seller_id=".$_SESSION['sid'];
            $result=$con->query($SelQry);
            while($data=$result->fetch_assoc())
            {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['product_name']; ?></td>
                <td><img src="../Assets/Files/Userdocs/<?php echo $data['gallery_image']; ?>" class="img-thumbnail" width="100" height="100"></td>
                <td><a href="Gallery.php?did=<?php echo $data['gallery_id'];?>" class="btn btn-danger btn-sm">Delete</a></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>