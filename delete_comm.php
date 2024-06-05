<?php
include("connection.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM commentaire WHERE id=?";
    $query = $conn->prepare($sql);
    $query->execute([$id]); // Bind the $id variable here
}

if($query){
    header("location:commentaire.php?delete_msg=Data Deleted");
    exit();
} else {
    echo "ERROR";
}
?>
