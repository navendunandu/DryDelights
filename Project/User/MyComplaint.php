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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Table</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .table-container {
            margin: 20px auto; /* Center the table */
            width: 80%; /* Set a width for the table */
        }
        .table-custom {
            margin-top: 20px;
            border-radius: 0.5rem; /* Rounded corners for the table */
            overflow: hidden; /* Clip the corners */
        }
        .table-custom th {
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text for headers */
        }
        .table-custom img {
            border-radius: 5px; /* Slightly rounded image corners */
        }
    </style>
</head>
<body>
<br>
<br>
<div class="table-container">
    <table class="table table-bordered table-striped table-custom">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Product</th>
                <th>File</th>
                <th>Reply</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $userid = $_SESSION['uid'];
        $selQry = "SELECT * FROM tbl_complaint c INNER JOIN tbl_product p ON c.product_id = p.product_id WHERE user_id = " . $userid;
        $result = $con->query($selQry);
        $i = 0;
        while ($data = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($data['complaint_title']); ?></td>
                <td><?php echo htmlspecialchars($data['complaint_description']); ?></td>
                <td><?php echo htmlspecialchars($data['product_name']); ?></td>
                <td><img src="../Assets/Files/Userdocs/<?php echo htmlspecialchars($data['complaint_file']); ?>" width="100" height="100" alt="Complaint File"></td>
                <td>
                    <?php
                    if ($data['complaint_status'] == 0) {
                        echo "Your complaint is not reviewed yet.";
                    } else if ($data['complaint_status'] == 1) {
                        echo htmlspecialchars($data['complaint_reply']);
                    }
                    ?>
                </td>
                <td><?php echo htmlspecialchars($data['complaint_date']); ?></td>
            </tr>
          
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</html>
<?php
include("Foot.php");
ob_flush();
?>