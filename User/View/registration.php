<html>

<head>
	<title>Registration </title>
</head>

<body>
    <div style="text-align:end;">
        <a href="login_u.php">Login</a>
    </div>
	<?php 
		include_once("../../connection.php");
		session_start();
		//echo "Code : ".$_SESSION['code'];
		if(isset($_POST['username']))
		{
			
			$username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
			//echo $data;
			$data = $cn->query("select * from Login_tbl where Username='$username' && password='$password' ");
		
			if($_SERVER["REQUEST_METHOD"]=="POST")
			{
				if($_SESSION['code']==$_POST['txt_code'])
				{
					if(mysqli_num_rows($data)>0)
					{
						echo "<center>User is already exist !</center>";
					}
						
					else {
						$cn->query("insert into Login_tbl(username,password,email) values('$username','$password','$email')");
						$data = $cn->query("select * from Login_tbl where Username='$username' && password='$password' ");
						$d = $data->fetch_assoc();
						session_start();
						$_SESSION["userid"] = $d['loginid'];
						$_SESSION["username"] = $username;
						header("Location: category_u.php");
					}
				}
				else
				{
					echo "<center style='color:red;'>Invalid Captch !</center>";
				}
			}

            
		}
	
	?>
	<center>
		<form method="post" action="registration.php">
			<table>
				<tr>
					<td>Enter Username:</td>
					<td><input required type="text" name="username"></td>
				</tr>
				<tr>
					<td>Enter Password:</td>
					<td><input required type="Password" name="password"></td>
				</tr>
                <tr>
					<td>Enter Email:</td>
					<td><input required type="text" name="email"></td>
				</tr>
				<tr>
					<td>Captch Code:</td>
					<td><img src="captcha.php"></td>
				</tr>
				<tr>
					<td>Enter Captch Code:</td>
					<td><input required type="text" name="txt_code" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Registration"></td>
				</tr>
			</table>
		</form>
	</center>
</body>

</html>