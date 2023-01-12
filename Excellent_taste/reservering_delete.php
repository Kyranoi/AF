<?php
    require 'db_config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // delete record
        pdo($pdo, "DELETE FROM reserveringen WHERE id = :id", ['id' => $id]);
        header('location: reservering.php');
    }
?>