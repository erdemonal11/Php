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
    <h1>STUDENT INFORMATION</h1>
    <?php
    include 'dbConnect.php';
    
    $ssn = $_POST['ssn'];
    $query = "SELECT * FROM Student WHERE ssn = '$ssn'";
    $result = mysqli_query($conn,$query);
    echo "Name: "; 
    $row = mysqli_fetch_assoc($result);
    $sname = $row["studentname"];
    $dName = $row["dName"];
    echo "$sname <br> Department: $dName";
    ?>
    <br>
    <p></p>
    <a href ="Student.php" > Back to Student Select Page</a><P>
    <a href ="MainPage.html" > Back to Main Page</a><P>
       
    <?php
    $Squery1 = "select s.gradorUgrad\n"

    . "from student s\n"

    . "where s.ssn='$ssn';";
    $Sresult1 = mysqli_query($conn, $Squery1);
    while ($row = mysqli_fetch_assoc($Sresult1)){
        $gradorUgrad = $row["gradorUgrad"];
        if ($gradorUgrad == 0)
            echo "Statement Of Student : Ungraduate";
        else if($gradorUgrad == 1)
            echo "Statement Of Student : Graduate";
    }
    echo "<br>";
    
    $Squery5 = "select s.studentname, i.iname\n"

    . "from student s join instructor i on s.advisorSsn=i.ssn \n"

    . "where s.ssn='$ssn';";
    $Sresult5 = mysqli_query($conn, $Squery5);
    
    while($row = mysqli_fetch_assoc($Sresult5)){
        $iname = $row["iname"];
        echo "$sname's advisor : $iname";
    }
    
    $Squery7 = "select s.gradorUgrad\n"

    . "from student s\n"

    . "where s.ssn='$ssn';";
    $Sresult7 = mysqli_query($conn, $Squery7);
    while($row = mysqli_fetch_assoc($Sresult7)){
        $gradorUgrad = $row["gradorUgrad"];
        
        if($gradorUgrad == 1){
            echo "<br>";
            $Squery7_1 = "SELECT i.iname\n"

    . "FROM gradstudent G, instructor i\n"

    . "WHERE g.supervisorSsn = i.ssn AND G.ssn = '$ssn';";
            $Sresult7_1 = mysqli_query($conn, $Squery7_1);
            while($row = mysqli_fetch_assoc($Sresult7_1)){
                $iname = $row["iname"];
                
                echo "Your Supervisor: $iname";
            }
        }
    }
   
    
    $Squery2 = "select e.courseCode,e.sectionId\n"

    . "from enrollment e\n"

    . "where e.sssn='$ssn';";
    $Sresult2 = mysqli_query($conn, $Squery2);
    ?>
        
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Course Code</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Section</font></th>
        </tr>
        
        <?php
        echo "<h4> $sname' Courses";
        while($row = mysqli_fetch_assoc($Sresult2)){
            $cCode = $row["courseCode"];
            $sectionId = $row["sectionId"];
            
            echo "<tr>"
            ."<td> $cCode </td>"
            ."<td> $sectionId </td>"
            ."</tr>";        
        }
        ?>
    </table>
    
    <?php
    $Squery3 = "select e.sssn, e.courseCode, e.grade\n"

    . "from enrollment e\n"

    . "where e.sssn='$ssn';";
    $Sresult3 = mysqli_query($conn, $Squery3);
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Course Code</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Grade</font></th>
        </tr>
        
        <?php
        echo "<h4> $sname Grades";
        while($row = mysqli_fetch_assoc($Sresult3)){
            $cCode = $row["courseCode"];
            $grade = $row["grade"];
            
            echo "<tr>"
            ."<td> $cCode </td>"
            ."<td> $grade </td>"
            ."</tr>";        
        }
        ?>
    </table>
        
    <?php
    $Squery4 =  "select w.courseCode, w.dayy,w.hourr,w.buildingName,w.roomNumber \n"

    . "from weeklyschedule w join enrollment e on w.courseCode=e.courseCode and w.sectionId=e.sectionId and w.semester=e.semester and w.yearr=e.yearr and w.issn = e.issn\n"

    . "where e.sssn='$ssn';";
    $Sresult4 = mysqli_query($conn, $Squery4);
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Course Code</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Day</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Hour</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Building Name</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Room Number</font></th>
        </tr>
        
        <?php
        echo "<h4> $sname's Weekly Schedule";
        while($row = mysqli_fetch_assoc($Sresult4)){
            $cCode = $row["courseCode"];
            $day = $row["dayy"];
            $hour = $row["hourr"];
            $buildingName = $row["buildingName"];
            $roomNumber = $row["roomNumber"];
            
            echo "<tr>"
            ."<td> $cCode </td>"
            ."<td> $day </td>"
            ."<td> $hour </td>"        
            ."<td> $buildingName </td>"
            ."<td> $roomNumber </td>"           
            ."</tr>";
            
        }
        ?>
    </table>
    
    <?php
    $Squery6 = "select c.courseCode\n"

    . "from curriculacourses c\n"

    . "where NOT EXISTS (select w.courseCode \n"

    . "                    from weeklyschedule w join enrollment e on w.courseCode=e.courseCode and w.sectionId=e.sectionId and w.semester=e.semester and w.yearr=e.yearr and w.issn = e.issn\n"

    . "                    where e.sssn='$ssn' and c.courseCode=w.courseCode);";
    $Sresult6 = mysqli_query($conn, $Squery6);
    ?>
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Course Code</font></th>
        </tr>
        
        <?php
        echo "<h4> Courses $sname Supposed To Take";
        while($row = mysqli_fetch_assoc($Sresult6)){
            $cCode = $row["courseCode"];
            
            echo "<tr>"
            ."<td> $cCode </td>"
            ."</tr>";
            
        }
                
        ?>
    </table>
    
    <?php
    if($gradorUgrad == 1){
        $Squery8 = "SELECT p.pname , i.iname , p.workingHour\n"

    . "FROM project_has_gradstudent p,instructor i\n"

    . "WHERE p.Gradssn = '$ssn' AND p.leadSsn = i.ssn;";
        $Sresult8 = mysqli_query($conn, $Squery8);
        
    ?>
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Project Name</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Leader Name</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Your Working Hours</font></th>
        </tr>
        
        <?php
        echo "<h4> Project $sname Working";
        while($row = mysqli_fetch_assoc($Sresult8)){
            $pname = $row["pname"];
            $iname = $row["iname"];
            $workingHour = $row["workingHour"];
            
            echo "<tr>"
            ."<td> $pname </td>"
            ."<td> $iname </td>"
            ."<td> $workingHour </td>"        
            ."</tr>";
                    
        }
    }
        ?>
    </table>
    
        
    <?php   
    mysqli_close($conn);
    ?>
</body>
</html>
