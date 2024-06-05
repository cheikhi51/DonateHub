<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $numero_er = $_POST['numero_er'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM organisation WHERE Numero_d_enregistrement_Organisation = :numero_er";
    $query = $conn->prepare($sql);
    $query->bindParam(':numero_er', $numero_er);

    if ($query->execute()) {
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['ID_Organisation'];
            $_SESSION['user_type'] = 'Organisation';
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
