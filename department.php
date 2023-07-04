<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
    <title>University DataBase</title>
</head>
<body>
    <?php
    include 'dbConnect.php';
    $Dquery = "SELECT d.dName , d.budget , i.iname ,  d.buildingname\n"

    . "FROM department d,instructor i\n"

    . "WHERE d.headSsn = i.ssn;";
    $Dresult = mysqli_query($conn, $Dquery);
    ?>
    
     <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Department Name</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Budget</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Head Instructor</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Building Name</font></th>
            <th><font face="Arial,Helvectica,sans-serif">List People In Department</font></th>
        </tr>
        
        <?php
        
        while($row = mysqli_fetch_assoc($Dresult)){
            $dname = $row["dName"];
            $budget = $row["budget"];
            $iname = $row["iname"];
            $buildingName = $row["buildingname"];
            
            echo "<tr>"
            ."<td> $dname </td>"
            ."<td> $budget </td>"
            ."<td> $iname </td>"
            ."<td> $buildingName </td>"
            ."<td><form method='post' action='departmentDisplay.php' >
                  
                  <input type='submit' name = 'dName' value = $dname>
            </form> </td>"
            ."</tr>";
                    
        }
        ?>
        </table>
    
    <br>
    <p></p>
    <a href ="MainPage.html" > Back to Main Page</a><P>
</body>
</html>
