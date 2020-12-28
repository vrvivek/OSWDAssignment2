<html>

<head>
	<title>Category</title>
</head>

<body>
    <div style="text-align:end;">
    <a href="login.php">Logout</a>
    </div>
    
    <a href="product.php"> Product</a>
    <?php 
        include_once("../../connection.php");
        if(isset($_POST["category"]))
        {
            $cname = $_POST["category"];
            $data=$cn->query("insert into Category_tbl(Cname) values('$cname')");
        }
        if(isset($_GET['action']))
        {
            if($_GET['action']=="delete")
            {
                $id = $_GET['id'];
                $data=$cn->query("delete from Category_tbl where Cid='$id' ");
            }
        }
    
    ?>
	<center>
		<form method="post" action="category.php">
			<table>
				<tr>
					<td>Enter Category:</td>
					<td><input type="text" name="category"></td>
				</tr>
				
				<tr>
					<td></td>
					<td><input type="submit" value="Add"></td>
				</tr>
            </table>
            <table border=1>
                <tr>
                    <th>Category Id</th>
                    <th>Category Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tr>
                    <?php 
                        $data = $cn->query("select * from Category_tbl");
                        if($data->num_rows>0)  
                            while ($d=$data->fetch_assoc()) {
                                ?><tr>
                                    <td><?= $d['Cid']?></td>
                                    <td><?= $d['Cname']?></td>
                                    <td><a href="updateCategory.php?id=<?= $d['Cid'] ?>">Edit</a></td>
                                    <td><a href="category.php?action=delete&id=<?= $d['Cid'] ?>">Delete</a></td>
                                </tr><?php
                            }
                    ?>
                </tr>
            </table>
			<?php
            if(isset($_GET['data']))
            {
                $data = (int)$_GET['data'];
                if($data)
                    echo "Invalid username or password";
            }
		?>
        </form>
	</center>
</body>

</html>