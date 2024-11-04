<?php
include("../Assets/Connection/Connection.php");
$brand = $brandid = "";
ob_start();
include("Head.php");
if(isset($_POST["btn_submit"]))
  {
	  $aId=$_POST['txt_aid'];
	  $brand=$_POST["txt_brand"];
	  if($aId!=0)
	  {
		  $upQry="update tbl_brand SET brand_name='$brand' WHERE brand_id='$aId'";
		  if($con->query($upQry))
	  {
		?>
        <script>
		alert("Updated");
		window.location="Brand.php";
		</script>
		<?php
	  }
	}  
else
{
	$brand=$_POST['txt_brand'];
		$selCheck="SELECT * FROM tbl_brand WHERE brand_name='".$brand."'";
		$res=$con->query($selCheck);
		if($res->num_rows>0){
			?>
			<script>
				// alert("Brand already exists");
                window.location="Brand.php";
			</script>
			<?php
		}
	else
	{
	
		 $insQry="insert into tbl_brand(brand_name)values('$brand')";
	    if($con->query($insQry))
	    {
		  ?>
	      <script>
		//   alert("Inserted");
		  window.location="Brand.php";
		  </script>
          <?php
	    }
	}
	}
}
	
	if(isset($_GET["delID"]))
	{
		$brandID=$_GET["delID"];
		$delQry="delete from tbl_brand where brand_id=$brandID";
		if($con->query($delQry))
	
   {
   ?>
	   <script>
				   alert("Deleted");
				   window.location="Brand.php";
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
	   $selQry="select * from tbl_brand where brand_id = '$aId'";
	   $result=$con->query($selQry);
	   $data = $result->fetch_assoc();
	   $brand = $data['brand_name'];
	   $brandid = $data['brand_id'];
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
    <h2 class="text-center mb-4">Add a Brand</h2>

    <!-- Brand Form -->
    <form id="form1" name="form1" method="post" action="" class="p-4 border rounded bg-light">
        <div class="mb-3">
            <label for="txt_brand" class="form-label">Brand Name</label>
            <input required type="text" class="form-control" pattern="^[A-Z]+[a-zA-Z ]*$" title="Name allows only alphabets, spaces, and the first letter must be capitalized" name="txt_brand" id="txt_brand" value="<?php echo $brand; ?>" />
			<input type="hidden" name="txt_aid" value="<?php echo $brandid; ?>">
        </div>

        <div class="text-center">
            <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<div class="mt-5">
        <h3 class="mb-3">Brand List</h3>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=0;
                $selQry="select * from tbl_brand";
                $result=$con->query($selQry);
                while($data=$result->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['brand_name'];?></td>
                    <td>
                        <a href="Brand.php?delID=<?php echo $data['brand_id']?>" class="btn btn-danger btn-sm">DELETE</a>
                        <a href="Brand.php?eID=<?php echo $data['brand_id']?>" class="btn btn-warning btn-sm">EDIT</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>