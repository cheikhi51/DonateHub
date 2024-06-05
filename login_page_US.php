<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM donateur WHERE Adresse_email_Donateur = :email";
    $query = $conn->prepare($sql);
    $query->bindParam(':email', $email);

    if ($query->execute()) {
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Mot_de_passe_Donateur'])) {
            $_SESSION['user_id'] = $user['ID_Donateur'];
            $_SESSION['user_type'] = 'Utilisateur';
            header("Location: don.php");
            exit();
        } else {
            echo '<p style="color:red;">Invalid email or password</p>';
        }
    } else {
        echo '<p style="color:red;">Error executing query: ' . implode(" ", $query->errorInfo()) . '</p>';
    }
}
?>
