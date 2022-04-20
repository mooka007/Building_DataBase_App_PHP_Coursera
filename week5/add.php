<?php 
    session_start();
    
    if(!isset($_SESSION['name'])){
        die("Not Logged In");
    }

    require_once "pdo.php";
    if(isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])){
        if(strlen($_POST['make']) < 1){
            $_SESSION['error'] = "Make is Required";
            header("Location: add.php");
            return;
        }elseif (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
            $_SESSION['error']= "Year & Mileage must be Numeric";
            header("Location: add.php");
            return;
        }else{
            $stmt = $pdo->prepare('INSERT INTO autos (make, model, year, mileage) VALUES ( :make, :model, :year, :mileage)');
            $rows = $stmt->execute(array(
                ':make' => $_POST['make'],
                ':model' => $_POST['model'],
                ':year' => $_POST['year'],
                ':mileage' => $_POST['mileage']
            ));
            $_SESSION['success'] = "Record Inserted";
            header("Location: view.php");
            return;
        }
    }


?>


<!DOCTYPE html>
<html>
<head>

    <title>Mohammed yassine marzouki</title>
</head>
<body>
<div class="container">
    <h1>Tracking Autos for <?php echo $_SESSION['name'];  ?></h1>
    <?php
    if (isset($_SESSION['error'])) {
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <p>Make:
            <input type="text" name="make" size="60"/></p>
        <p>Model:
            <input type="text" name="model" size="60"/></p>
        <p>Year:
            <input type="text" name="year"/></p>
        <p>Mileage:
            <input type="text" name="mileage"/></p>
        <input type="submit" value="Add">
        <input type="submit" name="logout" value="Logout">
    </form>


</div>
</body>
</html>