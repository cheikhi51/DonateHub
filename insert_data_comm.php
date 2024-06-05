<?php
session_start();
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];
include("connection.php");
    if(isset($_POST["add_comm"])){
        $contenu = $_POST["contenu_du_commentaire"];
        $date_heure = $_POST["Heure_et_date"];
        $id_donateur = $_POST["ID_Donateur"];
        $id_compagne = $_POST["ID_Campagne"];
        if(empty($contenu)||empty($date_heure)||empty($id_compagne)){
            header("location: commentaire.php?message=Missing values!");
            exit;
        }
        else{
            $sqlO = "INSERT INTO commentaire (contenu_du_commentaire,Heure_et_date,ID_Donateur,ID_Campagne) VALUES ('$contenu','$date_heure','$id_donateur','$id_compagne')";
            $sqlU = "INSERT INTO commentaire (contenu_du_commentaire,Heure_et_date,ID_Donateur,ID_Campagne) VALUES ('$contenu','$date_heure','$user_id','$id_compagne')";
            if ($user_type == 'Organisation'){
                $query = $conn->prepare($sqlO);
            }
            elseif($user_type == 'Utilisateur'){
                $query = $conn->prepare($sqlU);
            }
            $resultat = $query->execute();
            if($resultat){
                header("location: commentaire.php?insert_msg=Data inserted successfully!");
                exit;
            }
        }
    }

?>