<?php
$res=0;
if(isset($_POST["btn_plus"]))
{
	$no1=$_POST["txt_no1"];
	$no2=$_POST["txt_no2"];
	$res=$no1+$no2;
}
if(isset($_POST["btn_minus"]))
{
	$no1=$_POST["txt_no1"];
	$no2=$_POST["txt_no2"];
	$res=$no1-$no2;
}
if(isset($_POST["btn_mult"]))
{
	$no1=$_POST["txt_no1"];
	$no2=$_POST["txt_no2"];
	$res=$no1*$no2;
}
if(isset($_POST["btn_div"]))
{
	$no1=$_POST["txt_no1"];
	$no2=$_POST["txt_no2"];
	$res=$no1/$no2;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
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
      <td colspan="2"><input type="submit" name="btn_plus" id="btn_plus" value="+" />
      <input type="submit" name="btn_minus" id="btn_minus" value="-" />
      <input type="submit" name="btn_mult" id="btn_mult" value="*" />
      <input type="submit" name="btn_div" id="btn_div" value="/" /></td>
    </tr>
    <tr>
      <td>Result</td>
      <td><?php echo $res ?></td>
    </tr>
  </table>
</form>
</body>
</html>