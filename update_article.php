<?php
include("header_art.php");
include("connection.php");      

$result = [];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM article WHERE ID_Article_de_campagne =?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
}
?>
    <?php
        if(isset($_POST["enregistrer"])){
            if(isset($_GET["id_new"])){
                $idn = $_GET["id_new"]; 
            
                $id_campagne = $_POST["ID_campagne"];
                $nom = $_POST["Nom_article"];
                $description = $_POST["Description_Article_de_campagne"];
                $quentite = $_POST["Quantite_requise_Article_de_campagne"];
                $status = $_POST["Status_article"];

            $sql_2 = "UPDATE article SET ID_campagne=?, Nom_article=?, Description_Article_de_campagne=?, Quantite_requise_Article_de_campagne=?, Status_article=?  WHERE ID_Article_de_campagne=?";
            $query_2 = $conn->prepare($sql_2);
            $query_2->execute([$id_campagne, $nom, $description, $quentite, $status,$idn]);
            $result_2 = $query_2->fetch(PDO::FETCH_ASSOC);
            
            if($query_2){
                header("location: article.php?update_msg=Data updated successfully!");
                exit;
            }
            else{
                echo "ERROR";
            }
        }
    }
    ?>

<form action="update_article.php?id_new=<?php echo $id;?>" method="post">
        <div class="form-group">
          <label>ID de la Campagne associée</label>
          <input type="int" name="ID_campagne" class="form-control" value="<?php echo isset($result['ID_campagne']) ? $result['ID_campagne'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>Nom article</label>
          <input type="text" name="Nom_article" class="form-control" value="<?php echo isset($result['Nom_article']) ? $result['Nom_article'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>Description</label>
          <input type="text" name="Description_Article_de_campagne" class="form-control" value="<?php echo isset($result['Description_Article_de_campagne']) ? $result['Description_Article_de_campagne'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>Quantite requise</label>
          <input type="int" name="Quantite_requise_Article_de_campagne" class="form-control" value="<?php echo isset($result['Quantite_requise_Article_de_campagne']) ? $result['Quantite_requise_Article_de_campagne'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>Status</label>
          <input type="text" name="Status_article" class="form-control" value="<?php echo isset($result['Status_article']) ? $result['Status_article'] : ''; ?>">
        </div>
    <input type="submit" class="btn btn-success" name="enregistrer" value="Enregistrer">
</form>

<?php
include("footer.php");
?>
