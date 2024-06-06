<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    header("location: login.php?message=Please login first");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];
include("connection.php");

// Load Composer's autoloader
require_once realpath(__DIR__ . '/vendor/autoload.php');

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["add_don"])) {
    $montant = $_POST["Montant_Don"];
    $id_donateur = $_POST["ID_donateur"] ?? null; // Use null if ID_donateur is not set
    $date = $_POST["Date_du_don"];
    $id_campagne = $_POST["ID_campagne"];
    $mode_de_paiement = $_POST["Mode_de_paiement"];
    $status = $_POST["Statut_Don"];

    if (empty($montant) || empty($date) || empty($id_campagne) || empty($mode_de_paiement) || empty($status)) {
        header("location: don.php?message=Missing values!");
        exit;
    } else {
        if ($user_type == 'Organisation') {
            $sql = "INSERT INTO don (Montant_Don, Date_du_don, ID_donateur, ID_campagne, Mode_de_paiement, Statut_Don) VALUES (:montant, :date, :id_donateur, :id_campagne, :mode_de_paiement, :status)";
            $query = $conn->prepare($sql);
            $parameters = [
                ':montant' => $montant,
                ':date' => $date,
                ':id_donateur' => $id_donateur,
                ':id_campagne' => $id_campagne,
                ':mode_de_paiement' => $mode_de_paiement,
                ':status' => $status
            ];
        } elseif ($user_type == 'Utilisateur') {
            $sql = "INSERT INTO don (Montant_Don, Date_du_don, ID_donateur, ID_campagne, Mode_de_paiement, Statut_Don) VALUES (:montant, :date, :user_id, :id_campagne, :mode_de_paiement, :status)";
            $query = $conn->prepare($sql);
            $parameters = [
                ':montant' => $montant,
                ':date' => $date,
                ':user_id' => $user_id,
                ':id_campagne' => $id_campagne,
                ':mode_de_paiement' => $mode_de_paiement,
                ':status' => $status
            ];
        }

        $resultat = $query->execute($parameters);
        if ($resultat) {
            if ($user_type == 'Utilisateur') {
                // Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    // Load HTML template
                    $template = file_get_contents('email_template.html');
                    
                    // Replace placeholders with actual values
                    $body = str_replace(
                        ['{{montant}}', '{{date}}', '{{id_campagne}}', '{{mode_de_paiement}}', '{{status}}'],
                        [$montant, $date, $id_campagne, $mode_de_paiement, $status],
                        $template
                    );

                    // Server settings
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'hamadacheikhi20@gmail.com';            // SMTP username
                    $mail->Password   = '';                  // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
                    $mail->Port       = 587;                                    // TCP port to connect to

                    // Recipients
                    $mail->setFrom('hamadacheikhi20@gmail.com', 'Mailer');
                    $mail->addAddress('cheikhimohamed51@gmail.com');                      // Add a recipient

                    // Content
                    $mail->isHTML(true);                                        // Set email format to HTML
                    $mail->Subject = 'Donation Confirmation';
                    $mail->Body    = $body;
                    $mail->AltBody = strip_tags($body);  // For clients that do not support HTML

                    $mail->send();
                    header("location: don.php?insert_msg=Data inserted successfully and email sent!");
                    exit;
                } catch (Exception $e) {
                    header("location: don.php?insert_msg=Data inserted successfully but email sending failed: {$mail->ErrorInfo}");
                    exit;
                }
            } else {
                header("location: don.php?insert_msg=Data inserted successfully!");
                exit;
            }
        } else {
            header("location: don.php?message=Data insertion failed!");
            exit;
        }
    }
}
?>
