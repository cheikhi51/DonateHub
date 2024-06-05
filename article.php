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
include("header_art.php");
?>

        <div class="box1">
          <h2>Tous les Article</h2>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter un article</button>
        </div>
        <script src="confirmdel.js"></script>
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>ID_Article_de_campagne</td>
                    <td>ID_campagne</td>
                    <td>Nom_article</td>
                    <td>Description_Article_de_campagne</td>
                    <td>Quantite_requise_Article_de_campagne</td>
                    <td>Status_article</td>
                    <?php if ($user_type == 'Organisation') : ?>
                    <td>Modifier</td>
                    <td>Supprimer</td>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM article";
                $query = $conn->prepare($sql);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['ID_Article_de_campagne'] . "</td>";
                    echo "<td>" . $row['ID_campagne'] . "</td>";
                    echo "<td>" . $row['Nom_article'] . "</td>";
                    echo "<td>" . $row['Description_Article_de_campagne'] . "</td>";
                    echo "<td>" . $row['Quantite_requise_Article_de_campagne'] . "</td>";
                    echo "<td>" . $row['Status_article'] . "</td>";
                    if ($user_type == 'Organisation') {
                    echo "<td><a href='update_article.php?id=" .$row["ID_Article_de_campagne"]. "' class='btn btn-success'>Modifier</a></td>";
                    echo "<td><a href='delete_article.php?id=" .$row["ID_Article_de_campagne"]. "' onclick='return confirmDelete();' class='btn btn-danger'>Suprimmer</a></td>";
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
<form action="insert_data_article.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Article-infos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>ID de la Campagne associée</label>
          <input type="int" name="ID_campagne" class="form-control">
        </div>
        <div class="form-group">
          <label>Nom article</label>
          <input type="text" name="Nom_article" class="form-control">
        </div>
        <div class="form-group">
          <label>Description</label>
          <input type="text" name="Description_Article_de_campagne" class="form-control">
        </div>
        <div class="form-group">
          <label>Quantite requise</label>
          <input type="int" name="Quantite_requise_Article_de_campagne" class="form-control">
        </div>
        <div class="form-group">
          <label>Status</label>
          <input type="text" name="Status_article" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <input type="submit" class="btn btn-success" name="add_article" value="Ajouter"></input>
      </div>
    </div>
  </div>
</div>
</form>

<?php
include("footer.php");
?>
