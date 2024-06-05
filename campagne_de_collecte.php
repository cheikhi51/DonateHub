<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); 
    exit;
}


$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];
?>
<?php
include("connection.php");
include("header_camp.php");
?>

        <div class="box1">
          <h2>Toutes les Campagnes</h2>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter une Compagne</button>
        </div>
        <script src="confirmdel.js"></script>
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>ID_Campagne</td>
                    <td>Titre_Campagne</td>
                    <td>Description_Campagne</td>
                    <td>Objectif_Campagne</td>
                    <td>Date_de_debut_Campagne</td>
                    <td>Date_de_fin_Campagne</td>
                    <td>Statut_Campagne</td>
                    <td>ID_Organisation</td>
                    <?php if ($user_type == 'Organisation') : ?>
                    <td>Modifier</td>
                    <td>Supprimer</td>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM campagne";
                $query = $conn->prepare($sql);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['ID_Campagne'] . "</td>";
                    echo "<td>" . $row['Titre_Campagne'] . "</td>";
                    echo "<td>" . $row['Description_Campagne'] . "</td>";
                    echo "<td>" . $row['Objectif_Campagne'] . "</td>";
                    echo "<td>" . $row['Date_de_debut_Campagne'] . "</td>";
                    echo "<td>" . $row['Date_de_fin_Campagne'] . "</td>";
                    echo "<td>" . $row['Statut_Campagne'] . "</td>";
                    echo "<td>" . $row['ID_Organisation'] . "</td>";
                    if ($user_type == 'Organisation') {
                    echo "<td><a href='update_campagne.php?id=" .$row["ID_Campagne"]. "' class='btn btn-success'>Modifier</a></td>";
                    echo "<td><a href='delete_campagne.php?id=" .$row["ID_Campagne"]. "' onclick='return confirmDelete();' class='btn btn-danger'>Suprimmer</a></td>";
                    }
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
        <?php
          if(isset($_GET["message"])){
            echo "<h6>".$_GET["message"]."</h6>";
          }
          elseif(isset($_GET["insert_msg"])){
            echo "<h6 style='color:green;text-align:center;'>".$_GET["insert_msg"]."</h6>";
          }
          elseif(isset($_GET["update_msg"])){
            echo "<h6 style='color:green;text-align:center;'>".$_GET["update_msg"]."</h6>";

          }
          elseif(isset($_GET["delete_msg"])){
            echo "<h6 style='color:red;text-align:center;'>".$_GET["delete_msg"]."</h6>";
            
          }
        ?>
<!-- Modal -->
<form action="insert_data_campagne.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Campagne-infos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Titre de la Campagne</label>
          <input type="text" name="Titre_Campagne" class="form-control">
        </div>
        <div class="form-group">
          <label>Description</label>
          <input type="text" name="Description_Campagne" class="form-control">
        </div>
        <div class="form-group">
          <label>Objectif</label>
          <input type="text" name="Objectif_Campagne" class="form-control">
        </div>
        <div class="form-group">
          <label>Date de Debut</label>
          <input type="date" name="Date_de_debut_Campagne" class="form-control">
        </div>
        <div class="form-group">
          <label>Date de fin</label>
          <input type="date" name="Date_de_fin_Campagne" class="form-control">
        </div>
        <div class="form-group">
          <label>Status</label>
          <input type="text" name="Statut_Campagne" class="form-control">
        </div>
        <div class="form-group">
          <label>ID de l'organisation associée</label>
          <input type="int" name="ID_Organisation" class="form-control">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <input type="submit" class="btn btn-success" name="add_campagne" value="Ajouter"></input>
      </div>
    </div>
  </div>
</div>
</form>
<?php
include("footer.php");
?>
