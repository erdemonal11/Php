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
    $Pquery = "SELECT p.pName , p.subject , p.budget , p.startDate , p.enddate , p.controllingDname , i.iname \n"

    . "FROM project p,instructor i\n"

    . "WHERE p.leadSsn = i.ssn;";
    $Presult = mysqli_query($conn, $Pquery);
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Project Name</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Subject</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Budget</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Start Date</font></th>
            <th><font face="Arial,Helvectica,sans-serif">End Date</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Controlling Department</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Controlling Instructor</font></th>
            <th><font face="Arial,Helvectica,sans-serif">List Of People Working On This Project</font></th>
        </tr>
        
        <?php
        echo "<h4> Project List <h4>";
        while($row = mysqli_fetch_assoc($Presult)){
            $pname = $row["pName"];
            $subject = $row["subject"];
            $budget = $row["budget"];
            $startDate = $row["startDate"];
            $enddate = $row["enddate"];
            $cDName = $row["controllingDname"];
            $iname = $row["iname"];
            
            echo "<tr>"
            ."<td> $pname </td>"
            ."<td> $subject </td>"
            ."<td> $budget </td>"        
            ."<td> $startDate </td>"
            ."<td> $enddate </td>"        
            ."<td> $cDName </td>"
            ."<td> $iname </td>"
            ."<td> <form method='post' action='ProjectPeopleList.php' >
                  
                  <input type='submit' name = 'pName' value = $pname>
            </form>"   
            ."</tr>";
        
        } 
            ?>    
            
        
      
    </table>
    <br>
    <p></p>
    <a href ="MainPage.html" > Back to Main Page</a><P>
</body>
</html>
