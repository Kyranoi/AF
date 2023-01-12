<?php
    require 'db_config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Delete record
        pdo($pdo, "DELETE FROM bestellingen WHERE id = :id", ['id' => $id]);
        header('location: bestelling.php');
    }
?>