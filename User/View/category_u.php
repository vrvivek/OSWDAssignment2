<html>

<head>
	<title>Category</title>
    <style>  
            #leftbox { 
                float:left;  
                background:Red; 
                width:25%; 
                height:100%; 
            } 
            #middlebox{ 
                float:left;  
                background:Green; 
                width:75%; 
                height:100%; 
            } 
            
            h1{ 
                color:green; 
                text-align:center; 
                background:cyan;
            } 
            table{
                border-collapse: collapse;
                height:50%;
                width:100%;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
        <script >
        
            $(document).ready(function(){
                //$("#data").hide();
                // if(flag==1)
                // {
                //     $("#data").show();
                //     $.ajax({
                //         url: "http://localhost:82/OSWDAssignment2/User/View/product_u.php?cid="+id, 
                //         success: function(result){
                //             $("#data").html(result);
                //             //alert(result);
                //         }
                //     });
                // }
            });
            $("button").click(function(){
                $.ajax({
                    url: "http://localhost:8080/OSWDAssignment2/User/View/product_u.php?cid=7", 
                    success: function(result){
                        $("#div1").html(result);
                    }
                });
            });
            function myFunction(id) {
                //
                flag = 1;
                $("#data").show();
                
                    $.ajax({
                        url: "http://localhost:8080/OSWDAssignment2/User/View/product_u.php?cid="+id, 
                        success: function(result){
                            $("#data").html(result);
                            //alert(result);
                        }
                    });
                //alert(id);
            }
            <?php 
            
                $cid = isset( $_GET['cid']) ? $_GET['cid'] : "";
                $page = isset($_GET['page'])? $_GET['page'] : "";

                if( isset($cid) && isset($page) )
                {
                    ?>
                    myFunction(<?=$cid?>);
                    function myFunction(id) { 
                        var page=<?php if($page != "") { echo $page; } else { echo 1; }  ?>;         
                        $("#data").show();
                        //alert("http://localhost:82/OSWDAssignment2/User/View/product_u.php?cid="+id+"&page="+<?=$page?>);
                            $.ajax({
                                url: "http://localhost:8080/OSWDAssignment2/User/View/product_u.php?cid="+id+"&page="+page, 
                                success: function(result){
                                    $("#data").html(result);
                                    //alert(url);
                                    //alert(result);
                                }
                            });
                        //alert(id);
                    }
                    <?php
                    unset($cid);
                    unset($page);
                }            
            ?>
        </script> 
</head>

<body>
    <div style="text-align:end;">
    <?php 
        //session_start();
        //echo $_SESSION['username'];
        if(isset($_SESSION['userid']))
        {
            ?>
            <a href="login_u.php">Logout</a>
            <?php
        }
        else {
            ?>
            <a href="registration.php">Registration</a>
            <?php
        }

    ?>
    
    </div>
    <?php 
        include_once("../../connection.php");
        
    ?>
	<center>
        <div id = "boxes"> 
            <h1>Category</h1> 
            <div id = "leftbox"> 
                <h2>Category:</h2> 
                <table border=1 >                    
                    <tr>
                        <?php 
                            $data = $cn->query("select * from Category_tbl");
                            //product_u.php?cid=<?= $d['Cid']
                            $i = 0;
                            if($data->num_rows>0)  
                                while ($d=$data->fetch_assoc()) {
                                    $i++;
                                    ?><tr align="center">
                                        <td><a href="#" onclick="myFunction(<?=$d['Cid']?>)" id="pro<?=$i?>"><?= $d['Cname']?></a></td> 
                                    </tr><?php
                                }
                        ?>
                    </tr>
                </table>
            </div>  
              
            <div id = "middlebox"> 
                <div id="data">
                    
                </div>
            </div>    
        </div> 
	</center>
</body>

</html>