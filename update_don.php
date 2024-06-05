<?php
include("header.php");
include("connection.php");      

$result = [];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM don WHERE ID_don=?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
}
?>
    <?php
        if(isset($_POST["enregistrer"])){
            if(isset($_GET["id_new"])){
                $idn = $_GET["id_new"]; 
            
            $montent = $_POST["Montant_Don"];
            $date = $_POST["Date_du_don"];
            $id_donateur = $_POST["ID_donateur"];
            $id_compagne = $_POST["ID_campagne"];
            $mode_de_paiement = $_POST["Mode_de_paiement"];
            $status = $_POST["Statut_Don"];
            $id_compagne_de_collecte = $_POST["ID_Campagne_de_collecte"];

            $sql_2 = "UPDATE don SET Montant_Don=?, Date_du_don=?, ID_donateur=?, ID_campagne=?, Mode_de_paiement=?, Statut_Don=? WHERE ID_don=?";
            $query_2 = $conn->prepare($sql_2);
            $query_2->execute([$montent, $date, $id_donateur, $id_compagne, $mode_de_paiement, $status, $idn]);
            $result_2 = $query_2->fetch(PDO::FETCH_ASSOC);
            
            if($query_2){
                header("location: don.php?update_msg=Data updated successfully!");
                exit;
            }
            else{
                echo "ERROR";
            }
        }
    }
    ?>

<form action="update_don.php?id_new=<?php echo $id;?>" method="post">
    <div class="form-group">
        <label>Montant_Don</label>
        <input type="int" name="Montant_Don" class="form-control" value="<?php echo isset($result['Montant_Don']) ? $result['Montant_Don'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>Date_du_don</label>
        <input type="date" name="Date_du_don" class="form-control" value="<?php echo isset($result['Date_du_don']) ? $result['Date_du_don'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>ID_donateur</label>
        <input type="int" name="ID_donateur" class="form-control" value="<?php echo isset($result['ID_donateur']) ? $result['ID_donateur'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>ID_campagne</label>
        <input type="int" name="ID_campagne" class="form-control" value="<?php echo isset($result['ID_campagne']) ? $result['ID_campagne'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>Mode_de_paiement</label>
        <input type="text" name="Mode_de_paiement" class="form-control" value="<?php echo isset($result['Mode_de_paiement']) ? $result['Mode_de_paiement'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>Statut_Don</label>
        <input type="text" name="Statut_Don" class="form-control" value="<?php echo isset($result['Statut_Don']) ? $result['Statut_Don'] : ''; ?>">
    </div>
    <input type="submit" class="btn btn-success" name="enregistrer" value="Enregistrer">
</form>

<?php
include("footer.php");
?>
