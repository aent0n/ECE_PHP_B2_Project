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

// Vérifier si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $id_utilisateur = $_POST['id_utilisateur'];
    $nouveau_role = $_POST['nouveau_role'];

    // Mettre à jour le rôle de l'utilisateur dans la base de données
    $sql = "UPDATE client SET role='$nouveau_role' WHERE id_Client=$id_utilisateur";
    if ($conn->query($sql) === TRUE) {
        echo "Le rôle de l'utilisateur a été mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du rôle de l'utilisateur: " . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

