<html>

<head>
	<title>Updat Category</title>
</head>
<body>
    <?php 
        include_once("../../connection.php");
        $id = $_GET['id'];
        $data=$cn->query("select * from Category_tbl where Cid='$id' ");
        $val = $data->fetch_assoc();
        if(isset($_POST["category"]))
        {
            $cname = $_POST["category"];
            $data=$cn->query("update Category_tbl set Cname='$cname' where Cid='$id' ");
            header("Location: category.php");
        }
    
    ?>
	<center>
		<form method="post" action="updateCategory.php?id=<?= $id ?>">
			<table>
				<tr>
					<td>Enter Category:</td>
					<td><input type="text" value=<?= $val['Cname'] ?> name="category"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Edit"></td>
				</tr>
            </table>
			
        </form>
	</center>
</body>

</html>