<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_GET['id']))
{
 $upQry="update tbl_cart set cart_status=".$_GET['st']." where cart_id=".$_GET['id'];
 if($con->query($upQry))
 {
	 ?>
     <script>
	 alert('Updated');
	 window.location="UserBooking.php";
	 </script>
     <?php
 }
 else
  {
	 ?>
     <script>
	 alert('Failed');
	 window.location="UserBooking.php";
	 </script>
     <?php
  }
 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<br><br><br>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Bookings</h2>
    
    <form id="form1" name="form1" method="post" action="">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $selQry = "SELECT * from tbl_cart c 
                            INNER JOIN tbl_product p ON c.product_id=p.product_id 
                            INNER JOIN tbl_booking b ON c.booking_id=b.booking_id 
                            INNER JOIN tbl_user n ON n.user_id=b.user_id  
                            WHERE booking_status='2' and seller_id=".$_SESSION['sid']." 
                              GROUP BY b.booking_id order by b.booking_date";
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
                            <a href="UserBooking.php?bid=<?php echo $data['booking_id']; ?>" class="btn btn-primary btn-sm">View Booking Details</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </form>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>