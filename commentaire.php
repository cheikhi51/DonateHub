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
include("header_comm.php");
?>
<?php
include("connection.php");      
?>
        <div class="box1">
          <h2>Tous les commentaires</h2>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter un commentaire</button>
        </div>
        <script src="confirmdel.js"></script>

        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Contenue du commentaire</td>
                    <td>Date et Heure</td>
                    <?php if ($user_type == 'Organisation') : ?>
                    <td>ID_donateur</td>
                    <?php endif; ?>
                    <td>ID_campagne</td>
                    <?php if ($user_type == 'Organisation') : ?>
                    <td>Modifier</td>
                    <td>Supprimer</td>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM commentaire";
                $query = $conn->prepare($sql);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['contenu_du_commentaire'] . "</td>";
                    echo "<td>" . $row['Heure_et_date'] . "</td>";
                    if ($user_type == 'Organisation') {
                    echo "<td>" . $row['ID_Donateur'] . "</td>";
                    }
                    echo "<td>" . $row['ID_Campagne'] . "</td>";
                    if ($user_type == 'Organisation') {
                    echo "<td><a href='update_comm.php?id=" .$row["id"]. "' class='btn btn-success'>Modifier</a></td>";
                    echo "<td><a href='delete_comm.php?id=" .$row["id"]. "' onclick='return confirmDelete();' class='btn btn-danger'>Suprimmer</a></td>";
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
<form action="insert_data_comm.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Commentaire-infos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Contenu du commentaire</label>
          <input type="text" name="contenu_du_commentaire" class="form-control">
        </div>
        <div class="form-group">
          <label>Date et Heure</label>
          <input type="datetime-local" name="Heure_et_date" class="form-control">
        </div>
        <?php
        if ($user_type == 'Organisation') {
          echo '<div class="form-group">';
          echo '<label>ID_donateur</label>';
          echo '<input type="int" name="ID_Donateur" class="form-control" required>';
          echo '</div>';
        }
        ?> 
        <div class="form-group">
          <label>ID_campagne</label>
          <input type="int" name="ID_Campagne" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <input type="submit" class="btn btn-success" name="add_comm" value="Ajouter"></input>
      </div>
    </div>
  </div>
</div>
</form>
<?php
include("footer.php");
?>