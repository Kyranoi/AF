<?php
    require 'db_config.php';
    //Update klant
    if (isset($_POST['id'])) {
        $item = $_POST['item'];
        $code = $_POST['code'];
        $prijs = $_POST['prijs'];
        $id = $_POST['id'];

        //COUNT(*) telt alle rows in reserveringen maar ik laat hem specefiek tellen waar tafel, datum en tijd user input hebben. Als deze alle 3 gelijk zijn en er meer dan 0 gelijke zijn geef dan een error.
        $error = pdo($pdo, "SELECT COUNT(*) as count FROM menuitems WHERE code = ?", [$code]);
        $result = $error->fetch();

        if($result['count'] > 0) {
            echo "Code bestaat al.";
        } else {
        pdo($pdo, "UPDATE menuitems SET item = :item, code = :code, gerechtsoort_id = :gerechtsoort_id, prijs = :prijs WHERE id = $id", ['item' => $item, 'code' => $code, 'prijs' => $prijs]);
        header('location: dranken.php');
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = pdo($pdo, "SELECT * FROM menuitems WHERE id = $id")->fetch();
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
        <input type="text" name="item" value="<?php echo $result['item'];?>">
        <label>Code:</label>
        <input type="text" name="code" minlength="4" maxlength="4" value="<?php echo $result['code'];?>">
        <label>Prijs:</label>
        <input type="text" name="prijs" value="<?php echo $result['prijs'];?>">
        <input type="hidden" name="id" value="<?php echo $result['id'];?>">
        <input type="submit" name="submit" value="submit">
   </form> 
</body>
</html>