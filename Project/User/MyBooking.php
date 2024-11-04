<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include("Head.php");	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Bookings</title>
</head>

<body>

<div class="container my-5">
    <h2 class="text-center mb-4">My Bookings</h2>
    <form id="form1" name="form1" method="post" action="">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Sl No</th>
                    <th>Photo</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['uid'];
                $selQry = "SELECT * FROM tbl_cart c 
                           INNER JOIN tbl_product p ON c.product_id = p.product_id 
                           INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
                           WHERE booking_status = '2' AND user_id = '$user_id' 
                           ORDER BY c.booking_id";
                $result = $con->query($selQry);
                $i = 0;
                $lastBookingId = null; // Track last booking_id
                $lastProductId = null; // Track last product_id for actions

                while ($data = $result->fetch_assoc()) {
                    $total_price = $data['cart_quantity'] * $data['product_price'];
                    $i++;

                    // Check if we're starting a new booking_id group
                    if ($lastBookingId !== null && $lastBookingId != $data['booking_id']) {
                        // Close previous booking row group with action buttons
                        echo '<tr><td colspan="8" class="text-center">
                            <a href="Bill.php?id=' . $lastBookingId . '" class="btn btn-warning btn-sm">Bill</a>
                            <a href="PostComplaint.php?pID=' . $lastProductId . '" class="btn btn-warning btn-sm">Complaint</a>
                            <a href="Rating.php?pid=' . $lastProductId . '" class="btn btn-primary btn-sm">Rating</a>
                        </td></tr>';
                    }

                    // Set the new booking_id as the current one
                    if ($lastBookingId !== $data['booking_id']) {
                        $lastBookingId = $data['booking_id'];
                    }
                    $lastProductId = $data['product_id']; // Update last product_id
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" class="img-fluid" width="100" height="100"></td>
                        <td><?php echo $data['product_name']; ?></td>
                        <td><?php echo number_format($data['product_price'], 2); ?></td>
                        <td><?php echo $data['cart_quantity']; ?></td>
                        <td><?php echo number_format($total_price, 2); ?></td>
                        <td>
                            <?php
                            if ($data['cart_status'] == 1) {
                                echo "Order Placed";
                            } elseif ($data['cart_status'] == 2) {
                                echo "Item Packed";
                            } elseif ($data['cart_status'] == 3) {
                                echo "Item ready for shipping";
                            } elseif ($data['cart_status'] == 4) {
                                echo "Out for delivery";
                            } elseif ($data['cart_status'] == 5) {
                                echo "Delivery Completed";
                            }
                            ?>
                        </td>
                        <td>
                        <a href="PostComplaint.php?pID=<?php echo $data['product_id'] ?>" class="btn btn-warning btn-sm">Complaint</a>
                        <a href="Rating.php?pid=<?php echo $data['product_id'] ?>" class="btn btn-primary btn-sm">Rating</a>
                        </td> <!-- Empty column for alignment -->
                    </tr>
                <?php
                }

                // Display action buttons for the last booking set
                if ($lastBookingId !== null) {
                    echo '<tr><td colspan="8" class="text-center">
                        <a href="Bill.php?id=' . $lastBookingId . '" class="btn btn-warning btn-sm">Bill</a>
                    </td></tr>';
                }
                ?>
            </tbody>
        </table>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
