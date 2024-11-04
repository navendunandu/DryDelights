<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

   
<div class="container my-5">
    <h2 class="text-center mb-4">User List</h2>

    <form id="form1" name="form1" method="post" action="">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">District</th>
                    <th scope="col">Place</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Profile</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry = "SELECT * FROM tbl_user n 
                           INNER JOIN tbl_place p ON n.place_id=p.place_id 
                           INNER JOIN tbl_district d ON p.district_id=d.district_id";
                $result = $con->query($selQry);
                $i = 0;
                while ($data = $result->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['district_name']; ?></td>
                        <td><?php echo $data['place_name']; ?></td>
                        <td><?php echo $data['user_name']; ?></td>
                        <td><?php echo $data['user_gender']; ?></td>
                        <td><?php echo $data['user_contact']; ?></td>
                        <td><?php echo $data['user_email']; ?></td>
                        <td><?php echo $data['user_password']; ?></td>
                        <td><img src="../Assets/Files/Userdocs/<?php echo $data['user_photo']; ?>" width="100" height="100" class="img-fluid"></td>
                        <td><a href="../Assets/Files/Userdocs/<?php echo $data['user_proof']; ?>" target="_blank">
                            <img src="../Assets/Files/Userdocs/<?php echo $data['user_proof']; ?>" width="100" height="100" class="img-fluid"></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
