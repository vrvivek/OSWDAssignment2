<?php
	session_start();
?>
<html>
<head>
<title>CAPTCHA Validation Form</title>
</head>
<?php
echo "Code : ".$_SESSION['code'];
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if($_SESSION['code']==$_POST['txt_code'])
		{
			echo "valid<br>";
			echo $_POST['txt_name']."<br>";
			echo $_POST['txt_address']."<br>";
		}
		else
		{
			echo "invalid";
		}
	}
?>
<body>
<form name="form1" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
   
   <p>Name: <input type="text" name="txt_name" /></p>
   <p>Address: <input type="text" name="txt_address" /></p>
		<img src="captcha.php"> 
<p>Enter CAPTCHA code:<input type="text" name="txt_code" /></p>
   <p><input type="submit" name="Submit" value="Submit" /></p>
</form>
</table>
</body>
</html>