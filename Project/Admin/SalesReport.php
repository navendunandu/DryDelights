<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Request Report</title>
</head>

<body>
    <div class="content-wrapper">

        <form id="form1" name="form1" method="post" action="">
            <center>
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">select the Dates here</h4>
                            <table>
                                <tr>
                                    <td><label for="txt_f">From Date</label>
                                        <input type="date" name="txt_f" id="txt_f" max="<?php echo date('Y-m-d')?>" class="form-control">
                                    </td>

                                    <td><label for="txt_t">To Date</label>
                                        <input type="date" name="txt_t" id="txt_t" max="<?php echo date('Y-m-d')?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="margin:15px;text-align:center;">
                                            <input type="submit" name="btnsave" id="btnsave" class="btn btn-primary"
                                                style="background-color:#2865AF;" value="View Results" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </center>
            <?php
            if (isset($_POST["btnsave"])) {
                ?>
                <div class="col-lg-12 grid-margin stretch-card" style="margin-top:30px">
                    <div class="card">
                        <div class="card-body">
                        <div id="pri">
                            <h4 class="card-title">
                                <?php if (isset($_POST['btnsave'])) {
                                    echo "General Report - between " . $_POST["txt_f"] . " and " . $_POST["txt_t"];
                                } ?>
                            </h4>
                            <div class="table-responsive">
                               
                                    <table class="table-hover" bbooking="1" cellpadding="8px">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">Sl.no</th>
                                                <th style="text-align:center;">user Name</th>
                                                <th style="text-align:center;">Conatct/Email</th>
                                                
                                                <th style="text-align:center;">Address</th>
                                                <th style="text-align:center;">Product Name</th>
                                                <th style="text-align:center;">quantity</th>
                                                <th style="text-align:center;" width="123px">bookinged On</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $sel = "select * from tbl_cart c inner join tbl_product p on c.product_id=p.product_id  inner join tbl_booking o on o.booking_id=c.booking_id inner join tbl_user cu on cu.user_id=o.user_id where booking_status>'1' and booking_date between '" . $_POST["txt_f"] . "' and '" . $_POST["txt_t"] . "'";
                                            $row = $con->query($sel);
                                            $i = 0;
                                            while ($data = $row->fetch_assoc()) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data["user_name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data["user_contact"]; ?><br>
                                                        <?php echo $data["user_email"]; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $data["user_address"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data["product_name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data["cart_quantity"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data["booking_date"]; ?>
                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                            <center><input type="button" onclick="printDiv('pri')" id="invoice-print"
                                    class="btn btn-success" value="Print" /></center>
                       
                    </div>
                </div>
                <?php
            }
            ?>
        </form>
    </div>
</body>

</html>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<?php
include("Foot.php");
ob_flush();
?>