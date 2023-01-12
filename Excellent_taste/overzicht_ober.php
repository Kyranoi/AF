<?php require_once 'header.php'; ?>
<?php require_once 'menu.php'; ?>

<?php
    require 'db_config.php';

    $bestelling = pdo($pdo, "SELECT menuitems.item, reserveringen.tafel, reserveringen.tijd, bestellingen.aantal, bestellingen.gereserveerd FROM bestellingen
    INNER JOIN menuitems ON bestellingen.menu_item_id = menuitems.id
    INNER JOIN reserveringen ON reserveringen.id = bestellingen.reservering_id  ORDER BY `reserveringen`.`tafel` AND `reserveringen`.`tijd` ASC")->fetchAll();
?>

<table>
    <thead>
        <tr>
            <th>Tafel</th>
            <th>Item</th>
            <th>Aantal</th>
            <th>Tijd</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bestelling as $bestel): ?>
        <tr>
                <td><?php echo $bestel['tafel']; ?></td>
                <td><?php echo $bestel['item']; ?></td>
                <td><?php echo $bestel['aantal']; ?></td>
                <td><?php echo $bestel['tijd']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>