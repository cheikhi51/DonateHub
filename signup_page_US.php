<?php
    include("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit_us'])){
            $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_SPECIAL_CHARS);
            if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])){
                echo '<p style="color:red;">Missing values.</p>';
            }
            
            else{
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO donateur(Nom_Donateur,Adresse_email_Donateur,Mot_de_passe_Donateur) VALUES ('$username','$email','$hash')";
                $query = $conn->prepare($sql);
                if($query){
                    if($query->execute()){
                        echo'<p style="color:green;">Registred successfully!</p>';
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