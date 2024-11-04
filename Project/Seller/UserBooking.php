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
	 window.location="UserBooking.php?bid=<?php echo $_GET['bid'] ?>";
	 </script>
     <?php
 }
 else
  {
	 ?>
     <script>
	 alert('Failed');
	 window.location="UserBooking.php?bid=<?php echo $_GET['bid'] ?>";
	 </script>
     <?php
  }
 }
 
 if(isset($_POST['btn_submit'])){
	 $agent=$_POST['selAgent'];
	$selCart="select * from tbl_cart c INNER JOIN tbl_product p ON c.product_id=p.product_id WHERE c.booking_id=".$_GET['bid']." and seller_id=".$_SESSION['sid'];
	$result=$con-> query($selCart);
	while($data=$result->fetch_assoc())
	{ 
	$upCart="update tbl_cart SET cart_status=3 ,deliveryagent_id=".$agent;
	if($con->query($upCart))
	{
		?>
		<script>
		alert('Assigned Delivery Agent');
		window.location="UserBooking.php?bid=<?php echo $_GET['bid'] ?>";
		</script>
<?php
 }
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
    <h2 class="text-center mb-4">User Booking</h2>

    <!-- Booking Data Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">Sl No</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Photo</th>
                <th scope="col">Product</th>
                <th scope="col">Amount</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $selQry="select * from tbl_cart c INNER JOIN tbl_product p ON c.product_id=p.product_id 
                     INNER JOIN tbl_booking b ON c.booking_id=b.booking_id 
                     INNER JOIN tbl_user n ON n.user_id=b.user_id 
                     WHERE booking_status='2' and seller_id=".$_SESSION['sid']." and c.booking_id=".$_GET['bid'];
            $result=$con->query($selQry);
            $i=0;
            $flag=0;
            while($data=$result->fetch_assoc()) {
                $total_price=$data['cart_quantity']*$data['product_price'];
                $i++;
                if($data['cart_status'] == 2) {
                    $flag++;
                }
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['user_name']; ?></td>
                <td><?php echo $data['user_address']; ?></td>
                <td><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" width="100" height="100" class="img-thumbnail"></td>
                <td><?php echo $data['product_name']; ?></td>
                <td><?php echo $data['product_price']; ?></td>
                <td><?php echo $data['cart_quantity']; ?></td>
                <td><?php echo $total_price; ?></td>
                <td>
                    <?php
                    if($data['cart_status']==1) {
                        echo "New Order";
                    } else if($data['cart_status']==2) {
                        echo "Item Packed";
                    } else if($data['cart_status']==3) {
                        echo "Assign Delivery Agent";
                    } else if($data['cart_status']==4) {
                        echo "Out for delivery";
                    } else if($data['cart_status']==5) {
                        echo "Item Delivered";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if($data['cart_status']==1) { ?>
                        <a href="UserBooking.php?st=2&id=<?php echo $data['cart_id'] ?>&bid=<?php echo $_GET['bid'] ?>" class="btn btn-success btn-sm">Item Packed</a>
                    <?php
                    } 
                    ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <!-- Assign Delivery Agent Form -->
    <?php if($flag == $i) { ?>
    <form id="assign-agent-form" method="post" action="">
        <div class="row mb-3">
            <div class="col-md-6 offset-md-3">
                <div class="form-group mb-3">
                    <label for="selAgent" class="form-label">Assign Delivery Agent</label>
                    <select class="form-select" name="selAgent" id="selAgent">
                        <option value="----select----">----select----</option>
                        <?php
                        $SelQry="select * from tbl_deliveryagent where seller_id='".$_SESSION['sid']."'";
                        $result=$con->query($SelQry);
                        while($data=$result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $data['deliveryagent_id']?>"><?php echo $data['deliveryagent_name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <?php } ?>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
							
<?php

?>

</body>
</html>
<br><br><br>
<?php
include("Foot.php");
ob_flush();
?>