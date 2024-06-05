<?php
    include('connection.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit_or'])){
            $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
            $adresse = filter_input(INPUT_POST,"adresse",FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_SPECIAL_CHARS);
            $numero_er = filter_input(INPUT_POST,"numero_er",FILTER_SANITIZE_SPECIAL_CHARS);
            if(empty($_POST["username"]) || empty($_POST["adresse"]) || empty($_POST["password"]) || empty($_POST["numero_er"]) || empty($_POST["email"])){
                echo '<p style="color:red;">Missing values.</p>';
            }
            
            else{
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO organisation(Nom_Organisation,Adresse_Organisation,Numero_d_enregistrement_Organisation,password,Email_Organisation) VALUES ('$username','$adresse','$numero_er','$hash','$email')";
                $query = $conn->prepare($sql);
                if($query){
                    if($query->execute()){
                        echo'<p style="color:green;">Registered successfully!</p>';
                    }
                    else{
                        echo "Error executing query: " . implode(" ", $query->errorInfo());;
                    }
                    $query=null;
                }
            }
        }
       
    }
?>