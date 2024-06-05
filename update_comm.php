<?php
include("header_comm.php");
include("connection.php");      

$result = [];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM commentaire WHERE id=?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
}
?>
    <?php
        if(isset($_POST["enregistrer"])){
            if(isset($_GET["id_new"])){
                $idn = $_GET["id_new"]; 
            
                $contenu = $_POST["contenu_du_commentaire"];
                $date_heure = $_POST["Heure_et_date"];
                $id_donateur = $_POST["ID_Donateur"];
                $id_compagne = $_POST["ID_Campagne"];

            $sql_2 = "UPDATE commentaire SET contenu_du_commentaire=?, Heure_et_date=?, ID_Donateur=?, ID_Campagne=? WHERE id=?";
            $query_2 = $conn->prepare($sql_2);
            $query_2->execute([$contenu, $date_heure, $id_donateur, $id_compagne, $idn]);
            $result_2 = $query_2->fetch(PDO::FETCH_ASSOC);
            
            if($query_2){
                header("location: commentaire.php?update_msg=Data updated successfully!");
                exit;
            }
            else{
                echo "ERROR";
            }
        }
    }
    ?>

<form action="update_comm.php?id_new=<?php echo $id;?>" method="post">
    <div class="form-group">
        <label>contenu du commentaire</label>
        <input type="text" name="contenu_du_commentaire" class="form-control" value="<?php echo isset($result['contenu_du_commentaire']) ? $result['contenu_du_commentaire'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>Date et Heure</label>
        <input type="datetime-local" name="Heure_et_date" class="form-control" value="<?php echo isset($result['Heure_et_date']) ? $result['Heure_et_date'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>ID_donateur</label>
        <input type="int" name="ID_Donateur" class="form-control" value="<?php echo isset($result['ID_Donateur']) ? $result['ID_Donateur'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>ID_campagne</label>
        <input type="int" name="ID_Campagne" class="form-control" value="<?php echo isset($result['ID_Campagne']) ? $result['ID_Campagne'] : ''; ?>">
    </div>
    <input type="submit" class="btn btn-success" name="enregistrer" value="Enregistrer">
</form>

<?php
include("footer.php");
?>
