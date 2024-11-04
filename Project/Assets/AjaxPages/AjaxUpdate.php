<?php
include("../Connection/Connection.php");
session_start();
$qty=$_GET["qty"];
$cart=$_GET["cid"];
if($qty<=0)
{ 
	$delQry="delete from tbl_cart where cart_id=".$cart;
	if($con-> query($delQry))
		{
			echo "Deleted";
		}
		else
		{
			echo "Error";
		}
}
else
{
	$sql="update tbl_cart SET cart_quantity='$qty' where cart_id= ".$cart;
	if($con-> query($sql))
		{
			echo "Updated";
			
		}
		else
		{
			echo "Error";
		}
}
?>