<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
    <title>University DataBase</title>
</head>
<body>
    <?php
    include 'dbConnect.php';
    $query = "SELECT ssn FROM Instructor";
    $result = mysqli_query($conn , $query);
    ?>
    
    <h4> Instructor details for: </h4>
    <form method="post" action="InstructorDisplay.php">
        <select name = "ssn">
            <?php
            while ($row=mysqli_fetch_assoc($result)){
                $ssn = $row["ssn"];
                echo "<option>",$ssn,"\n";
            }
            ?>
        </select>
        <input type="submit" value="Get Instructor Details">
            </form>
    <br>    
        <a href ="MainPage.html" > Back to Main Page</a><P>
</body>
</html>
