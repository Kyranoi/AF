<?php require_once 'header.php'; ?>
<?php require_once 'menu.php'; ?>

<?php
    require 'db_config.php';

    $bestelling = pdo($pdo, "SELECT menuitems.item, reserveringen.tafel, bestellingen.aantal, bestellingen.gereserveerd FROM bestellingen
    INNER JOIN menuitems ON bestellingen.menu_item_id = menuitems.id
    INNER JOIN reserveringen ON reserveringen.id = bestellingen.reservering_id")->fetchAll();
?>

<a href="bestelling_add.php">Bestellen</a>

<table>
    <thead>
        <tr>
            <th>Tafel</th>
            <th>Artikel</th>
            <th>Aantal</th>
            <th>gereserveerd</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bestelling as $bestel): ?>
        <tr>
                <td><?php echo $bestel['tafel']; ?></td>
                <td><?php echo $bestel['item']; ?></td>
                <td><?php echo $bestel['aantal']; ?></td>
                <td><?php echo $bestel['gereserveerd']; ?></td>
                <td>
                    <a href="bestelling_delete.php?id=<?php echo $bestel['tafel']; ?>">Delete</a>

                </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>