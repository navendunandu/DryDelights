<?php
session_start();
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
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
    <h2 class="text-center mb-4">Complaints</h2>

    <form id="form1" name="form1" method="post" action="">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Date</th>
                        <th scope="col">Title</th>
                        <th scope="col">User</th>
                        <th scope="col">Product</th>
                        <th scope="col">File</th>
                        <th scope="col">Description</th>
                        <th scope="col">Reply</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $userid = $_SESSION['sid'];
                    $selQry = "select * from tbl_complaint c INNER JOIN tbl_product p ON c.product_id=p.product_id inner join tbl_user u on u.user_id=c.user_id INNER JOIN tbl_seller n ON p.seller_id=n.seller_id WHERE p.seller_id=".$_SESSION['sid'];
                    $result = $con->query($selQry);
                    $i = 0;
                    while ($data = $result->fetch_assoc())
                    {
                        $i++;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $data['complaint_date']; ?></td>
                        <td><?php echo $data['complaint_title']; ?></td>
                        <td><?php echo $data['user_name']; ?></td>
                        <td><?php echo $data['product_name']; ?></td>
                        <td>
                            <img src="../Assets/Files/Userdocs/<?php echo $data['complaint_file']; ?>" class="img-thumbnail" width="100" height="100" alt="Complaint File">
                        </td>
                        <td><?php echo $data['complaint_description']; ?></td>
                        <td><a href="Reply.php?cid=<?php echo $data['complaint_id'] ?>" class="btn btn-sm btn-primary">Reply</a></td>
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
