<?php
if(isset($_POST["btn_submit"]))
{
	$fname=$_POST["txt_fname"];
	$lname=$_POST["txt_lname"];
	$gender=$_POST["rd_gender"];
	$dept=$_POST["slc_dept"];
	$mark1=$_POST["txt_mark1"];
	$mark2=$_POST["txt_mark2"];
    $mark3=$_POST["txt_mark3"];
}
{
if($gender=="Male")
   $name="Mr." + "$fname" + "$lname";
else
  $name="Mrs." + "$fname" + "$lname";   
}
{
	$total=$mark1+$mark2+$mark3;
}
{
	$p=($total/300)*100;
}
{
	if($p>=90)
	   {
		   $grade="S";
	   }
	else if($p>=80)
	     {
		   $grade="A";
	     }
	    else if($p>=70)
	        {
		     $grade="B";
	        } 
		    else if($p>=60)
	             {
		           $grade="C";
	             }
				 else if($p>=50)
				      {
		                $grade="D";
	                  }
					  else {
						  $grade="Failed";
					  }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>First Name</td>
      <td><label for="txt_fname"></label>
      <input type="text" name="txt_fname" id="txt_fname" /></td>
    </tr>
    <tr>
      <td>Last Name</td>
      <td><label for="txt_lname"></label>
      <input type="text" name="txt_lname" id="txt_lname" /></td>
    </tr>
    <tr>
      <td>Gender      </td>
      <td><input type="radio" name="radio" id="rd_gender" value="rd_gender" />
      <label for="rd_gender">Male 
        <input type="radio" name="radio" id="rd_gender" value="rd_gender" />
      Female</label></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><label for="slc_dept"></label>
        <select name="slc_dept" id="slc_dept">
          <option value="IT">BCA</option>
          <option value="BUSINESS">BBA</option>
          <option value="FINANCE">B.COM</option>
          <option value="LITERATURE">BA</option>
      </select></td>
    </tr>
    <tr>
      <td>Mark 1</td>
      <td><label for="txt_mark1"></label>
      <input type="text" name="txt_mark1" id="txt_mark1" /></td>
    </tr>
    <tr>
      <td>Mark 2</td>
      <td><label for="txt_mark2"></label>
      <input type="text" name="txt_mark2" id="txt_mark2" /></td>
    </tr>
    <tr>
      <td>Mark 3</td>
      <td><label for="txt_mark3"></label>
      <input type="text" name="txt_mark3" id="txt_mark3" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
  <table width="200" border="1">
    <tr>
      <td>Name <?php echo $name ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Gender <?php echo $ngender ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Department <?php echo $dept ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Total <?php echo $total ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>% <?php echo $p ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Grade <?php echo $grade ?></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>

