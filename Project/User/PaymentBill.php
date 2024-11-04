<?php
include("../Assets/Connection/Connection.php");
    session_start();
    $id=$_SESSION['bid'];
    $user="SELECT * FROM tbl_user u INNER JOIN tbl_booking b on b.user_id = u.user_id INNER JOIN tbl_place p on p.place_id=u.place_id INNER JOIN tbl_district d on d.district_id=p.district_id where b.booking_id =".$id;
    $userRes=$con->query($user);
    $userData=$userRes->fetch_assoc();
    $name=$userData['user_name'];
    $contact=$userData['user_contact'];
    $place=$userData['place_name'];
    $district=$userData['district_name'];
    $address=$userData['user_address'];
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Tax Invoice</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
        * {
            box-sizing: border-box;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        pre,
        p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
        }

        table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
        }

        td,
        th {
            text-align: left;
            padding: 8px 6px;
        }

        .table-b td,
        .table-b th {
            border: 1px solid #ddd;
        }

        th {
            /* background-color: #ddd; */
        }

        .hm-p td,
        .hm-p th {
            padding: 3px 0px;
        }

        .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px;
            /* height of container */
            overflow: hidden;
        }

        .t1 {
            border-color: #4a4a4a;
        }

        .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- select query -->

    <button id="cmd" onClick="printDiv('content')"
        style="float:right;color:#FFF;background:#0C0;border:none;margin:20px;padding:10px;border-radius:10px">PDF
        Bill
    </button>
    <button id="cmd" onClick="generatePDFAndSend('content')"
        style="float:right;color:#FFF;background:#0C0;border:none;margin:20px;padding:10px;border-radius:10px">
        Email Bill
    </button>
    <br /><br /><br /><br /><br /><br />

    <section class="main-pd-wrapper" id="content">
        <div style="width: 1000px; margin: 0 auto; border: 1px solid #ddd; padding: 20px;">
            <h4 style="text-align: center; margin: 0;"></h4>
            <table style="width: 100%; border: 1px solid #ddd;">
                <tr>
                    <td style="border-right: 1px solid #ddd; padding: 20px;">
                        <div style="text-align: center; line-height: 1.5; font-size: 14px; color: #4a4a4a;">
                            <!-- <img style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden;"
                                src="../Assets/File/Admin/A.png" alt="logo"><br> -->
                            <span
                                style="font-family: garmond; color: #234A6F; font-size: 56px;">Dry Delights</span><br><br>
                        </div>
                    </td>
                    <td style="text-align: right; padding: 20px; line-height: 1.5; color: #323232;">
                       <!-- select query -->
                        <div style="margin-top: 5px; margin-bottom: 5px;">
                            <h4>Billing Address</h4>
                            <p style="font-size: 14px;">
                                <b>
                                    <?php echo $name ?>
                                </b><br>
                                <?php echo $address ?><br>
                                <?php echo $place.", ".$district ?><br>
                                Contact:
                                <?php echo $contact ?>
                            </p>
                        </div>
                        <!-- <div>
                            <br>
                            <h4 style="margin-top: 5px; margin-bottom: 5px;">Shipping Address</h4>
                            <p style="font-size: 14px;">
                                <b>
                                    <?php $name ?>
                                </b><br>
                                <?php $address ?><br>
                                <?php $place.", ".$district ?><br>
                                Contact:
                                <?php $contact ?>
                            </p>
                        </div> -->
                    </td>
                </tr>
            </table>
            <div class="t1" style="width: 100%;">
                
                <table style="margin: 0; background: #daf0f7; padding: 15px; padding-left: 20px; width: 100%;">
                    <tr>
                        <td style="width: 50%;">
                            <p>Order Date:
                                <?php
                                $bkselQry = "select * from tbl_booking where booking_id=".$_SESSION["bid"];
                                $bkres = $con->query($bkselQry);
                                $bkdata = $bkres->fetch_assoc();
                                ?>
                                <?php echo $bkdata["booking_date"] ?>
                            </p>
                            <p>Ordered from: DryDelights</p>
                        </td>
                        <td style="width: 50%; text-align: right;">
                            <p style="margin: 5px 0">Invoice Generated on:
                                <?php echo Date('Y-m-d') ?>
                            </p>
                            <p>Bill number:
                                <?php //Bill number ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <table style="border: 1px solid #ccc; width: 100%;">
                <tr>
                    <td style="padding: 10px;">
                        <table style="border: 1px solid #ccc; width: 940px;">
                            <tr style="background-color: #f0f0f0; font-weight: bold;">
                                <th style="padding: 5px; width: 30px;">#</th>
                                <th style="padding: 5px; width: 100px;">Product</th>
                                <th style="padding: 5px; width: 50px;">Price</th>
                                <th style="padding: 5px; width: 50px;">Qty</th>
                                <th style="padding: 5px; width: 70px;">Total Price</th>
                            </tr>
                            <!-- Select query -->
                             <?php
                             $i=0;
                             $selQry = "SELECT * FROM tbl_cart c
                             INNER JOIN tbl_product p ON c.product_id = p.product_id
                             INNER JOIN tbl_booking b ON c.booking_id = b.booking_id
                             INNER JOIN tbl_subcategory s ON s.subcategory_id = p.subcategory_id
                             INNER JOIN tbl_category ct ON ct.category_id = s.category_id
                             INNER JOIN tbl_seller sl ON sl.seller_id = p.seller_id
                             INNER JOIN tbl_user u ON u.user_id = b.user_id
                                                  WHERE b.booking_id=".$id;
                             $result = $con->query($selQry);
                             $grandTotal = 0;
                            while($data = $result->fetch_assoc())
                            {
                                $i++;
                                $total=$data['cart_quantity'] * $data['product_price'];
                                $grandTotal += $total;
                             ?>
                                <tr>
                                    <td style="padding: 5px; width: 30px;" align="center">
                                        <?php echo $i ?>
                                    </td>
                                    <td style="padding: 5px; width: 100px;" align="center">
                                        <?php echo $data['product_name'] ?>
                                    </td>
                                    <td style="padding: 5px; width: 50px;"  align="center" >
                                        <?php echo $data['product_price'] ?>
                                    </td>
                                    
                                    <td style="padding: 5px; width: 70px;"  align="center">
                                        <?php echo $data['cart_quantity'] ?>
                                    </td>
                                    <td style="padding: 5px; width: 70px;"  align="center">
                                        <?php echo $total ?>
                                    </td>
                                </tr>
                               <?php
                            }
                               ?>
                        </table>
                    </td>
                </tr>
            </table>
            <table class="hm-p table-bordered" style="width: 100%; margin-top: 30px;">
                <tr>
                    <td style="background: #b4cbf0; width: 50%; height: 60px; padding: 46px;">
                        <b>Grand Total</b>
                    </td>
                    <td style="background: #b4cbf0; width: 50%; height: 60px; padding: 46px;">
                        <b>
                            <?php echo $grandTotal;  ?>
                        </b>
                    </td>
                </tr>
            </table>
        </div>
        <P align="center"><a href="Mybooking.php">MyBooking</a></P>
    </section>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js'></script>
    <script>

        // printDiv('content');

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            console.log(printContents);
            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
        function generatePDFAndSend(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            // console.log(printContents);

            $.ajax({
                url: "../Assets/AjaxPages/AjaxMyPdf.php",
                method: "POST",
                data: { printContents: printContents },
                dataType: "JSON",
                success: function (data) {

                }
            })
        }

    </script>
</body>

</html>