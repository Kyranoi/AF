<?php require_once 'header.php'; ?>
<?php require_once 'menu.php'; ?>

<?php
    require 'db_config.php';
    $gerechten = pdo($pdo, "SELECT menuitems.*, gerechtsoorten.naam FROM menuitems
    INNER JOIN gerechtsoorten ON menuitems.gerechtsoort_id = gerechtsoorten.id WHERE gerechtsoorten.gerechtcategorie_id != 4")->fetchAll();
?>

<a href="gerecht_add.php">Gerecht toevoegen</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Naam</th>
            <th>Perechtsoort</th>
            <th>Prijs</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($gerechten as $gerecht): ?>
        <tr>
            <td><?php echo $gerecht['id']; ?></td>
                <td><?php echo $gerecht['code']; ?></td>
                <td><?php echo $gerecht['item']; ?></td>
                <td><?php echo $gerecht['naam']; ?>
                <td><?php echo $gerecht['prijs']; ?>
                    <a href="gerecht_edit.php?id=<?php echo $gerecht['id']; ?>">Edit</a>
                    <a href="gerecht_delete.php?id=<?php echo $gerecht['id']; ?>">Delete</a>
                </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

