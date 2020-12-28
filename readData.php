<?php
    
    include_once("connection.php");
    $result = mysqli_query($cn, "SELECT * FROM Student_tbl");
	$fp=fopen("student.xml","w");
		if(mysqli_num_rows($result)!=0)
		{
            $xml_str="<?xml version='1.0' encoding='ISO-8859-1' ?>\n";
            $xml_str.="<Students>\n";
            while ($row = mysqli_fetch_array($result)) 
            {
                $xml_str.="<Student>\n";
                $xml_str.="<StudentId>".$row['StudentId']."</StudentId>\n";
                $xml_str.="<StudentName>".$row['StudentName']."</StudentName>\n";
                $xml_str.="<Email>".$row['Email']."</Email>\n";
                $xml_str.="<PhoneNo>".$row['PhoneNo']."</PhoneNo>\n";
                $xml_str.="</Student>\n";
            }
            $xml_str.="</Students>\n";
		}
		
	fwrite($fp,$xml_str);
    
    $xml=simplexml_load_file("student.xml");
    
    ?>
    <table border=1>
        <tr>
            <td>StudentId</td>
            <td>StudentName</td>
            <td>PhoneNo</td>
            <td>Email</td>
        </tr>
    
    <?php
    
    foreach ($xml->children() as $student) {
        ?>
        <tr>
            <td><?= $student->StudentId ?></td>
            <td><?= $student->StudentName ?></td>
            <td><?= $student->PhoneNo ?></td>
            <td><?= $student->Email ?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php

?>