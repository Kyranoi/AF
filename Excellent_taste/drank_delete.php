<?php
    require 'db_config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Delete record
        pdo($pdo, "DELETE FROM menuitems WHERE id = :id", ['id' => $id] );
        header('location: dranken.php');
    }
?>