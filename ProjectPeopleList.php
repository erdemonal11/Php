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
    
    $pName = $_POST['pName'];
    
    $PDquery =  "select S.studentname, PS.pName as projectName\n"

    . "from project_has_gradstudent PS join student S on PS.Gradssn = S.ssn\n"

    . "where PS.pName = '$pName'\n"

    . "\n"

    . "UNION\n"

    . "\n"

    . "select I.iname , PI.pName as projectName\n"

    . "from project_has_instructor PI JOIN instructor I on PI.issn = I.ssn\n"

    . "where PI.pName = '$pName';";
    $PDresult = mysqli_query($conn, $PDquery);
    ?>
    
    <table border="2" cellspaceing="2" cellpadding="2">
        <tr>
            <th><font face="Arial,Helvectica,sans-serif">Name</font></th>
        </tr>
        
        <?php
        echo "<h4> List of People $pName</h4>";
        while ($row = mysqli_fetch_assoc($PDresult)){
            $sname = $row["studentname"];
            
            echo "<tr>"
            ."<td> $sname </td>"
            ."</tr>";
        }
        ?>
    </table> 
        <br>
    <p></p>
    <a href ="ProjectDB.php" > Back to Project List Page</a><P>
    <a href ="MainPage.html" > Back to Main Page</a><P>
</body>
</html>
