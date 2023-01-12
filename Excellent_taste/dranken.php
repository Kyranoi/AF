<?php require_once 'header.php'; ?>
<?php require_once 'menu.php'; ?>

<?php
    require 'db_config.php';
    $dranken = pdo($pdo, "SELECT menuitems.*, gerechtsoorten.naam FROM menuitems
    INNER JOIN gerechtsoorten ON menuitems.gerechtsoort_id = gerechtsoorten.id WHERE gerechtsoorten.gerechtcategorie_id = 4")->fetchAll();
?>

<a href="drank_add.php">Dranken toevoegen</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Naam</th>
            <th>Drankcategorie</th>
            <th>Prijs</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dranken as $drank): ?>
        <tr>
            <td><?php echo $drank['id']; ?></td>
                <td><?php echo $drank['code']; ?></td>
                <td><?php echo $drank['item']; ?></td>
                <td><?php echo $drank['naam']; ?>
                <td><?php echo $drank['prijs']; ?>
                    <a href="drank_edit.php?id=<?php echo $drank['id']; ?>">Edit</a>
                    <a href="drank_delete.php?id=<?php echo $drank['id']; ?>">Delete</a>
                </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

