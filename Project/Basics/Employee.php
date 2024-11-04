<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$department=$_POST["selDepartment"];
	$designation=$_POST["selDesignation"];
	$name=$_POST["txt_ename"];
	$gender=$_POST["rd_gender"];
	$basicsalary=$_POST["txt_basicsalary"];
	$contact=$_POST["txt_contact"];
	$email=$_POST["txt_email"];
	$DOB=$_POST["txt_dob"];
	$DOJ=$_POST["txt_doj"];
	$insQry="insert into tbl_employee(department_id,designation_id,employee_name,employee_gender,employee_basicsalary,employee_contact,employee_email,employee_dob,employee_doj)values('$department','$designation','$name','$gender','$basicsalary','$contact','$email','$DOB','$DOJ')";
	
	if($con-> query($insQry))
	{
	?>
		<script>
			alert("Inserted");
			//window.location="Employee.php";
		</script>
		<?php
	}
	else
	{
		echo "Error";
	}
}
if(isset($_GET["delID"]))
	{
		$employeeID=$_GET["delID"];
		$delQry="delete from tbl_employee where employee_id=$employeeID";
		
		if($con-> query($delQry))
		{
			?>
            <script>
				alert("Deleted");
				window.location="Employee.php";
			</script>
			<?php
			
		}
		else
		{
			echo "Error";
		}
		
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
      <td>Department</td>
      <td> <select name="selDepartment" >
        <option value="---select---">---select---</option>
        <?php
		$selQry="select * from tbl_department";
        $result=$con->query($selQry);
        while($data=$result->fetch_assoc())
        {
			
            ?>
          		<option value="<?php echo $data['department_id']?>"><?php echo $data['department_name']; ?></option>
                
              	<?php
					}
				?>

      </select></td>
    </tr>
    <tr>
      <td>Designation</td>
      <td><select name="selDesignation" >
        <option value="---select---">---select---</option>
        <?php
		$selQry="select * from tbl_designation";
        $result=$con->query($selQry);
        while($data=$result->fetch_assoc())
        {
			
            ?>
          		<option value="<?php echo $data['designation_id']?>"><?php echo $data['designation_name']; ?></option>
                
              	<?php
					}
				?>

      </select></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><label for="txt_ename"></label>
      <input type="text" name="txt_ename" id="txt_ename" /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="rd_gender" id="rd_gender" value="Male" />
        Male
          <input type="radio" name="rd_gender" id="rd_gender2" value="Female" />
          Female</td>
    </tr>
    <tr>
      <td>BasicSalary</td>
      <td><label for="txt_basicsalary"></label>
      <input type="text" name="txt_basicsalary" id="txt_basicsalary" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>DOB</td>
      <td><label for="txt_dob"></label>
      <input type="date" name="txt_dob" id="txt_dob" /></td>
    </tr>
    <tr>
      <td>DOJ</td>
      <td><label for="txt_doj"></label>
      <input type="date" name="txt_doj" id="txt_doj" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Save" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
  <table width="200" border="1">
  <tr>
    <td>Sl No</td>
    <td>Department</td>
    <td>Designation</td>
    <td>Name</td>
    <td>Gender</td>
    <td>BasicSalary</td>
    <td>Contact</td>
    <td>Email</td>
    <td>DOB</td>
    <td>DOJ</td>
    <td>Action</td>
  </tr>
  <tr>
        <?php
$selQry = "select * from tbl_employee e inner join tbl_department d ON e.department_id = d.department_id inner join tbl_designation s ON e.designation_id=s.designation_id";
$result = $con->query($selQry);
$i = 0;
while ($data = $result->fetch_assoc()) {
    $i++;
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data['department_name']; ?></td>
        <td><?php echo $data['designation_name']; ?></td>
        <td><?php echo $data['employee_name']; ?></td>
        <td><?php echo $data['employee_gender']; ?></td>
        <td><?php echo $data['employee_basicsalary']; ?></td>
        <td><?php echo $data['employee_contact']; ?></td>
        <td><?php echo $data['employee_email']; ?></td>
        <td><?php echo $data['employee_dob']; ?></td>
        <td><?php echo $data['employee_doj']; ?></td>
        <td>
            <a href="Employee.php?delID=<?php echo $data['employee_id'] ?>">DELETE</a>
        </td>
    </tr>
    <?php
}
?>

</table>

</form>
</body>
</html>