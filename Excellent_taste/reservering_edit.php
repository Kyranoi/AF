<?php
    require 'db_config.php';
    //Post reservering
    if (isset($_POST['tafel'])) {
        $tafel = $_POST['tafel'];
        $datum = $_POST['datum'];
        $tijd = $_POST['tijd'];
        $aantal = $_POST['aantal'];
        $status = $_POST['status'];
        $aantal_k = $_POST['aantal_k'];
        $allergieen = $_POST['allergieen'];
        $opmerkingen = $_POST['opmerkingen'];
        $id = $_POST['id'];

        //COUNT(*) telt alle rows in reserveringen maar ik laat hem specefiek tellen waar tafel, datum en tijd user input hebben. Als deze alle 3 gelijk zijn en er meer dan 0 gelijke zijn geef dan een error.
        $error = pdo($pdo, "SELECT COUNT(*) as count FROM reserveringen WHERE tafel = ? AND datum = ? AND tijd = ?", [$tafel, $datum, $tijd]);
        $result = $error->fetch();

        if($result['count'] > 0) {
            echo "Tafel is al gereserveerd.";
        } else {
            pdo($pdo, "UPDATE reserveringen SET tafel = :tafel, datum = :datum, tijd = :tijd, aantal = :aantal, status = :status, 
            aantal_k = :aantal_k, allergieen = :allergieen, opmerkingen = :opmerkingen WHERE id = $id", 
            ['tafel' => $tafel, 'datum' => $datum, 'tijd' => $tijd, 'aantal' => $aantal, 'status' => $status, 'aantal_k' => $aantal_k, 'allergieen' => $allergieen, 'opmerkingen' => $opmerkingen]);
            header('location: reservering.php');
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = pdo($pdo, "SELECT * FROM reserveringen WHERE id = $id")->fetch();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant aanpassen</title>
</head>
    <body>
    <form action="" method="POST">
            <label>Tafel:</label>
            <input type="number" name="tafel" min="1" max="20" value="<?php echo $result['tafel'];?>">
            <label>Datum:</label>
            <input type="date" min="2023-01-01" max="2023-12-31"  name="datum" value="<?php echo $result['telefoon'];?>">
            <label>Tijd:</label>
            <input type="time" min="17:00" max="22:00"  name="tijd" value="<?php echo $result['tijd'];?>">
            <label>Aantal:</label>
            <input type="number" name="aantal" min="1" value="<?php echo $result['aantal'];?>">
            <label>Status:</label>
            <input type="number" name="status" min="1" value="<?php echo $result['status'];?>">
            <label>Kinderen:</label>
            <input type="number" name="aantal_k" min="0" value="<?php echo $result['aantal_k'];?>">
            <label>Allergieen:</label>
            <input type="text" name="allergieen" value="<?php echo $result['allergieen'];?>">
            <label>Opmerkingen:</label>
            <input type="text" name="opmerkingen" value="<?php echo $result['opmerkingen'];?>">
            <input type="hidden" name="id" value="<?php echo $result['id'];?>">
            <input type="submit" name="submit" value="submit">
    </form> 
</body>
</html>