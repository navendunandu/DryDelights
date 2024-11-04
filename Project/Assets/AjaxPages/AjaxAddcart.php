<?php
include("../Connection/Connection.php");
session_start();

$selQry="select * from tbl_booking where user_id='".$_SESSION["uid"]."' and booking_status='0'";
$result=$con->query($selQry);
if($result->num_rows>0)
{
	$selQry="select MAX(booking_id) as id from tbl_booking where user_id='".$_SESSION["uid"]."' and booking_status='0'";
	$res=$con->query($selQry);
	$row=$res->fetch_assoc();
	$bid=$row["id"];
	$selQry="select * from tbl_cart where booking_id='".$bid."' and product_id='".$_GET["pid"]."' and cart_status='0'";
	$result=$con->query($selQry);
	if($result->num_rows>0)
	{
		echo "Already Added to Cart";
	}
    else
     {
	    $insQry="insert into tbl_cart(product_id,booking_id)values('".$_GET["pid"]."','".$bid."')";
	    if($con->query($insQry))
	    {
		     echo "Added to Cart";
	    }
	    else
	     {
		   echo "Failed";
	     }
      }
}
else
   {
	  $insQry="insert into tbl_booking(user_id)value('".$_SESSION['uid']."')";
	  if($con->query($insQry))
	  {
		  $selQry="select MAX(booking_id) as id from tbl_booking where user_id='".$_SESSION["uid"]."' and booking_status='0'";
		  $res=$con->query($selQry);
		  if($row=$res->fetch_assoc())
		  {
			  $bid=$row["id"];
			  $insQry="insert into tbl_cart(product_id,booking_id)values('".$_GET["pid"]."','".$bid."')";
		       if($con->query($insQry))
	    {
		     echo "Added to Cart";
	    }
	    else
	     {
		   echo "Failed";
	     }
      }
   }
 }
   ?>
		  
		  
		  