<?php
include("../Assets/Connection/connection.php");
session_start();
$id = $_GET['pID'];
$selQry = "SELECT * FROM tbl_product p 
           INNER JOIN tbl_subcategory s ON p.subcategory_id = s.subcategory_id 
           INNER JOIN tbl_category c ON s.category_id = c.category_id 
           INNER JOIN tbl_seller sl ON sl.seller_id = p.seller_id 
           INNER JOIN tbl_brand b ON b.brand_id = p.brand_id 
           WHERE p.product_id = ".$id;
$result = $con->query($selQry);
$row = $result->fetch_assoc();
ob_start();
include("Head.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Details</title>

<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
    body {
        background-color: #f9f9f9;
        color: #333;
        font-family: Arial, sans-serif;
    }
    .table-custom {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .gallery img {
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    .gallery img:hover {
        transform: scale(1.05);
    }
    .container {
        margin-top: 30px;
    }
    .main-image {
        width: 100%; /* Responsive full width */
        max-height: 400px; /* Set a max height for the main image */
        object-fit: cover; /* Cover the container */
    }
</style>
<script>
function changeImage(image) {
    document.getElementById("mainImage").src = image;
}
</script>
</head>

<body>

<div class="container">
    <h1 class="text-center my-4">Product Details</h1>
    
    <!-- Product Information Table -->
    <table class="table table-striped table-custom">
        <tr>
            <th scope="row">Product Name</th>
            <td><?php echo $row['product_name']; ?></td>
        </tr>
        <tr>
            <th scope="row">Product Description</th>
            <td><?php echo $row['product_details']; ?></td>
        </tr>
        <tr>
            <th scope="row">Price</th>
            <td><?php echo $row['product_price']; ?></td>
        </tr>
        <tr>
            <th scope="row">Category</th>
            <td><?php echo $row['category_name']; ?></td>
        </tr>
        <tr>
            <th scope="row">Subcategory</th>
            <td><?php echo $row['subcategory_name']; ?></td>
        </tr>
        <tr>
            <th scope="row">Brand</th>
            <td><?php echo $row['brand_name']; ?></td>
        </tr>
    </table>
    
    <!-- Gallery -->
    <h3 class="my-4">Gallery</h3>
    <div class="text-center mb-4">
        <!-- Main Product Image -->
        <img id="mainImage" src="../Assets/Files/Userdocs/<?php echo $row['product_photo']; ?>" class="main-image" alt="Product Image">
    </div>
    <div class="gallery row text-center">
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <img src="../Assets/Files/Userdocs/<?php echo $row['product_photo']; ?>" class="img-fluid" style="height:200px;" alt="Gallery Image" onclick="changeImage(this.src)">
        </div>
        <?php
        // Fetch and display additional gallery images
        $selGal = "SELECT * FROM tbl_gallery WHERE product_id = ".$id;
        $gresult = $con->query($selGal);
        while ($pic = $gresult->fetch_assoc()) {
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <img src="../Assets/Files/Gallery/<?php echo $pic['gallery_image']; ?>" class="img-fluid" style="height:200px;" alt="Gallery Image" onclick="changeImage(this.src)">
        </div>
        <?php } ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>
