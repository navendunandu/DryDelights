<?php
session_start();
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
 if(isset($_POST["btn_submit"]))
 {
	$agent=$_POST["selAgent"];
	$upQry="update tbl_cart set cart_status=3, deliveryagent_id=".$_POST['selAgent']." where cart_id=".$_GET['id'];
	if($con->query($upQry)){
	?>
    <script>
	alert("Assigned")
	window.location="UserBooking.php"
	</script>
    <?php	
	}
 }
 
?>

<div class="container my-5">
    <h2 class="text-center">Assign Delivery Agent</h2>
    
    <form name="form1" method="post" action="">
        <div class="row mb-3">
            <label for="selAgent" class="col-sm-2 col-form-label">Select Agent</label>
            <div class="col-sm-10">
                <select name="selAgent" id="selAgent" class="form-select">
                    <option value="----select----">----select----</option>
                    <?php
                    // Fetch delivery agents associated with the current seller
                    $SelQry = "select * from tbl_deliveryagent where seller_id='" . $_SESSION['sid'] . "'";
                    $result = $con->query($SelQry);
                    while ($data = $result->fetch_assoc()) {
                        echo "<option value='{$data['deliveryagent_id']}'>{$data['deliveryagent_name']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-12 text-center">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary">
            </div>
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