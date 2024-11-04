<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include("Head.php");
?>
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <!-- <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">Bounce Rate</p>
                            <h3 class="rate-percentage">32.53%</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Page Views</p>
                            <h3 class="rate-percentage">7,682</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">New Sessions</p>
                            <h3 class="rate-percentage">68.8</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Avg. Time on Site</p>
                            <h3 class="rate-percentage">2m:35s</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">New Sessions</p>
                            <h3 class="rate-percentage">68.8</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Avg. Time on Site</p>
                            <h3 class="rate-percentage">2m:35s</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                          </div>
                        </div>
                      </div>
                    </div>  -->
                    <div class="container my-5">
    <h2 class="text-center mb-4">Recent Bookings</h2>
    <form id="form1" name="form1" method="post" action="">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Sl No</th>
                    <th>Photo</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // $user_id = $_SESSION['uid'];
                $selQry = "SELECT * FROM tbl_cart c INNER JOIN tbl_product p ON c.product_id=p.product_id INNER JOIN tbl_booking b ON c.booking_id=b.booking_id WHERE booking_status='2'";
                $result = $con->query($selQry);
                $i = 0;
                while ($data = $result->fetch_assoc()) {
                    $total_price = $data['cart_quantity'] * $data['product_price'];
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" class="img-fluid" width="100" height="100"></td>
                        <td><?php echo $data['product_name']; ?></td>
                        <td><?php echo number_format($data['product_price'], 2); ?></td>
                        <td><?php echo $data['cart_quantity']; ?></td>
                        <td><?php echo number_format($total_price, 2); ?></td>
                        <td>
                            <?php
                            if ($data['cart_status'] == 1) {
                                echo "Order Placed";
                            } elseif ($data['cart_status'] == 2) {
                                echo "Item Packed";
                            } elseif ($data['cart_status'] == 3) {
                                echo "Item ready for shipping";
                            } elseif ($data['cart_status'] == 4) {
                                echo "Out for delivery";
                            }elseif ($data['cart_status'] == 5) {
                                echo "Delivery Completed";
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
      include("Foot.php");
      ob_start();
      ?>  

