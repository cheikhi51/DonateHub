<?php
include("connection.php");
    if(isset($_POST["add_campagne"])){
        $titre = $_POST["Titre_Campagne"];
        $description = $_POST["Description_Campagne"];
        $objectif = $_POST["Objectif_Campagne"];
        $date_debut = $_POST["Date_de_debut_Campagne"];
        $date_fin = $_POST["Date_de_fin_Campagne"];
        $status = $_POST["Statut_Campagne"];
        $id_organisation = $_POST["ID_Organisation"];
        if(empty($titre)||empty($description)||empty($objectif)||empty($date_debut)||empty($date_fin)||empty($status)||empty($id_organisation)){
            header("location: campagne_de_collecte.php?message=Missing values!");
            exit;
        }
        else{

            $sql = "INSERT INTO campagne (Titre_Campagne, Description_Campagne, Objectif_Campagne, Date_de_debut_Campagne, Date_de_fin_Campagne, Statut_Campagne, ID_Organisation) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $query = $conn->prepare($sql);
            $query->bindParam(1, $titre);
            $query->bindParam(2, $description);
            $query->bindParam(3, $objectif);
            $query->bindParam(4, $date_debut);
            $query->bindParam(5, $date_fin);
            $query->bindParam(6, $status);
            $query->bindParam(7, $id_organisation);
            $resultat = $query->execute([$titre, $description, $objectif, $date_debut, $date_fin, $status, $id_organisation]);

            if($resultat){
                header("location: campagne_de_collecte.php?insert_msg=Data inserted successfully!");
                exit;
            }
        }
    }

?>