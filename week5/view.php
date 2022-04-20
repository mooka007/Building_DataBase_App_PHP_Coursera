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
    <?php
    if (isset($_SESSION['success'])) {
        echo('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
        unset($_SESSION['success']);
    }
    ?>
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
                    // bach t2akad mn khuna 'name' => $_POST['email'] huwa li f session sinon ghadi tala3 lih please log in 
                    if(isset($_SESSION['name'])){
                        if(sizeof($rows) > 0){
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
                        }else {
                                echo 'No rows found';
                            }
                    }else {
                         echo "<p><a href='login.php'>Please log in</a></p><p>Attempt to <a href='add.php'>add data</a> without logging in</p>";
                    }


                    //     if (isset($_SESSION['name'])) {
                    //         if (sizeof($rows) > 0) {
                    //             echo "<table border='1'>";
                    //             echo " <thead><tr>";
                    //             echo "<th>Make</th>";
                    //             echo " <th>Model</th>";
                    //             echo " <th>Year</th>";
                    //             echo " <th>Mileage</th>";
                    //             echo " <th>Action</th>";
                    //             echo " </tr></thead>";
                    //             foreach ($rows as $row) {
                    //                 echo "<tr><td>";
                    //                 echo($row['make']);
                    //                 echo("</td><td>");
                    //                 echo($row['model']);
                    //                 echo("</td><td>");
                    //                 echo($row['year']);
                    //                 echo("</td><td>");
                    //                 echo($row['mileage']);
                    //                 echo("</td><td>");
                    //                 echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / <a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
                    //                 echo("</td></tr>\n");
                    //             }
                    //             echo "</table>";
                    //         } else {
                    //             echo 'No rows found';
                    //         }
                    //         echo '</li><br/></ul>';
                    //         echo '<p><a href="add.php">Add New Entry</a></p>
                    // <p><a href="logout.php">Logout</a></p><p>
                    //     <b>Note:</b> Your implementation should retain data across multiple
                    //     logout/login sessions.  This sample implementation clears all its
                    //     data on logout - which you should not do in your implementation.
                    // </p>';
                    //     } else {
                
                    //         echo "<p><a href='login.php'>Please log in</a></p><p>Attempt to <a href='add.php'>add data</a> without logging in</p>";
                    //     }











                    
                    ?>
                </tr>
            </thead>
        </table>
    </ul>
    
    
        <p><a href="add.php">Add New Entry</a></p> 
        <P><a href="logout.php">Logout</a></P>
    
</div>
</body>