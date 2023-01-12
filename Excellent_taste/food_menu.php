<?php require_once 'header.php'; ?>
<?php require_once 'menu.php'; ?>

<?php
    require 'db_config.php';

    $menus = pdo($pdo, "SELECT * FROM gerechtcategorien")->fetchAll();
?>

<a href="food_menu_add.php">Menu's toevoegen</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Naam</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $menu): ?>
        <tr>
            <td><?php echo $menu['id']; ?></td>
                <td><?php echo $menu['code']; ?></td>
                <td><?php echo $menu['categorien']; ?>
                    <a href="food_menu_edit.php?id=<?php echo $menu['id']; ?>">Edit</a>
                    <a href="food_menu_delete.php?id=<?php echo $menu['id']; ?>">Delete</a>
                </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

