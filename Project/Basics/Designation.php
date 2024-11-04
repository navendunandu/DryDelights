<?php
include("../Assets/Connection/Connection.php");
$designation='';
$aId=0;


if(isset($_POST["btn_submit"]))
{
	$aId=$_POST['txt_aid'];
	$designation=$_POST["txt_designation"];

	
	if($aId!=0)
	{
		$upQry="update tbl_designation SET designation_name='$designation' WHERE designation_id='$aId'";
		if($con-> query($upQry))
		{
			?>
           <script>
		   		alert("Updated");
		   		window.location="Designation.php";
		   </script>
           <?php
		}
		else
		{
			echo "Error";
		}
	}
else
	{
	
	$insQry="insert into tbl_designation(designation_name)values('$designation')";
	if($con-> query($insQry))
	{
		?>
        <script>
			alert("Inserted");
			window.location="Designation.php";
		</script>
         <?php
	}
	else
	{
		echo "Error";
	}
	}
}
if(isset($_GET["delID"]))
{
	$designationID=$_GET["delID"];
	$delQry="delete from tbl_designation where designation_id=$designationID";
		if($con-> query($delQry))
		{
			?>
        	<script>
				alert("Deleted");
				window.location="Designation.php";
			</script>
        	<?php
		}
		else
		{
			echo "Error";
		}
	}
if(isset($_GET["eID"]))
{
	$aId=$_GET["eID"];
	$selQry="select * from tbl_designation where designation_id='$aId'";
	$result=$con->query($selQry);
	$data=$result->fetch_assoc();
	$designation=$data['designation_name'];	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="../Admin/HomePage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Designation</td>
      <td><label for="txt_designation"></label>
 <input type="hidden" name="txt_aid" id="txt_aid" value="<?php echo $aId;?>" />
      <input type="text" name="txt_designation" id="txt_designation" value="<?php echo $designation;?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Save" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
  <table width="200" border="1">
  <tr>
    <td>Sl No</td>
    <td>Designation</td>
    <td>Action</td>
  </tr>
  <tr>
    <?php
	$selQry="select * from tbl_designation";
	$result=$con->query($selQry);
	$i=0;
	while($data=$result->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data['designation_name']; ?></td>
      <td>
      <a href="Designation.php?delID=<?php echo $data['designation_id']?>">DELETE</a>
       <a href="Designation.php?eID=<?php echo $data['designation_id']?>">EDIT</a>
       </td>
    </tr>
    <?php
	}
	?>
  </tr>
</table>

</form>
</body>
</html>