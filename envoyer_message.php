<?php
// Vérifier si le message est bien envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    // Récupérer le message
    $message = $_POST["message"];

    // Assurez-vous que l'utilisateur est connecté et récupérez son ID
    session_start(); // Démarrer la session (assurez-vous que session_start() est appelé avant toute sortie HTML)
    $userID = $_SESSION['user_id']; // Suppose que vous avez stocké l'ID de l'utilisateur dans la session

    // Se connecter à la base de données
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "db";
    $port = 3306;

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Préparer la requête SQL d'insertion avec l'ID du client
    $sql = "INSERT INTO commentaire (id_client, description_Commentaire) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userID, $message); // 'i' pour un entier, 's' pour une chaîne de caractères

    // Exécuter la requête d'insertion
    if ($stmt->execute() === TRUE) {
        // Répondre avec un message de confirmation
        echo "Message envoyé avec succès.";
    } else {
        // Répondre avec un message d'erreur si l'insertion échoue
        http_response_code(500);
        echo "Erreur lors de l'envoi du message: " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();
} else {
    // Répondre avec un message d'erreur si la requête n'est pas correcte
    http_response_code(400);
    echo "Erreur : requête invalide.";
}
?>
