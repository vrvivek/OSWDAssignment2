<html>

<head>
	<title>Update Product</title>
</head>

<body>
    <div style="text-align:end;">
        <a href="login.php">Logout</a>
    </div>
    
    <a href="product.php">Product</a>
    <?php 
        include_once("../../connection.php");
        $id = $_GET['id'];
        $data=$cn->query("select * from Product_tbl where Pid='$id' ");
        $val = $data->fetch_assoc();
        $img = $val['image'];
        $pname = $_POST["product"];
        $cid = $_POST['cid'];
        if(isset($_POST["product"]) && isset($_POST['cid']))
        {
            $target_dir = "../../Image/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
                
                echo basename($_FILES["image"]["name"]);
                if($img!=basename($_FILES["image"]["name"]))
                {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    $image = basename($_FILES["image"]["name"]);
                    $data=$cn->query("update Product_tbl set Pname='$pname',Cid='$cid',Image='$image' where Pid='$id' ");
                    header("Location: product.php");
                }
                else {
                    $data=$cn->query("update Product_tbl set Pname='$pname',Cid='$cid' where Pid='$id' ");
                    header("Location: product.php");
                }
                
            } else {
                //echo $pname." ".$cid." ".$id;
                $data=$cn->query("update Product_tbl set Pname='$pname',Cid='$cid' where Pid='$id' ");
                //echo "File is not an image.";
                $uploadOk = 0;
                header("Location: product.php");
            }
        }
    
    ?>
	<center>
		<form method="post" enctype="multipart/form-data" action="updateProduct.php?id=<?= $id ?>">
			<table>
				<tr>
					<td>Enter Product-Name:</td>
					<td><input type="text" value="<?= $val['Pname'] ?>" name="product"></td>
				</tr>

                <tr>
					<td>Select Product-Category:</td>
					<td>
                        <select name="cid">
                            <option value="-1">Select Category</option>
                            <?php 
                                $data = $cn->query("select * from Category_tbl");
                                if($data->num_rows>0)  
                                    while ($d=$data->fetch_assoc()) {
                                        if($val['Cid']==$d['Cid'])
                                        {
                                            ?>
                                            <option selected value="<?= $d['Cid'] ?>"><?= $d['Cname'] ?></option>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <option value="<?= $d['Cid'] ?>"><?= $d['Cname'] ?></option>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                            ?>
                        </select>
                    </td>
				</tr>

                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>   
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