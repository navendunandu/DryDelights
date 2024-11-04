<?php
if(isset($_POST["btn_submit"]))
{
	$no1=$_POST["txt_no1"];
	$no2=$_POST["txt_no2"];
	$no3=$_POST["txt_no3"];
}
if($no1>$no2)
  $large=$no1;
else
  $large=$no2;
if($large>$no3)
  $L=$large;
else
  $L=$no3;
if($no1<$no2)        
 $small=$no1;
else
  $small=$no2;
if($small<$no3)
  $S=$small;
else
  $S=$no3;
?>	
	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>No1</td>
      <td><label for="txt_no1"></label>
      <input type="text" name="txt_no1" id="txt_no1" /></td>
    </tr>
    <tr>
      <td>No2</td>
      <td><label for="txt_no2"></label>
      <input type="text" name="txt_no2" id="txt_no2" /></td>
    </tr>
    <tr>
      <td>No3</td>
      <td><label for="txt_no3"></label>
      <input type="text" name="txt_no3" id="txt_no3" /></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
    <tr>
      <td>Largest</td>
      <td><?php echo $L ?></td>
    </tr>
    <tr>
      <td>Smallest</td>
      <td><?php echo $S ?></td>
    </tr>
  </table>
</form>
</body>
</html>