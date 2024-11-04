<?php
include("../Assets/Connection/Connection.php");
session_start();
 $selQry="select MAX(booking_id) as id from tbl_booking where booking_status='0' and user_id=".$_SESSION['uid'];
	  $res=$con->query($selQry);
	  if($data=$res->fetch_assoc())
	  {
		 
	  $bid=$data["id"];
	  }
	  if(isset($_POST["btn_submit"]))
	  {
		 $checkout=$_POST['txt_total'];
		$upBook="update tbl_booking SET booking_status='1',booking_amount=".$checkout." WHERE booking_id=".$bid;
		if($con-> query($upBook))
		{
		$upCart="update tbl_cart SET cart_status='1' WHERE booking_id=".$bid;
		if($con-> query($upCart))
		{
			?>
            <script>
				alert("Updated");
				window.location="PaymentGateway.php";
			</script>
			<?php
			
		}
		}
	else
		{
			echo "Error";
		}
	}
	  
if(isset($_GET["delID"]))
	{
		$cartID=$_GET["delID"];
		$delQry="delete from tbl_cart where cart_id=$cartID";
		
		if($con-> query($delQry))
		{
			?>
            <script>
				alert("Deleted");
				window.location="MyCart.php";
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

</head>

<body>

<div class="container my-5">
    <h2 class="text-center mb-4">My Cart</h2>
    
    <form id="form1" name="form1" method="post" action="">
        <?php
        if (!isset($bid)) {
            echo "<h1 class='text-center'>No item in the cart</h1>";
        } else {
        ?>
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Sl. No</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selQry = "SELECT * FROM tbl_cart c INNER JOIN tbl_product p ON c.product_id=p.product_id WHERE booking_id=" . $bid;
                    $result = $con->query($selQry);
                    $i = 0;
                    $checkout = 0;
                    while ($data = $result->fetch_assoc()) {
                        $total_price = $data['cart_quantity'] * $data['product_price'];
                        $checkout += $total_price;
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" class="img-fluid" width="100" height="100"></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td>
                                <input type="number" value="<?php echo $data['cart_quantity']; ?>" class="form-control" onChange="update(this.value,'<?php echo $data['cart_id'] ?>')" />
                            </td>
                            <td><?php echo number_format($data['product_price'], 2); ?></td>
                            <td><?php echo number_format($total_price, 2); ?></td>
                            <td>
                                <a href="MyCart.php?delID=<?php echo $data['cart_id'] ?>" class="btn btn-danger btn-sm">DELETE</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Checkout Price</td>
                        <td colspan="2">
                            <?php echo number_format($checkout, 2); ?>
                            <input type="hidden" value="<?php echo $checkout ?>" name="txt_total" />
                        </td>
                        <td class="text-center">
                            <input type="submit" name="btn_submit" id="btn_submit" value="CHECKOUT" class="btn btn-success" />
                        </td>
                    </tr>
                </tfoot>
            </table>
        <?php
        }
        ?>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
function update(qty,cid){
    $.ajax({
        url: '../Assets/AjaxPages/AjaxUpdate.php?qty=' + qty +"&cid="+cid,
        success: function(res) {
			console.log(res)
			window.location="MyCart.php"
        }
    });
}

</script>
</html>
<?php
include("Foot.php");
ob_flush();
?>