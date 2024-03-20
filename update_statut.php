<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$port = 3306;
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'identifiant du client est envoyé
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Mettre à jour le statut du client
    $sql = "UPDATE client SET Statut = 'completed' WHERE id_Client = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Le statut du client a été mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du statut du client: " . $conn->error;
    }
} else {
    echo "Identifiant du client non fourni.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
