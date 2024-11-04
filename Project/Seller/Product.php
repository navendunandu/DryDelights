<?php
session_start();

include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");

  if(isset($_POST["btn_submit"]))
  {
	   $sellerid=$_SESSION['sid'];
	  $brand=$_POST['brand_name'];
	  $category=$_POST["selCategory"];
	  $subcategory=$_POST["selSubCategory"];
	  $productname=$_POST["txt_pname"];
	  $price=$_POST["txt_price"];
      $details=$_POST["txt_details"];
	  $photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/'.$photo);

     $sel="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
    inner join tbl_category c on s.category_id=c.category_id inner join tbl_brand b on p.brand_id=b.brand_id
     where p.product_name='".$productname."' and p.subcategory_id='".$subcategory."' and p.brand_id='".$brand."' and s.category_id='".$category."'   ";
    $res=$con->query($sel);
    if($res->num_rows>0)
    {
        ?>
        <script>
            alert('Product Already Exist');
            window.location="Product.php";
        </script>
        <?php
    }
    else
    {

        $insQry="insert into tbl_product(product_name,product_price,product_details,product_photo,subcategory_id,seller_id,brand_id)values('$productname','$price','$details','$photo','$subcategory','$sellerid','$brand')";
	  if($con->query($insQry))
	  {
		  ?>
	<script>
				alert("Inserted");
				window.location="Product.php";
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
	 $productID=$_GET["delID"];
	 $delQry="delete from tbl_product where product_id=$productID";
	 if($con->query($delQry))
 
{
?>
	<script>
				alert("Deleted");
				window.location="Product.php";
	</script>
 <?php     
 }
	  else
	  {
		  echo "Error";
	  }	 
 }
	  
 ?>
<br><br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<!--  -->
<div class="container my-5">
    <h2 class="text-center">Add Product</h2>
    <form id="form1" name="form1" method="post" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="selCategory" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <select name="selCategory" class="form-select" onchange="getPlace(this.value)">
                    <option value="----select----">----select----</option>
                    <?php
                    $selQry="select * from tbl_category";
                    $result=$con->query($selQry);
                    while($data=$result->fetch_assoc()) {
                        echo "<option value='{$data['category_id']}'>{$data['category_name']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="selSubCategory" class="col-sm-2 col-form-label">SubCategory</label>
            <div class="col-sm-10">
                <select name="selSubCategory" id="place" class="form-select">
                    <option value="----select----">----select----</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="brand_name" class="col-sm-2 col-form-label">Brand</label>
            <div class="col-sm-10">
                <select name="brand_name" id="place" class="form-select">
                    <option value="----select----">----select----</option>
                    <?php
                    $selQry="select * from tbl_brand";
                    $result=$con->query($selQry);
                    while($data=$result->fetch_assoc()) {
                        echo "<option value='{$data['brand_id']}'>{$data['brand_name']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="txt_pname" class="col-sm-2 col-form-label">Product Name</label>
            <div class="col-sm-10">
                <input type="text" name="txt_pname" id="txt_pname" class="form-control"/>
            </div>
        </div>

        <div class="row mb-3">
            <label for="txt_price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="text" name="txt_price" id="txt_price" class="form-control"/>
            </div>
        </div>

        <div class="row mb-3">
            <label for="txt_details" class="col-sm-2 col-form-label">Details</label>
            <div class="col-sm-10">
                <textarea name="txt_details" id="txt_details" cols="45" rows="5" class="form-control"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="file_photo" class="col-sm-2 col-form-label">Photo</label>
            <div class="col-sm-10">
                <input type="file" name="file_photo" class="form-control"/>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-12 text-center">
                <input type="submit" name="btn_submit" id="btn_save" value="Save" class="btn btn-success"/>
                <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" class="btn btn-danger"/>
            </div>
        </div>
    </form>

    <h2 class="text-center my-4">Product List</h2>
    <table class="table table-bordered table-hover text-center">
        <thead class="table-dark">
        <tr>
            <th>Sl No</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Brand</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Details</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $selQry = "select * from tbl_product p 
                   inner join tbl_subcategory s on p.subcategory_id = s.subcategory_id
                   inner join tbl_category c on s.category_id = c.category_id
                   inner join tbl_brand b on p.brand_id = b.brand_id
                   where p.seller_id=" . $_SESSION['sid'];

        $result = $con->query($selQry);
        $i = 0;
        while ($data = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['category_name']; ?></td>
                <td><?php echo $data['subcategory_name']; ?></td>
                <td><?php echo $data['brand_name']; ?></td>
                <td><?php echo $data['product_name']; ?></td>
                <td><?php echo $data['product_price']; ?></td>
                <td><?php echo $data['product_details']; ?></td>
                <td><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" width="100" height="100"></td>
                <td>
                    <a href="Product.php?delID=<?php echo $data['product_id'] ?>" class="btn btn-danger btn-sm">DELETE</a>
                    <a href="Stock.php?pID=<?php echo $data['product_id'] ?>" class="btn btn-primary btn-sm">AddStock</a>
                    <a href="Gallery.php?pID=<?php echo $data['product_id'] ?>" class="btn btn-secondary btn-sm">AddMoreImages</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(cid) {
    $.ajax({
      url: "../Assets/AjaxPages/Ajaxsubcat.php?cid=" + cid,
      success: function (result) {

        $("#place").html(result);
      }
    });
  }

</script>
</html>
<?php
include("Foot.php");
ob_flush();
?>