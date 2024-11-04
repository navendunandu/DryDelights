<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include("Head.php");

if (isset($_GET['id'])) {
    $upQry = "UPDATE tbl_cart SET cart_status=" . $_GET['st'] . " WHERE cart_id=" . $_GET['id'];
    if ($con->query($upQry)) {
        echo "<script>alert('Updated'); window.location='UserBooking.php?bid=" . $_GET['bid'] . "';</script>";
    } else {
        echo "<script>alert('Failed'); window.location='UserBooking.php?bid=" . $_GET['bid'] . "';</script>";
    }
}

if (isset($_POST['btn_submit'])) {
    $agent = $_POST['selAgent'];
    $selCart = "SELECT * FROM tbl_cart c INNER JOIN tbl_product p ON c.product_id=p.product_id WHERE c.booking_id=" . $_GET['bid'] . " AND deliveryagent_id=" . $_SESSION['did'];
    $result = $con->query($selCart);
    
    while ($data = $result->fetch_assoc()) {
        $upCart = "UPDATE tbl_cart SET cart_status=3, deliveryagent_id=" . $agent;
        if ($con->query($upCart)) {
            echo "<script>alert('Assigned Delivery Agent'); window.location='UserBooking.php?bid=" . $_GET['bid'] . "';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
</head>
<br><br><br><br>
<body>
<div class="container mt-5">
    <h2 class="text-center">View Bookings</h2>
    <form id="form1" name="form1" method="post" action="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Address</th>
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
                $selQry = "SELECT * FROM tbl_cart c 
                           INNER JOIN tbl_product p ON c.product_id=p.product_id 
                           INNER JOIN tbl_booking b ON c.booking_id=b.booking_id 
                           INNER JOIN tbl_user n ON n.user_id=b.user_id  
                           WHERE cart_status >= '3' AND deliveryagent_id=" . $_SESSION['did'] . " 
                           AND c.booking_id=" . $_GET['bid'];
                $result = $con->query($selQry);
                $i = 0;
                $flag = 0;
                
                while ($data = $result->fetch_assoc()) {
                    $total_price = $data['cart_quantity'] * $data['product_price'];
                    $i++;
                    if ($data['cart_status'] == 2) {
                        $flag++;
                    }
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['user_name']; ?></td>
                    <td><?php echo $data['user_address']; ?></td>
                    <td><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" width="100" height="100"></td>
                    <td><?php echo $data['product_name']; ?></td>
                    <td><?php echo $data['product_price']; ?></td>
                    <td><?php echo $data['cart_quantity']; ?></td>
                    <td><?php echo $total_price; ?></td>
                    <td>
                        <?php
                        switch ($data['cart_status']) {
                            case 3:
                                echo "New Order Assigned";
                                break;
                            case 4:
                                echo "Out for delivery";
                                break;
                            case 5:
                                echo "Item Delivered";
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($data['cart_status'] == 3) {
                            echo '<a href="UserBooking.php?st=4&id=' . $data['cart_id'] . '&bid=' . $_GET['bid'] . '" class="btn btn-warning btn-sm">Out for delivery</a>';
                        } elseif ($data['cart_status'] == 4) {
                            echo '<a href="UserBooking.php?st=5&id=' . $data['cart_id'] . '&bid=' . $_GET['bid'] . '" class="btn btn-success btn-sm">Item Delivered</a>';
                        }
                        ?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </form>

    <?php if ($flag == $i): ?>
    <form name="form1" method="post" action="">
        <div class="form-group">
            <label for="selAgent">Agent</label>
            <select name="selAgent" class="form-control" id="selAgent">
                <option value="----select----">----select----</option>
                <?php
                $SelQry = "SELECT * FROM tbl_deliveryagent WHERE seller_id='" . $_SESSION['sid'] . "'";
                $result = $con->query($SelQry);
                while ($data = $result->fetch_assoc()) {
                ?>
                <option value="<?php echo $data['deliveryagent_id'] ?>"><?php echo $data['deliveryagent_name']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
<br><br><br>
<?php
include("Foot.php");
ob_flush();
?>
