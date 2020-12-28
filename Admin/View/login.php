<html>

<head>
	<title>Login</title>
</head>

<body>
	<?php 
		include_once("../../connection.php");
		session_destroy();
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			echo $data;
			$data = $cn->query("select * from Registration_tbl where Username='$username' && password='$password' ");
		
			if(mysqli_num_rows($data)>0)
			{
				
				$_SESSION['username']=$username;
				header("Location: category.php");
			}
				
			else {
				$msg = 1;
			}
		}
	
	?>
	<center>
		<form method="post" action="login.php">
			<table>
				<tr>
					<td>Enter Username:</td>
					<td><input type="text" name="username"></td>
				</tr>
				<tr>
					<td>Enter Password:</td>
					<td><input type="Password" name="password"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Login"></td>
				</tr>
			</table>
			<?php
			if(isset($msg))
				echo "Invalid username or password";
		?>
		</form>
	</center>
</body>

</html>