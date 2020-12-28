<html>

<head>
	<title>Product</title>
    <style>  
            table{
                border-collapse: collapse;
                height:50%;
                width:100%;
            }
    </style>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script >
        
    $(document).ready(function(){
        
    });
    // function myFunction(cid,page) {
    //     $.ajax({
    //         url: "http://localhost:82/OSWDAssignment2/User/View/product_u.php?cid="+cid+"&page="+page, 
    //         success: function(result){
    //             $("#data").html(result);
    //             alert(result);
    //         }
    //     });
    // }
    <?php 
    
        $cid = $_GET['cid'];
        $page = $_GET['page'];

        if( isset($cid) && isset($page) )
        {
            ?>
            // myFunction(<?=$cid?>);
            // function myFunction(id) {                
            //     $("#data").show();
            //     //alert("http://localhost:82/OSWDAssignment2/User/View/product_u.php?cid="+id+"&page="+<?=$page?>);
            //         $.ajax({
            //             url: "http://localhost:8080/OSWDAssignment2/User/View/product_u.php?cid="+id+"&page="+<?=$page?>, 
            //             success: function(result){
            //                 $("#data").html(result);
            //                 //alert(url);
            //                 //alert(result);
            //             }
            //         });
                //alert(id);
            }
            <?php
            unset($cid);
            unset($page);
        }
    
    ?>
</script> 
<body>
    
    
    <?php 
        include_once("../../connection.php");
        $cid=$_GET['cid'];
        
        //Pagination Start
        $record_per_page = 3;
        $page = '';
        if(isset($_GET['page']))
        {
            $page=$_GET['page'];
        }
        else {
            $page=1;
        }
        $start_from = ($page-1)*$record_per_page;
        $query = "select * from Product_tbl where Cid='$cid' order by Pid DESC LIMIT $start_from , $record_per_page";
        //Pagination end
        //echo $page;
    ?>
	
    <h2>Product</h2> 	
        
                <?php 
                    $data = $cn->query($query);
                    if($data->num_rows>0)  {
                        ?>
                        <table border=1>
                            <tr>
                                
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Image</th>
                            </tr>
                        
                        <?php
                        while ($d=$data->fetch_assoc()) {
                            ?><tr align="center">
                                
                                <td><?= $d['Pname']?></td>
                                <td>
                                    <?php 
                                    
                                        $cat = $cn->query("select * from Category_tbl");
                                        if($cat->num_rows>0)  
                                            while ($d1=$cat->fetch_assoc()) {
                                                if($d1['Cid']==$d['Cid'])
                                                {
                                                    ?>
                                                    <?= $d1['Cname'] ?></td>
                                                    <?php
                                                }
                                            }

                                    ?>
                                <td><img src="../../Image/<?= $d['Image']?>" alt="<?= $d['Image']?>" width="100" height="100"></td>
                                
                            <tr/><?php
                        }
                        ?></table><?php
                    }
                    else {
                        echo "No Product found ! Please Select Category";
                    }
                ?>
        <div>
            <?php 
                $q = $cn->query("select * from Product_tbl");
                $total_record=$q->num_rows;
                $total_pages=ceil($total_record/$record_per_page);
                
                for ($i=0; $i < $total_pages; $i++) { 
                    $j = $i;
                    $j = $j+1;
                    //echo ' <a href="category_u.php?cid='.$cid.'&page='.$j.'">'.$j.'</a> ';
                    echo ' <a href="#" onclick="myFunction('.$cid.','.$j.')">'.$j.'</a> ';
                }
            ?>
        </div>
</body>

</html>