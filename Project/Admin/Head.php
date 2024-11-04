<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../Assets/Templates/Admin/vendors/feather/feather.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../Assets/Templates/Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../Assets/Templates/Admin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../Assets/Templates/Admin/images/favicon.png" />
</head>
<?php
include("../Assets/Connection/Connection.php");
session_start();
$sel = "select * from tbl_admin where admin_id=".$_SESSION["aid"];
$res = $con->query($sel);
$data = $res->fetch_assoc();
?>
<body>
  <div class="container-scroller"> 
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="../Assets/Templates/Admin/index.html">
            <img src="../Assets/Templates/Admin/images/logo.svg" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="../Assets/Templates/Admin/index.html">
            <img src="../Assets/Templates/Admin/images/logo-mini.svg" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold"><?php echo $data["admin_name"]; ?></span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          
          
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="../Assets/Templates/Admin/images/faces/face8.jpg" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="../Assets/Templates/Admin/images/faces/face8.jpg" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold">Adhya</p>
                <p class="fw-light text-muted mb-0">adhyatheadmin@gmail.com</p>
              </div>
              
              <a  href="../Guest/Logout.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="HomePage.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <!-- <li class="nav-item nav-category">UI Elements</li> -->
          <!-- dropdown -->
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">Basic Datas</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="District.php">District</a></li>
                <li class="nav-item"> <a class="nav-link" href="Place.php">Place</a></li>
                <li class="nav-item"> <a class="nav-link" href="Category.php">Category</a></li>
                <li class="nav-item"> <a class="nav-link" href="SubCategory.php">SubCategory</a></li>
                <li class="nav-item"> <a class="nav-link" href="Brand.php">Brand</a></li>
              </ul>
            </div>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#seller" aria-expanded="false" aria-controls="seller">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">Seller List</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="seller">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="NewSellerList.php">New Seller</a></li>
                <li class="nav-item"> <a class="nav-link" href="AcceptedSellerList.php">Verified Seller</a></li>
                <li class="nav-item"> <a class="nav-link" href="RejectedSellerList.php">Rejected Seller</a></li>
                
              </ul>
            </div>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="SellerSalesPieChart.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Report</span>
            </a>
          </li>
          
          <!-- single -->
          <li class="nav-item">
            <a class="nav-link" href="UserList.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">UserList</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ViewComplaint.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">ViewComplaint</span>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">