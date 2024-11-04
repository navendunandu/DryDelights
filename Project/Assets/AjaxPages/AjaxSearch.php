<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    
    <?php
    include("../Connection/Connection.php");
    session_start();
    $cat=$_GET["cat"];
    $pname=$_GET["pname"];
    $subcat=$_GET["subcat"];
    $brand=$_GET["brand"];

    $selQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on s.category_id=c.category_id inner join tbl_brand b on p.brand_id=b.brand_id WHERE TRUE";
    if($cat!="") {
        $selQry=$selQry." and s.category_id=".$cat;
    }
    if($pname!="") {
        $selQry=$selQry." and p.product_name LIKE '%$pname%'";
    }
    if($subcat!="") {
        $selQry=$selQry." and p.subcategory_id=".$subcat;
    }
    if($brand!="") {
        $selQry=$selQry." and p.brand_id=".$brand;
    }

    $result=$con->query($selQry);
    while($data=$result->fetch_assoc()) {
        $id=$data['product_id'];
        $cart="select sum(cart_quantity) as cart_total from tbl_cart c inner join tbl_booking b on b.booking_id=c.booking_id where booking_status=2 and product_id='$id'";
        $cresult=$con->query($cart);
        $cdata=$cresult->fetch_assoc();
        $Stock="select sum(stock_quantity) as total_stock from tbl_stock where product_id='$id'";
        $sresult=$con->query($Stock);
        $sdata=$sresult->fetch_assoc();
        $rem=$sdata['total_stock']-$cdata['cart_total'];
        $query = "SELECT SUM(rating_value) as rating, COUNT(*) as count FROM tbl_rating WHERE product_id = $id";
$resultS = $con->query($query);

// Check if the query returned a resultS
    $rowS = $resultS->fetch_assoc();
    $totalRating = $rowS['rating'];
    $ratingCount = $rowS['count'];

    // Avoid division by zero
    if ($ratingCount > 0) {
        $averageRating = $totalRating / $ratingCount;
    } else {
        $averageRating = 0;
    }
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
               <a href="Rating.php?pid=<?php echo $data['product_id'] ?>&action=view"> <div class='star-rating' style="
    color: #DEAD6F;font-size:30px;
">
		<?php
for ($i = 1; $i <= 5; $i++) {
	if ($i <= $averageRating) {
		echo "<span>&#9733;</span>"; // Filled star
	} else {
		echo "<span>&#9734;</span>"; // Empty star
	}
}
		?>
		</div></a>
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
</div>