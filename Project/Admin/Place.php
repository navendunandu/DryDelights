<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
  if(isset($_POST["btn_submit"]))
  {
	  $place=$_POST["txt_place"];
	  $pincode=$_POST["txt_pincode"];
	  $district=$_POST["SelDistrict"];
	  
	  $selCheck="select * from tbl_place where place_name='".$place."'";
	  $resCheck=$con->query($selCheck);
	  if($resCheck->num_rows>0)
	  {
		  ?>
		<script>
		alert("Already Exists")
		</script>
		  <?php
	  }
	  else{
	  $insQry="insert into tbl_place(place_name,place_pincode,district_id)values('$place','$pincode','$district')";
	  if($con->query($insQry))
	  {
		  ?>
	<script>
				alert("Inserted");
				window.location="Place.php";
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
	 $placeID=$_GET["delID"];
	 $delQry="delete from tbl_place where place_id=$placeID";
	 if($con->query($delQry))
 
{
?>
	<script>
				alert("Deleted");
				window.location="Place.php";
	</script>
 <?php     
 }
	  else
	  {
		  echo "Error";
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
    <h2 class="text-center mb-4">Manage Places</h2>

    <form id="form1" name="form1" method="post" action="">
        <div class="mb-3">
            <label for="SelDistrict" class="form-label">District</label>
            <select class="form-select" name="SelDistrict" id="SelDistrict">
                <option value="----select----">----select----</option>
                <?php
                $SelQry="select * from tbl_district";
                $result=$con->query($SelQry);
                while($data=$result->fetch_assoc())
                {
                ?>
                <option value="<?php echo $data['district_id']?>"><?php echo $data['district_name'];?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="txt_place" class="form-label">Place</label>
            <input type="text" class="form-control" name="txt_place" id="txt_place" />
        </div>

        <div class="mb-3">
            <label for="txt_pincode" class="form-label">Pincode</label>
            <input type="text" class="form-control" name="txt_pincode" id="txt_pincode" />
        </div>

        <div class="text-center">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary" />
        </div>
    </form>

    <div class="mt-5">
        <h3 class="text-center mb-3">Place List</h3>
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">Place</th>
                    <th scope="col">Pincode</th>
                    <th scope="col">District</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $SelQry="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
                $result=$con->query($SelQry);
                $i=0;
                while($data=$result->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['place_name'];?></td>
                    <td><?php echo $data['place_pincode'];?></td>
                    <td><?php echo $data['district_name'];?></td>
                    <td><a href="Place.php?delID=<?php echo $data['place_id']?>" class="btn btn-danger btn-sm">DELETE</a></td>
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
</html>
<?php
include("Foot.php");
ob_flush();
?>