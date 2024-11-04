<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
	if(isset($_GET['rID']))
	{
	$upQry="update tbl_seller SET seller_status='2' WHERE seller_id=".$_GET['rID'];
	if($con->query($upQry))
	{
		?>
        <script>
		alert("Rejected");
		window.location="AcceptedSellerList.php";
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
  
  <div class="container my-5">
    <h2 class="text-center mb-4">Accepted Seller List</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Sl No</th>
                    <th>District</th>
                    <th>Place</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Photo</th>
                    <th>Proof</th>
                    <th>Logo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry="select * from tbl_seller n inner join tbl_place p on n.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id WHERE seller_status='1'";
                $result=$con->query($selQry);
                $i=0;
                while($data=$result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['district_name']; ?></td>
                    <td><?php echo $data['place_name']; ?></td>
                    <td><?php echo $data['seller_name']; ?></td>
                    <td><?php echo $data['seller_gender']; ?></td>
                    <td><?php echo $data['seller_contact']; ?></td>
                    <td><?php echo $data['seller_email']; ?></td>
                    <td><?php echo $data['seller_password']; ?></td>
                    <td><img src="../Assets/Files/Userdocs/<?php echo $data['seller_photo']; ?>" class="img-fluid img-thumbnail" width="100" height="100" alt="Seller Photo"></td>
                    <td><a href="../Assets/Files/Userdocs/<?php echo $data['seller_proof']; ?>" target="_blank"><img src="../Assets/Files/Userdocs/<?php echo $data['seller_proof']; ?>" class="img-fluid img-thumbnail" width="100" height="100" alt="Seller Proof"></a></td>
                    <td><img src="../Assets/Files/Userdocs/<?php echo $data['seller_logo']; ?>" class="img-fluid img-thumbnail" width="100" height="100" alt="Seller Logo"></td>
                    <td><a href="AcceptedSellerList.php?rID=<?php echo $data['seller_id']?>" class="btn btn-danger btn-sm">Reject</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>