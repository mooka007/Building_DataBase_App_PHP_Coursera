<?php 
    session_start();

    require_once("pdo.php");
    if(isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])){
        if(strlen($_POST['make']) < 1 && strlen($_POST['model'])){
            $_SESSION['error'] = "All fields are required";
            header("Location: add.php");
            return;
        }elseif(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
            $_SESSION['error'] = "Year must be an integer";
            header("Location: add.php");
            return;
        }

        $sql = "UPDATE autos SET make = :make,
        model = :model, year = :year,mileage=:mileage
        WHERE auto_id = :auto_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
                ':make' => $_POST['make'],
                ':model' => $_POST['model'],
                ':year' => $_POST['year'],
                ':mileage' => $_POST['mileage'],
                ':auto_id' => $_GET['auto_id'])
        );
        $_SESSION['success'] = 'Record updated';
        header('Location: view.php');
        return;

    }

    $stmt = $pdo->prepare("SELECT * FROM autos where auto_id = :xyz");
    $stmt->execute(array(":xyz" => $_GET['auto_id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row === false) {
        $_SESSION['error'] = 'Bad value for user_id';
        header('Location: index.php');
        return;
    }

    

?>
<!DOCTYPE html>
<html>
<head>

    <title>Mohammed yassine marzouki</title>
</head>
<body>
<div class="container">
    <h1>Editing  Auto </h1>
    <!-- Flash patterna de la puta  -->
    <?php
    if (isset($_SESSION['error'])) {
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <p>Make:
            <input value="<?php echo $row['make'] ?>" type="text" name="make" size="60"/></p>
        <p>Model:
            <input value="<?php echo $row['model'] ?>" type="text" name="model" size="60"/></p>
        <p>Year:
            <input value="<?php echo $row['year'] ?>" type="text" name="year"/></p>
        <p>Mileage:
            <input value="<?php echo $row['mileage'] ?>" type="text" name="mileage"/></p>
        <input type="submit" value="Edit">
        <input type="submit" name="cancel" value="Cancel">
    </form>


</div>
</body>
</html>