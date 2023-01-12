<?php
    require 'db_config.php';
    //Update klant
    if (isset($_POST['naam'])) {
        $naam = $_POST['naam'];
        $telefoon = $_POST['telefoon'];
        $email = $_POST['email'];
        $id = $_POST['id'];

        pdo($pdo, "UPDATE klanten SET naam = :naam, telefoon = :telefoon, email = :email WHERE id = $id", ['naam' => $naam, 'telefoon' => $telefoon, 'email' => $email]);
        header('location: klant.php');
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = pdo($pdo, "SELECT * FROM klanten WHERE id = $id")->fetch();
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
        <label>Naam:</label>
        <input type="text" name="naam" value="<?php echo $result['naam'];?>">
        <label>Telefoonnummer:</label>
        <input type="text" name="telefoon" value="<?php echo $result['telefoon'];?>">
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $result['email'];?>">
        <input type="hidden" name="id" value="<?php echo $result['id'];?>">
        <input type="submit" name="submit" value="submit">
   </form> 
</body>
</html>