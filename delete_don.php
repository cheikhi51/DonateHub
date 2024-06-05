<?php
include("connection.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM don WHERE ID_don=?";
    $query = $conn->prepare($sql);
    $query->execute([$id]); // Bind the $id variable here
}

if($query){
    header("location:don.php?delete_msg=Data Deleted");
    exit();
} else {
    echo "ERROR";
}
?>
