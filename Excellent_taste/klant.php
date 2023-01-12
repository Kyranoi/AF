<?php require_once 'header.php'; ?>
<?php require_once 'menu.php'; ?>

<?php
    require 'db_config.php';

    $klanten = pdo($pdo, "SELECT * FROM klanten")->fetchAll();
?>

<a href="klant_add.php">Klant toevoegen</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Telefoon</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($klanten as $klant): ?>
        <tr>
            <td><?php echo $klant['id']; ?></td>
                <td><?php echo $klant['naam']; ?></td>
                <td><?php echo $klant['telefoon']; ?></td>
                <td><?php echo $klant['email']; ?></td>
                <td>
                    <a href="klant_edit.php?id=<?php echo $klant['id']; ?>">Edit</a>
                    <a href="klant_delete.php?id=<?php echo $klant['id']; ?>">Delete</a>
                </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>