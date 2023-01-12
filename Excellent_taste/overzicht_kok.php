<?php require_once 'header.php'; ?>
<?php require_once 'menu.php'; ?>

<?php
    require 'db_config.php';

    $koken = pdo($pdo, "SELECT menuitems.item, reserveringen.tafel, bestellingen.aantal, bestellingen.gereserveerd FROM bestellingen
    INNER JOIN menuitems ON bestellingen.menu_item_id = menuitems.id
    INNER JOIN reserveringen ON reserveringen.id = bestellingen.reservering_id")->fetchAll();
?>

<table>
    <thead>
        <tr>
            <th>Artikel</th>
            <th>Aantal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($koken as $kok): ?>
        <tr>
                <td><?php echo $kok['item']; ?></td>
                <td><?php echo $kok['aantal']; ?></td>
                <td>
                    <a href="overzicht_ober.php?id=<?php echo $kok['item']; ?>">Ready</a> 
                </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>