<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

include("header.php");
include("connection.php");
?>
<div class="box1">
    <h2>Tous les dons</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter un Don</button>
</div>
<script src="confirmdel.js"></script>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <td>ID_Don</td>
            <td>Montant_Don</td>
            <td>Date_du_don</td>
            <?php if ($user_type == 'Organisation') : ?>
            <td>ID_donateur</td>
            <?php endif; ?>
            <td>ID_campagne</td>
            <td>Mode_de_paiement</td>
            <td>Statut_Don</td>
            <?php if ($user_type == 'Organisation') : ?>
                <td>Modifier</td>
                <td>Supprimer</td>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM don";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['ID_Don'] . "</td>";
        echo "<td>" . $row['Montant_Don'] . "</td>";
        echo "<td>" . $row['Date_du_don'] . "</td>";
        if ($user_type == 'Organisation') {
        echo "<td>" . $row['ID_donateur'] . "</td>";
        }
        echo "<td>" . $row['ID_campagne'] . "</td>";
        echo "<td>" . $row['Mode_de_paiement'] . "</td>";
        echo "<td>" . $row['Statut_Don'] . "</td>";
        if ($user_type == 'Organisation') {
            echo "<td><a href='update_don.php?id=" . $row["ID_Don"] . "' class='btn btn-success'>Modifier</a></td>";
            echo "<td><a href='delete_don.php?id=" . $row["ID_Don"] . "' onclick='return confirmDelete();' class='btn btn-danger'>Supprimer</a></td>";
        }
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<?php
if (isset($_GET["message"])) {
    echo "<h6>" . $_GET["message"] . "</h6>";
} elseif (isset($_GET["insert_msg"])) {
    echo "<h6 style='color:green;text-align:center;'>" . $_GET["insert_msg"] . "</h6>";
} elseif (isset($_GET["update_msg"])) {
    echo "<h6 style='color:green;text-align:center;'>" . $_GET["update_msg"] . "</h6>";
} elseif (isset($_GET["delete_msg"])) {
    echo "<h6 style='color:red;text-align:center;'>" . $_GET["delete_msg"] . "</h6>";
}
?>
<!-- Modal -->
<form action="insert_data.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Don-infos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Montant_Don</label>
                        <input type="int" name="Montant_Don" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Date_du_don</label>
                        <input type="date" name="Date_du_don" class="form-control">
                    </div>
                    <?php
                        if ($user_type == 'Organisation') {
                        echo '<div class="form-group">';
                        echo '<label>ID_donateur</label>';
                        echo '<input type="int" name="ID_donateur" class="form-control" required>';
                        echo '</div>';
                        }
                    ?>
                    <div class="form-group">
                        <label>ID_campagne</label>
                        <input type="int" name="ID_campagne" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mode_de_paiement</label>
                        <input type="text" name="Mode_de_paiement" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Statut_Don</label>
                        <input type="text" name="Statut_Don" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <input type="submit" class="btn btn-success" name="add_don" value="Ajouter"></input>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
include("footer.php");
?>
