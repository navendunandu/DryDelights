<html>
<?php
$result = 0;
 if(isset($_POST["btn_submit"]))
 {
 $num1 = $_POST["txt_no1"];
 $num2 = $_POST["txt_no2"];
 $result=$num1+$num2;
 }
?>
<body>

<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td height="34">Num1</td>
      <td><label for="txt_no1"></label>
      <input type="text" name="txt_no1" id="txt_no1" /></td>
      <td>Num2</td>
      <td><label for="txt_no2"></label>
      <input type="text" name="txt_no2" id="txt_no2" /></td>
    </tr>
    <tr>
      <td colspan="4"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
    <tr>
      <td colspan="2">Result</td>
      <td colspan="2"><?php echo $result ?></td>
    </tr>
  </table>
</form>
</body>
</html>
