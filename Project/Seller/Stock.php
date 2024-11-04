<?php

include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
if(isset($_POST["btn_submit"]))

{

	$pid=$_GET["pID"];
	$stock=$_POST["txt_stock"];
	$insQry="insert into tbl_stock(stock_quantity,stock_date,product_id)values('$stock',curdate(),'$pid')";
if($con->query($insQry))
	  {
		  ?>
	<script>
				alert("Stock Added..");
				window.location="Stock.php?pID=<?php echo $_GET['pID']?>";

				</script>
    <?php
	  }
	  else
	  {
		  echo "Error";
	  }
  }
  
 if(isset($_GET["delID"]))
 {
	 $StockID=$_GET["delID"];
	 $delQry="delete from tbl_stock where stock_id=$StockID";
	 if($con->query($delQry))
 
{
?>
	<script>
				alert("Deleted");
				window.location="Stock.php?pID=<?php echo $_GET['pID']?>";
	</script>
 <?php     
 }
	  else
	  {
		  echo "Error";
	  }	 
 }
	  
 ?>
<br><br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<!--  -->
<div class="container my-5">
    <h2 class="text-center mb-4">Manage Stock</h2>

    <!-- Stock Quantity Input Form -->
    <form id="form1" name="form1" method="post" action="">
        <div class="row mb-3">
            <div class="col-md-6 offset-md-3">
                <div class="form-group mb-3">
                    <label for="txt_stock" class="form-label">Stock Quantity</label>
                    <input type="text" class="form-control" name="txt_stock" id="txt_stock" placeholder="Enter Stock Quantity" required>
                </div>
                <div class="d-grid">
                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Stock Data Table -->
    <table class="table table-striped table-bordered mt-4">
    <thead class="table-dark">
        <tr>
            <th scope="col">Sl No</th>
            <th scope="col">Date</th>
            <th scope="col">Quantity</th>
           
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $selQry = "SELECT * FROM tbl_stock WHERE product_id=" . $_GET['pID'];
        $result = $con->query($selQry);
        $i = 0;

        // Fetching total stock and cart quantities only once for efficiency
        $id = $_GET['pID'];
        $cart = "SELECT SUM(cart_quantity) AS cart_total FROM tbl_cart c inner join tbl_booking b on b.booking_id=c.booking_id WHERE booking_status >='2' and product_id='$id' ";
        $cresult = $con->query($cart);
        $cdata = $cresult->fetch_assoc();
        $Stock = "SELECT SUM(stock_quantity) AS total_stock FROM tbl_stock WHERE product_id='$id'";
        $sresult = $con->query($Stock);
        $sdata = $sresult->fetch_assoc();
        
        $totalStock = $sdata['total_stock'];
        $remainingStock = $totalStock - $cdata['cart_total'];

        // Display each stock entry
        while ($data = $result->fetch_assoc()) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['stock_date']; ?></td>
            <td><?php echo $data['stock_quantity']; ?></td>
            
            <td>
                <a href="Stock.php?delID=<?php echo $data['stock_id']; ?>&pID=<?php echo $_GET['pID'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr class="table-dark">
            <td  colspan="3" class="text-end"><strong> Total Stock:</strong>
           <?php if($totalStock==0)
           {
            echo "Out Of Stock";
           }
           else
           {
            echo $totalStock;
           } ?>
            <td  class="text-end"><strong>Remaining Stock:</strong>
            <?php if($remainingStock==0)
           {
            echo "Out Of Stock";
           }
           else
           {
            echo $remainingStock;
           } 
           ?></td>

        </tr>
    </tfoot>
</table>

</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>