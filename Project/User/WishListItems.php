<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    
    <?php
   include("../Assets/Connection/Connection.php");
    session_start();
   
    $selQry="select * from tbl_wishlist w inner join tbl_product p on w.product_id=p.product_id inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on s.category_id=c.category_id inner join tbl_brand b on p.brand_id=b.brand_id WHERE w.user_id=".$_SESSION['uid'];
    $result=$con->query($selQry);
    while($data=$result->fetch_assoc()) {
        $id=$data['product_id'];
        $cart="select sum(cart_quantity) as cart_total from tbl_cart c inner join tbl_booking b on b.booking_id=c.booking_id where booking_status>=2 and product_id='$id'";
        $cresult=$con->query($cart);
        $cdata=$cresult->fetch_assoc();
        $Stock="select sum(stock_quantity) as total_stock from tbl_stock where product_id='$id'";
        $sresult=$con->query($Stock);
        $sdata=$sresult->fetch_assoc();
        $rem=$sdata['total_stock']-$cdata['cart_total'];

    ?>  

    <div class="col">
        <div class="card h-100">
            <img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" class="card-img-top" alt="<?php echo $data['product_name']; ?>" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $data["product_name"]; ?></h5>
                <p class="card-text">
                    <strong>Category:</strong> <?php echo $data["category_name"]; ?><br>
                    <strong>SubCategory:</strong> <?php echo $data["subcategory_name"]; ?><br>
                    <strong>Brand:</strong> <?php echo $data["brand_name"]; ?><br>
                    <strong>Price:</strong> ₹<?php echo $data["product_price"]; ?><br>
                    <strong>Details:</strong> <?php echo $data["product_details"]; ?>
                </p>
                <?php if($rem<=0) { ?>
                    <p class="text-danger">Out of Stock</p>
                <?php } else { ?>
                    <a href="#" class="btn btn-primary" onClick="addCart('<?php echo $data['product_id']?>')">Add to Cart</a>
                <?php } ?>
            </div>
            <div class="card-footer">
                <a href="ViewMore.php?pID=<?php echo $data['product_id']?>" class="btn btn-link">View More</a>
                <?php
                $SelWish="select * from tbl_wishlist where product_id=".$data['product_id']." and user_id=".$_SESSION['uid'];
                $resWish=$con->query($SelWish);
                if($resWish->num_rows > 0) {
                ?>
                    <a href="Search.php?remID=<?php echo $data['product_id']?>" class="btn btn-danger">Remove from Wishlist</a>
                <?php } else { ?>
                    <a href="Search.php?wishID=<?php echo $data['product_id']?>" class="btn btn-outline-secondary">Add to Wishlist</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php } ?>
    
    </div>
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
</div>