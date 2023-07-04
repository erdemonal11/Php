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
    $Squery = "SELECT ssn FROM Student";
    $Sresult = mysqli_query($conn , $Squery);
    ?>
    
    <h4> Student details for: </h4>
    <form method="post" action="studentDisplay.php">
        <select name = "ssn">
            <?php
            while ($row=mysqli_fetch_assoc($Sresult)){
                $ssn = $row["ssn"];
                echo "<option>",$ssn,"\n";
            }
            ?>
        </select>
        <input type="submit" value="Get Student Details">
            </form>
    
    <br>
    <p></p>
    <a href ="MainPage.html" > Back to Main Page</a><P>
</body>
</html>
