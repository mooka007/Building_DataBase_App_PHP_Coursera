<?php 
session_start();
require_once "pdo.php";
if(!isset($_SESSION['name'])){
    die("Not Logged In");
}


$stmt= $pdo->query("SELECT make, model, year, mileage, auto_id FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Mohammed Yassine marzouki</title>

</head>
<body>
<div class="container">
    <h1>Welcome to the automobiles Database</h1>
    <ul>
        <table border='1'>
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Mileage</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <?php
                    foreach($rows as $row){

                        echo "<tr><td>";
                        echo($row['make']);
                        echo("</td><td>");
                        echo($row['model']);
                        echo("</td><td>");
                        echo($row['year']);
                        echo("</td><td>");
                        echo($row['mileage']);
                        echo("</td><td>");
                        echo('<a href="edit.php?auto_id='.$row['auto_id'].'">Edit</a> / <a href="delete.php?auto_id='.$row['auto_id'].'">Delete</a>');
                        echo("</td></tr>\n");
                    }
                    ?>
                </tr>
            </thead>
        </table>
    </ul>
    
    
        <p><a href="add.php">Add New Entry</a></p> 
        <P><a href="logout.php">Logout</a></P>
    
</div>
</body>