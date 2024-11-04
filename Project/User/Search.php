<?php
session_start();
include("../Assets/Connection/Connection.php");
if(isset($_GET['wishID']))
{
	$userid=$_SESSION['uid'];
	$pid=$_GET['wishID'];
	$insQry="insert into tbl_wishlist(wishlist_date,product_id,user_id)values(curdate(),'$pid','$userid')";
	if($con-> query($insQry))
	{
		?>
        <script>
			alert("Added to wishlist");
			window.location="Search.php";
		</script>
         <?php
	}
	else
	{
		echo "Error";
	}
	
}
if(isset($_GET['remID']))
{
	$delQry="delete from tbl_wishlist where user_id=".$_SESSION['uid']." and product_id=".$_GET['remID'];
	if($con-> query($delQry))
	{
		?>
        <script>
			alert("Removed");
			window.location="Search.php";
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
<title>Untitled Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body onload="getSearch()">
<div class="container my-5">
    <h1 class="text-center mb-4">Search Products</h1>
    <form id="form1" name="form1" method="post" action="">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="txt_pname" class="form-label">Product Name</label>
                <input type="text" name="txt_pname" id="txt_pname" class="form-control" placeholder="Enter product name" oninput="getSearch()">
            </div>
            <div class="col-md-3">
                <label for="selCategory" class="form-label">Category</label>
                <select name="selCategory" id="selCategory" class="form-select" onchange="getSubCat(this.value)">
                    <option value="">---select---</option>
                    <?php
                    $selQry="select * from tbl_category";
                    $result=$con->query($selQry);
                    while($data=$result->fetch_assoc())
                    {
                        ?>
                        <option value="<?php echo $data['category_id']?>"><?php echo $data['category_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="SubCat" class="form-label">SubCategory</label>
                <select name="selSubCategory" id="SubCat" class="form-select" onchange="getSearch()">
                    <option value="">---select---</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="SubBrand" class="form-label">Brand</label>
                <select name="brand_name" id="SubBrand" class="form-select" onchange="getSearch()">
                    <option value="">----select----</option>
                    <?php
                    $selQry="select * from tbl_brand";
                    $result=$con->query($selQry);
                    while($data=$result->fetch_assoc())
                    {
                        ?>
                        <option value="<?php echo $data['brand_id']?>"><?php echo $data['brand_name'];?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </form>

    <div id="result" class="mt-5">
        <!-- Search Result Goes Here -->
    </div>
</div>
</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getSubCat(cid) {
    $.ajax({
      url: "../Assets/AjaxPages/Ajaxsubcat.php?cid=" + cid,
      success: function (result) {

        $("#SubCat").html(result);
      }
    });
  }
  
 function getSearch(vid) {
	  var cat=document.getElementById("selCategory").value;
	  var pname=document.getElementById("txt_pname").value;
      var subcat=document.getElementById("SubCat").value;
	  var brand=document.getElementById("SubBrand").value;
	     console.log("category: "+cat); 
	     console.log("subcategory: "+subcat);
	     console.log("productname: "+pname);
	     console.log("brand: "+brand);
    $.ajax({
      url: "../Assets/AjaxPages/AjaxSearch.php?cat=" + cat +"&pname="+pname +"&subcat="+subcat +"&brand="+brand ,
      success: function (result) {

        $("#result").html(result);
      }
    });
  }
  
function addCart(pid){
    $.ajax({
        url: '../Assets/AjaxPages/AjaxAddCart.php?pid=' + pid,
        success: function(res) {
            alert(res.trim());
			console.log(res)
        }
    });
}
</script>

</html>
<?php
include("Foot.php");
ob_flush();
?>