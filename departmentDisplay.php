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
    $dName = $_POST['dName'];
    
    $DPquery = "select i.iname\n"

    . "from instructor i\n"

    . "where i.dname = '$dName';";
    $DPresult = mysqli_query($conn, $DPquery);
    ?>
     <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Name</font></th>
        </tr>
        
        <?php
        echo "<h4> List Of Instructors In Department $dName </h4>";
        while($row = mysqli_fetch_assoc($DPresult)){
            $iname = $row["iname"];
            
            echo "<tr>"
            ."<td> $iname </td>"
            ."</tr>";
        }
        ?>
     </table>
    <?php
    $DPquery2 = "select s.studentid, s.studentname, i.iname\n"

    . "from Student s, instructor i\n"

    . "where s.dname = '$dName' and	i.ssn = s.advisorSsn;";
    $DPresult2 = mysqli_query($conn, $DPquery2);
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">ID</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Name</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Advisor</font></th>
        </tr>
        
        <?php
        echo "<h4> List Of Students In Department $dName </h4>";
        while($row = mysqli_fetch_assoc($DPresult2)){
            $studentID = $row["studentid"];
            $sname = $row["studentname"];
            $iname = $row["iname"];
            
            echo "<tr>"
            ."<td> $studentID </td>"
            ."<td> $sname </td>"
            ."<td> $iname </td>"
            ."</tr>";
        }
        ?>
    </table>
    <br>
    <p></p>
    <a href ="department.php" > Back to Department List Page</a><P>
    <a href ="MainPage.html" > Back to Main Page</a><P>
</body>
</html>
