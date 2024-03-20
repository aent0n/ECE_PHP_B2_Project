<?php
// Démarrer la session
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "db";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer l'ID de l'utilisateur connecté
if(isset($_SESSION['user_id'])){
    $userID = $_SESSION['user_id']; 
} else {
    echo "Erreur : ID de l'utilisateur non trouvé.";
    exit();
}

// Récupérer les messages du client
$sql = "SELECT description_Commentaire, statut FROM commentaire WHERE id_client = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

// Afficher les messages du client sous forme de balises <p> et afficher le statut de la demande
while ($row = $result->fetch_assoc()) {
    $message = $row["description_Commentaire"];
    $statut = $row["statut"];
    echo "<p>Message : $message | Statut de la demande : ";
    if(empty($statut)) {
        echo "en cours</p>";
    } else {
        echo "$statut</p>";
    }
}

$stmt->close();
$conn->close();
?>
