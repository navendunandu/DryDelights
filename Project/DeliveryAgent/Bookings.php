<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include("Head.php");

if (isset($_GET['id'])) {
    $upQry = "UPDATE tbl_cart SET cart_status = " . $_GET['st'] . " WHERE cart_id = " . $_GET['id'];
    if ($con->query($upQry)) {
        ?>
        <script>
            alert('Updated');
            window.location = "UserBooking.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Failed');
            window.location = "UserBooking.php";
        </script>
        <?php
    }
}
?>
<br><br><br><br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .table-custom {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>

<body>
<div class="container">
    <h2 class="text-center">View Bookings</h2>
    <form id="form1" name="form1" method="post" action="">
        <table class="table table-striped table-custom">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry = "SELECT * FROM tbl_cart c 
                            INNER JOIN tbl_product p ON c.product_id = p.product_id 
                            INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
                            INNER JOIN tbl_user n ON n.user_id = b.user_id 
                            WHERE booking_status = '2' AND c.deliveryagent_id = " . $_SESSION['did'] . " 
                            GROUP BY b.user_id";
                $result = $con->query($selQry);
                $i = 0;
                while ($data = $result->fetch_assoc()) {
                    $total_price = $data['cart_quantity'] * $data['product_price'];
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['user_name']; ?></td>
                        <td><?php echo $data['user_address']; ?></td>
                        <td><?php echo $data['booking_amount']; ?></td>
                        <td>
                            <a href="UserBooking.php?bid=<?php echo $data['booking_id']; ?>" class="btn btn-custom btn-sm">View Booking Details</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>

</body>
</html>
<br><br><br>
<?php
include("Foot.php");
ob_flush();
?>
