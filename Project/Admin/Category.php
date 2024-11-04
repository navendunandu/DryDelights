<?php
include("../Assets/Connection/Connection.php");
$category='';
$aId=0;
ob_start();
include("Head.php");
  if(isset($_POST["btn_submit"]))
  {
	  $aId=$_POST['txt_aid'];
	  $category=$_POST["txt_category"];
	  if($aId!=0)
	  {
		  $upQry="update tbl_category SET category_name='$category' WHERE category_id='$aId'";
		  if($con->query($upQry))
	  {
		?>
        <script>
		alert("Updated");
		window.location="Category.php";
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
        $selCheck="SELECT * FROM tbl_category WHERE category_name='".$category."'";
        $result=$con->query($selCheck);
        if($result->num_rows>0){
            ?>
                <script>
                    alert("Category already exists");
                </script>
            <?php
        }
	  $insQry="insert into tbl_category(category_name)values('$category')";
	  if($con->query($insQry))
	  {
		  ?>
	<script>
				alert("Inserted");
				window.location="Category.php";
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
	 $categoryID=$_GET["delID"];
	 $delQry="delete from tbl_category where category_id=$categoryID";
	 if($con->query($delQry))
 
{
?>
	<script>
				alert("Deleted");
				window.location="Category.php";
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
	$selQry="select * from tbl_category where category_id = '$aId'";
	$result=$con->query($selQry);
	$data = $result->fetch_assoc();
	$category = $data['category_name'];
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
    <h2 class="text-center mb-4">Category Management</h2>

    <!-- Category Form -->
    <div class="card p-4">
        <form id="form1" name="form1" method="post" action="">
            <div class="mb-3">
                <label for="txt_category" class="form-label">Category Name</label>
                <input type="hidden" name="txt_aid" id="txt_aid" value="<?php echo $aId; ?>" />
                <input type="text" class="form-control" title="Name allows only alphabets, spaces, and the first letter must be capitalized" pattern="^[A-Z]+[a-zA-Z ]*$" name="txt_category" id="txt_category" value="<?php echo $category; ?>" required />
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit">Submit</button>
            </div>
        </form>
    </div>

    <!-- Category List -->
    <div class="mt-5">
        <h3 class="mb-3">Category List</h3>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry="select * from tbl_category";
                $result=$con->query($selQry);
                $i=0;
                while($data=$result->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['category_name'];?></td>
                    <td>
                        <a href="Category.php?delID=<?php echo $data['category_id']?>" class="btn btn-danger btn-sm">DELETE</a>
                        <a href="Category.php?eID=<?php echo $data['category_id']?>" class="btn btn-warning btn-sm">EDIT</a>
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
</html>
<?php
include("Foot.php");
ob_flush();
?>