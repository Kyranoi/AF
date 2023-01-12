<?php require_once 'header.php'; ?>
<?php require_once 'menu.php'; ?>

<?php
    require 'db_config.php';

    $menus = pdo($pdo, "SELECT menuitems.item, gerechtsoorten.naam, gerechtcategorien.categorien FROM menuitems
    INNER JOIN gerechtsoorten ON menuitems.gerechtsoort_id = gerechtsoorten.id
    INNER JOIN gerechtcategorien ON gerechtcategorien.id = gerechtsoorten.gerechtcategorie_id WHERE gerechtsoorten.gerechtcategorie_id != 4")->fetchAll();
    
?>

<table>
    <thead>
        <tr>
            <th>Naam</th>
            <th>soort</th>
            <th>categorie</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $menu): ?>
        <tr>
                <td><?php echo $menu['item']; ?></td>
                <td><?php echo $menu['naam']; ?>
                <td><?php echo $menu['categorien']; ?>
                </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

