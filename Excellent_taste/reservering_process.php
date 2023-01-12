<?php
    require_once 'db_config.php';

    $id = '';
    $tafel = '';
    $datum = '';
    $tijd = '';
    $klant_id = '';
    $aantal = '';
    $status	= '';
    $aantal_kinderen = '';
    $allergien = '';
    $opmerkingen = '';

    //save knop reserveringen
    if (isset($_POST['save'])){
        $tafel = $_POST['tafel'];
        $datum = $_POST['datum'];
        $tijd = $_POST['tijd'];
        $aantal = $_POST['aantal'];
        $aantal_kinderen = $_POST['aantal_k'];
        $allergien= $_POST['allergien'];
        $opmerkingen= $_POST['opmerkingen'];

        pdo($pdo, "INSERT INTO reserveringen (tafel, datum, tijd, aantal, aantal_k, allergien, opmerkingen ) VALUES( '$tafel', '$datum', '$tijd', '$aantal', '$aantal_kinderen', '$allergien', '$opmerkingen'");
        header("location: reservering.php");

    }
    //delete knop reserveringen
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $stmt = $pdo->query("DELETE FROM reserveringen WHERE id=$id");

        header("location: reservering.php");
    }

    //edit data reserveringen

    if (isset($_POST['team'])) {
        $teams = $_POST['team'];
        $id = $_POST['id'];
        $row = pdo($pdo, "UPDATE reserveren SET tafel='$tafel', datum='$datum', tijd='$tijd', aantal ='$aantal', aantal_kinderen='$aantal_kinderen', allergien='$allergien', opmerkingen='$opmerkingen' WHERE id=$id");
        header("location: reservering.php");
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = pdo($pdo, "SELECT * FROM reserveringen WHERE id = $id")->fetch();
    }
?>