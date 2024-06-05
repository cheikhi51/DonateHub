<?php
include("connection.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM campagne WHERE ID_Campagne=?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
}

if($query){
    header("location:campagne_de_collecte.php?delete_msg=Data Deleted");
    exit();
} else {
    echo "ERROR";
}
?>
