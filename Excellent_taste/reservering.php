<?php require_once 'header.php'; ?>
<?php require_once 'menu.php'; ?>

<?php
    require 'db_config.php';
    //Hiermee worden alle kolommen uit de reserveringentabel geselecteerd ook de naam kolom uit de klantentabel. En worden de rijen samengevoegd waar de klant_id in de reserveringentabel overeenkomt met de id in de klanten tabel.
    $reserveringen = pdo($pdo, "SELECT reserveringen.*, klanten.naam FROM reserveringen
    INNER JOIN klanten ON reserveringen.klant_id = klanten.id")->fetchAll();

    $vandaag = pdo($pdo, "SELECT reserveringen.datum, reserveringen.tijd, reserveringen.tafel, reserveringen.aantal, klanten.naam, klanten.telefoon FROM reserveringen
    INNER JOIN klanten ON reserveringen.klant_id = klanten.id
    WHERE datum = DATE(NOW())")->fetchAll();
?>

<a href="reservering_add.php">reserveringen toevoegen</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tafel Nummer</th>
            <th>Tijd</th>
            <th>Naam</th>
            <th>Aantal</th>
            <th>Status</th>
            <th>Datum toegevoegd</th>
            <th>Kinderen</th>
            <th>Allergieen</th>
            <th>Opmerkingen</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reserveringen as $reservering): ?>
        <tr>
            <td><?php echo $reservering['id']; ?></td>
            <td><?php echo $reservering['tafel']; ?></td>
            <td><?php echo $reservering['tijd']; ?></td>
            <td><?php echo $reservering['naam']; ?></td>
            <td><?php echo $reservering['aantal']; ?></td>
            <td><?php echo $reservering['status']; ?></td>
            <td><?php echo $reservering['datum_toegevoegd']; ?></td>
            <td><?php echo $reservering['aantal_k']; ?></td>
            <td><?php echo $reservering['allergieen']; ?></td>
            <td><?php echo $reservering['opmerkingen']; ?></td>
            <td>
                <a href="reservering_edit.php?id=<?php echo $reservering['id']; ?>">Edit</a>
                <a href="reservering_delete.php?id=<?php echo $reservering['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>Reserveringen van vandaag</th>
        </tr>
        <tr>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Tafel </th>
            <th>Naam</th>
            <th>Telefoonnummer</th>
            <th>Aantal personen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vandaag as $today): ?>
        <tr>
            <td><?php echo $today['datum']; ?></td>
            <td><?php echo $today['tijd']; ?></td>
            <td><?php echo $today['tafel']; ?></td>
            <td><?php echo $today['naam']; ?></td>
            <td><?php echo $today['telefoon']; ?></td>
            <td><?php echo $today['aantal']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
