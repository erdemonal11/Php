<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
    <title>University DataBase</title>
</head>
<body>
    <h1>INSTRUCTOR INFORMATION</h1>
    <?php
    include 'dbConnect.php';
    
    $ssn = $_POST['ssn'];
    $query = "SELECT * FROM instructor WHERE ssn = '$ssn'";
    $result = mysqli_query($conn,$query);
    echo "Name: "; 
    $row = mysqli_fetch_assoc($result);
    $iname = $row["iname"];
    $dName = $row["dName"];
    echo "$iname <br> Department: $dName";
    
    ?>
    <br>
    <p></p>
    <a href ="InstructorDB.php" > Back to Instructor Select Page</a><P>
    <a href ="MainPage.html" > Back to Main Page</a><P>
    
    <?php
    $query1 = "SELECT * \n"

    . "FROM sectionn s, instructor i \n"

    . "WHERE i.ssn = s.issn AND s.yearr = \"2023\" AND s.semester = \"2\" AND i.ssn = '$ssn';";
    
    $result1 = mysqli_query($conn,$query1);
    ?>
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Course Code</font></th>
            <th><font face="Arial,Helvectica,sans-serif">Section</font></th>
        </tr>
    <?php
    echo "<h4> $iname 's teaching courses";
    while ($row = mysqli_fetch_assoc($result1)){
        $cCode = $row["courseCode"];
        $sectionId = $row["sectionId"];
        echo "<tr>"
        . "<td> $cCode </td>"
        . "<td> $sectionId </td>"
        . "<tr>";
            
    }
    ?>
        </table>
    
    <?php
    $query2 = "SELECT w.courseCode, w.sectionId, w.dayy,w.hourr,w.buildingName,w.roomNumber\n"

    . "FROM weeklyschedule w, instructor i\n"

    . "Where i.ssn = w.issn AND i.ssn = '$ssn' ;";
    
    $result2 = mysqli_query($conn,$query2);
    
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
        <th><font face="Arial,Helvectica,sans-serif">Course Code</font></th>
        <th><font face="Arial,Helvectica,sans-serif">Seciton</font></th>
        <th><font face="Arial,Helvectica,sans-serif">Day</font></th>
        <th><font face="Arial,Helvectica,sans-serif">Hour</font></th>
        <th><font face="Arial,Helvectica,sans-serif">Building Name</font></th>
        <th><font face="Arial,Helvectica,sans-serif">Room Number</font></th>
        </tr>
    <?php
        echo "<h4> $iname 's Weekly Schedule";
        while ($row = mysqli_fetch_assoc($result2)){
            $cCode = $row["courseCode"];
            $sectionId = $row["sectionId"];
            $day = $row["dayy"];
            $hour = $row["hourr"];
            $buildingName = $row["buildingName"];
            $roomNumber = $row["roomNumber"];
                    
            echo "<tr>"
            . "<td> $cCode </td>"
            . "<td> $sectionId </td>"
            . "<td> $day </td>"
            . "<td> $hour </td>"   
            . "<td> $buildingName </td>"
            . "<td> $roomNumber </td>"
                    . "<tr>";         
                }
        ?>
    </table>
    
    <?php
    $query3_1 = "select distinct c.courseCode, c.courseName, c.ects ,s.sectionId\n"

    . "from course c, sectionn s\n"

    . "where s.issn = '$ssn' and s.yearr=2023 and s.semester = 2 and s.courseCode = c.courseCode;";
    $result3_1 = mysqli_query($conn,$query3_1);
    
    while ($row = mysqli_fetch_assoc($result3_1)){
       $cCode = $row["courseCode"];
       $sectionId = $row["sectionId"];
       
       $query3 = "select s.studentname , s.studentid ,s.dName\n"

    . "from enrollment e, student s\n"

    . "where e.yearr=2023 and e.semester = 2 and e.courseCode = '$cCode'  and e.sectionid = '$sectionId' and e.sssn = s.ssn;";
       
       $result3 = mysqli_query($conn,$query3);
       ?>
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
         <th><font face="Arial,Helvectica,sans-serif">Student Name</font></th>
         <th><font face="Arial,Helvectica,sans-serif">Student ID</font></th>
         <th><font face="Arial,Helvectica,sans-serif">Department Name</font></th>
         </tr>
         <?php
         echo "<h4> $cCode.$sectionId's Student List";
         while ($row = mysqli_fetch_assoc($result3)){
             $studentName = $row["studentname"];
             $studentID = $row["studentid"];
             $depName = $row["dName"];
             
             echo "<tr>"
             ."<td> $studentName </td>"
             ."<td> $studentID </td>"
             ."<td> $depName </td>"
             ."</tr>";
         }
         ?>
    </table>
        <?php };?>
    
    <?php
    $query4 = "select pName as projectName  from project p  where p.leadSsn = '$ssn';";
    $result4 = mysqli_query($conn,$query4);
    ?>
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Project Name</font></th>
        </tr>
        <?php
        echo "<h4> Projects $iname's Leading ";
        while ($row = mysqli_fetch_assoc($result4)){
            $pname = $row["projectName"];
            
            echo "<tr>"
            ."<td> $pname </td>"
            ."</tr>";
        }
        ?>
    </table>
    
    <?php
    $query5 = "select pName as projectName \n"

    . "from project_has_instructor pi \n"

    . "where pi.leadSsn = '$ssn'";
    $result5 = mysqli_query($conn,$query5);
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Project Name</th>
        </tr>
        <?php
        echo "<h4> Projects $iname's working on";
        while ($row = mysqli_fetch_assoc($result5)){
            $projName = $row["projectName"];
            
            echo "<tr>"
            ."<td> $projName </td>"
            ."</tr>";
                
        }
        ?>
    </table>
    
    <?php
    $query6 = "select s.studentname , s.studentid\n"

    . "from student s\n"

    . "where s.advisorSsn='$ssn';";
    $result6 = mysqli_query($conn, $query6)
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Student Name</th>
            <th><font face="Arial,Helvectica,sans-serif">Student ID</th>
        </tr>
        
        <?php
        echo "<h4> Students $iname's advising";
        while ($row = mysqli_fetch_assoc($result6)){
            $studentName = $row["studentname"];
            $studentID = $row["studentid"];
            
            echo"<tr>"
            ."<td> $studentName </td>"
            ."<td> $studentID </td>" 
            ."</tr>";        
        }
        ?>
    </table>
    
    <?php
    $query7 = "select g.ssn as GraduateStudentSSn\n"

    . "from gradstudent g\n"

    . "where g.supervisorSsn=\"i1\";";
    $result7 = mysqli_query($conn, $query7)
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Graduate Student Ssn</th>
        </tr>
        
        <?php
        echo "<h4> Graduate Students $iname's supervising";
        while ($row = mysqli_fetch_assoc($result7)){
            $gradssn = $row["GraduateStudentSSn"];
            
            echo "<tr>"
            ."<td> $gradssn </td>"
            ."</tr>";
                    
        }
        
        ?>
    </table>
    
    <?php
    $query8_1 = "select distinct c.courseCode, s.sectionId\n"

    . "from course c, sectionn s\n"

    . "where s.issn = '$ssn' and s.yearr=2023 and s.semester = 2 and s.courseCode = c.courseCode;";
    $result8_1 = mysqli_query($conn, $query8_1);
    
     while ($row = mysqli_fetch_assoc($result8_1)){
        $cCode = $row["courseCode"];
        $sectionId = $row["sectionId"];
        $query8 = "select T.dayy, T.hourr\n"

    . "from timeslot T\n"

    . "where (T.dayy, T.hourr) not in (SELECT W.dayy, W.hourr\n"

    . "                                   from enrollment E NATURAL JOIN weeklyschedule W\n"

    . "                                   where E.yearr=2023 and\n"

    . "                                E.semester = 2 and \n"

    . "                                E.sssn in (SELECT E2.sssn\n"

    . "                                            from enrollment E2\n"

    . "                                            where E2.sssn = E.sssn and E2.issn= '$ssn' and \n"

    . "                                            E2.courseCode='$cCode' and E2.sectionId = '$sectionId' \n"

    . "                                            and E2.yearr=2023 and  E2.semester = 2));";
        
        $result8 = mysqli_query($conn, $query8);
        ?>
        <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Day</th>
            <th><font face="Arial,Helvectica,sans-serif">Hour</th>
        </tr>
            
        <?php
        echo "<h4> Free Hour Report For Course $cCode.$sectionId </h4>";
        while ($row = mysqli_fetch_assoc($result8)){
            $day = $row["dayy"];
            $hour = $row["hourr"];
            
            
            echo"<tr>" 
                ."<td> $day </td>"
                ."<td> $hour </td>"
                ."<tr> ";
        }
    ?>
        
        
        </table> <?php }; ?>
    
    <?php
    $query9 = "select e.examname, e.courseCode,e.date,e.yearr,e.semester,e.sectionId\n"

    . "from examofsection e\n"

    . "where e.issn='$ssn';";
    $result9 = mysqli_query($conn, $query9);
    ?>
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Exam Name</th>
            <th><font face="Arial,Helvectica,sans-serif">Course Code</th>
            <th><font face="Arial,Helvectica,sans-serif">Date</th>
            <th><font face="Arial,Helvectica,sans-serif">Year</th>
            <th><font face="Arial,Helvectica,sans-serif">Semester</th>
            <th><font face="Arial,Helvectica,sans-serif">Section</th>
            <th><font face="Arial,Helvectica,sans-serif">Grade of Students</th>
        </tr>
        
        <?php
        echo "<h4> Exams $iname Delivered </h4>";
        while ($row = mysqli_fetch_assoc($result9)){
            $examName = $row["examname"];
            $cCode = $row["courseCode"];
            $date = $row["date"];
            $yearr = $row["yearr"];
            $semester = $row["semester"];
            $sectionId = $row["sectionId"];
            
            echo "<tr>"
            ."<td> $examName </td>"
            ."<td> $cCode </td>"
            ."<td> $date </td>"
            ."<td> $yearr </td>"        
            ."<td> $semester </td>"
            ."<td> $sectionId </td>"
            ."<td><a href ='displayExams.php?examname=$examName & courseCode=$cCode & yearr=$yearr & semester=$semester & sectionId=$sectionId'>Go To Grade Details</a>"    
            ."</tr>";            
        }
        ?>
    </table>
    <p> </p>
    <p></p>
    <a href ="InstructorDB.php" > Back to Instructor Page</a><P>
    <a href ="MainPage.html" > Back to Main Page</a><P>
  
    <?php   
    mysqli_close($conn);
    ?>
</body>
</html>
