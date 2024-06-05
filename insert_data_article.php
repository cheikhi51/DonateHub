<?php
include("connection.php");
    if(isset($_POST["add_article"])){
        $id_campagne = $_POST["ID_campagne"];
        $nom = $_POST["Nom_article"];
        $description = $_POST["Description_Article_de_campagne"];
        $quentite = $_POST["Quantite_requise_Article_de_campagne"];
        $status = $_POST["Status_article"];
        if(empty($id_campagne)||empty($description)||empty($nom)||empty($quentite)||empty($status)){
            header("location: article.php?message=Missing values!");
            exit;
        }
        else{

            $sql = "INSERT INTO article (ID_campagne, Nom_article, Description_Article_de_campagne, Quantite_requise_Article_de_campagne, Status_article) VALUES (?, ?, ?, ?, ?)";
            $query = $conn->prepare($sql);
            $query->bindParam(1, $id_campagne);
            $query->bindParam(2, $nom);
            $query->bindParam(3, $description);
            $query->bindParam(4, $quentite);
            $query->bindParam(5, $status);
            $resultat = $query->execute([$id_campagne, $nom, $description, $quentite, $status]);

            if($resultat){
                header("location: article.php?insert_msg=Data inserted successfully!");
                exit;
            }
        }
    }

?>