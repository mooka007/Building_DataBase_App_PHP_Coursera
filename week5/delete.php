<?php 

    session_start();

    if(!isset($_SESSION['name'])){
        die("ACCESS Denied");
    }
    require_once "pdo.php";

    if(isset($_POST['delete']) && isset($_POST['auto_id'])){
        
        $stm = $pdo->prepare("DELETE FROM autos WHERE auto_id =:zip");
        $stm->execute(array(':zip' => $_POST['auto_id']));
        $_SESSION['success'] = "Record deleted";
        header("Location: view.php");
        return;
    }

    // Guardian: Make sure that user_id is present
    if ( ! isset($_GET['auto_id']) ) {
        $_SESSION['error'] = "Missing user_id";
        header('Location: view.php');
        unset($_SESSION['error']);
    }

    $stmt = $pdo->prepare("SELECT make FROM autos where auto_id = :xyz");
    $stmt->execute(array(":xyz" => $_GET['auto_id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for user_id';
        header('Location: view.php');
        return;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Auto Database</title>

</head>
<body>
<div class="container">
    <p>Confirm: Deleting <?php echo $row['make'] ?></p>
    <form method="post">
        <input type="hidden" name="auto_id" value="<?php echo $_GET['auto_id'] ?>" /> 
        <input type="submit" value="Delete"  name="delete" />
        <a href="view.php">Cancel</a>
    </form>
</div>
</body>