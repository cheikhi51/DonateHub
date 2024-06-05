<?php
include("connection.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM article WHERE ID_Article_de_campagne =?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
}

if($query){
    header("location:article.php?delete_msg=Data Deleted");
    exit();
} else {
    echo "ERROR";
}
?>
