<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
    include 'dbConnect.php';
    $examName = $_GET['examname'];
    $cCode = $_GET['courseCode'];
    $yearr = $_GET['yearr'];
    $semester = $_GET['semester'];
    $sectionId = $_GET['sectionId'];
    
    $query10 = "select sum(g.pointsEarned),g.sssn\n"

    . "from gradesperquestion g \n"

    . "where g.examname='$examName' and g.courseCode='$cCode' and g.yearr= '$yearr' and g.semester= '$semester' and g.sectionId='$sectionId'\n"

    . "group by g.sssn;";
    
    $result10 = mysqli_query($conn, $query10);
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Points Earned</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Student SSN</font></th>
        </tr>
        
        <?php
        echo "<h4> Scores of $cCode $examName exam";
        while ($row = mysqli_fetch_assoc($result10)){
            $pointsEarned = $row["sum(g.pointsEarned)"];
            $sssn = $row["sssn"];
            
            echo "<tr>"
            ."<td> $pointsEarned </td> "
            ."<td> $sssn </td>"      
            ."</tr>";        
        }
        ?>
    </table>
    
    <a href ="InstructorDB.php" > Back to Instructor Page</a><P>
    <a href ="MainPage.html" > Back to Main Page</a><P>
</body>
</html>
