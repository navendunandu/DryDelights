<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
  if(isset($_POST["btn_submit"]))
  {
	  $category=$_POST["selCategory"];
	  $subcategory=$_POST["txt_subcategory"];

	  $insQry="insert into tbl_subcategory(subcategory_name,category_id)values('$subcategory','$category')";
	  if($con->query($insQry))
	  {
		  ?>
	<script>
				alert("Inserted");
				window.location="SubCategory.php";
				</script>
    <?php
	  }
	  else
	  {
		  echo "Error";
	  }
  }
  
  if(isset($_GET["delID"]))
 {
	 $subcategoryID=$_GET["delID"];
	 $delQry="delete from tbl_subcategory where subcategory_id=$subcategoryID";
	 if($con->query($delQry))
 
{
?>
	<script>
				alert("Deleted");
				window.location="SubCategory.php";
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
    <h2 class="text-center mb-4">Subcategory Management</h2>

    <form id="form1" name="form1" method="post" action="">
        <div class="mb-3 row">
            <label for="selCategory" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <select name="selCategory" id="selCategory" class="form-select" required>
                    <option value="----select----">----select----</option>
                    <?php
                    $SelQry = "SELECT * FROM tbl_category";
                    $result = $con->query($SelQry);
                    while ($data = $result->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $data['category_id']; ?>"><?php echo $data['category_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="txt_subcategory" class="col-sm-2 col-form-label">Subcategory</label>
            <div class="col-sm-10">
                <input type="text" name="txt_subcategory" id="txt_subcategory" class="form-control" required />
            </div>
        </div>

        <div class="mb-3 text-center">
            <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Submit" />
            <input type="reset" name="btn_cancel" id="btn_cancel" class="btn btn-secondary" value="Cancel" />
        </div>
    </form>

    <table class="table table-bordered table-hover table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th scope="col">Sl No</th>
                <th scope="col">Category</th>
                <th scope="col">Subcategory</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $SelQry = "SELECT * FROM tbl_subcategory s INNER JOIN tbl_category c ON s.category_id = c.category_id";
        $result = $con->query($SelQry);
        $i = 0;
        while ($data = $result->fetch_assoc()) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['category_name']; ?></td>
                <td><?php echo $data['subcategory_name']; ?></td>
                <td>
                    <a href="SubCategory.php?delID=<?php echo $data['subcategory_id']; ?>" class="btn btn-danger btn-sm">DELETE</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
