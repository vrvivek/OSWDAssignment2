<html>

<head>
	<title>Login</title>
</head>

<body>
    <div style="text-align:end;">
        <a href="registration.php">Registration</a>
    </div>
	<?php 
        include_once("../../connection.php");
        session_destroy();
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			echo $data;
			$data = $cn->query("select * from Login_tbl where Username='$username' && password='$password' ");
            $d = $data->fetch_assoc();
            if(mysqli_num_rows($data)>0)
            {
                session_start();
                $_SESSION["userid"] = $d['loginid'];
                $_SESSION["username"] = $username;
                header("Location: category_u.php");
            }	
			else {
				$msg = 1;
			}
		}
	
	?>
	<center>
		<form method="post" action="login_u.php">
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
			if(isset( $msg))
				echo "Invalid username or password";
		?>
		</form>
	</center>
</body>

</html>