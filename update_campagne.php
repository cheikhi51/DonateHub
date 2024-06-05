<?php
include("header_camp.php");
include("connection.php");      

$result = []; // Initialize $result variable

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM campagne WHERE ID_Campagne =?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
}
?>
    <?php
        if(isset($_POST["enregistrer"])){
            if(isset($_GET["id_new"])){
                $idn = $_GET["id_new"]; 
            
            $titre = $_POST["Titre_Campagne"];
            $description = $_POST["Description_Campagne"];
            $objectif = $_POST["Objectif_Campagne"];
            $date_debut = $_POST["Date_de_debut_Campagne"];
            $date_fin = $_POST["Date_de_fin_Campagne"];
            $status = $_POST["Statut_Campagne"];
            $id_organisation = $_POST["ID_Organisation"];

            $sql_2 = "UPDATE campagne SET Titre_Campagne=?, Description_Campagne=?, Objectif_Campagne=?, Date_de_debut_Campagne=?, Date_de_fin_Campagne=?, Statut_Campagne=?, ID_Organisation=? WHERE ID_Campagne=?";
            $query_2 = $conn->prepare($sql_2);
            $query_2->execute([$titre, $description, $objectif, $date_debut, $date_fin, $status, $id_organisation, $idn]);
            $result_2 = $query_2->fetch(PDO::FETCH_ASSOC);
            
            if($query_2){
                header("location: campagne_de_collecte.php?update_msg=Data updated successfully!");
                exit;
            }
            else{
                echo "ERROR";
            }
        }
    }
    ?>

<form action="update_campagne.php?id_new=<?php echo $id;?>" method="post">
<div class="form-group">
          <label>Titre de la Campagne</label>
          <input type="text" name="Titre_Campagne" class="form-control" value="<?php echo isset($result['Titre_Campagne']) ? $result['Titre_Campagne'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>Description</label>
          <input type="text" name="Description_Campagne" class="form-control" value="<?php echo isset($result['Description_Campagne']) ? $result['Description_Campagne'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>Objectif</label>
          <input type="text" name="Objectif_Campagne" class="form-control" value="<?php echo isset($result['Objectif_Campagne']) ? $result['Objectif_Campagne'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>Date de Debut</label>
          <input type="date" name="Date_de_debut_Campagne" class="form-control" value="<?php echo isset($result['Date_de_debut_Campagne']) ? $result['Date_de_debut_Campagne'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>Date de fin</label>
          <input type="date" name="Date_de_fin_Campagne" class="form-control" value="<?php echo isset($result['Date_de_fin_Campagne']) ? $result['Date_de_fin_Campagne'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>Status</label>
          <input type="text" name="Statut_Campagne" class="form-control" value="<?php echo isset($result['Statut_Campagne']) ? $result['Statut_Campagne'] : ''; ?>">
        </div>
        <div class="form-group">
          <label>ID de l'organisation associée</label>
          <input type="int" name="ID_Organisation" class="form-control" value="<?php echo isset($result['ID_Organisation']) ? $result['ID_Organisation'] : ''; ?>">
        </div>
    <input type="submit" class="btn btn-success" name="enregistrer" value="Enregistrer">
</form>

<?php
include("footer.php");
?>
