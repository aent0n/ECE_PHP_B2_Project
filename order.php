<?php
// Connexion à la base de données
$servername = "localhost";
$username = "votre_nom_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "votre_base_de_donnees";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer les commandes récentes
$sql = "SELECT user, date_order, status FROM orders ORDER BY date_order DESC LIMIT 5";
$result = $conn->query($sql);

// Vérifier si des données ont été trouvées
if ($result->num_rows > 0) {
    // Afficher les données dans une table HTML
    echo "<table>";
    echo "<tr><th>User</th><th>Date</th><th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["user"]."</td>";
        echo "<td>".$row["date_order"]."</td>";
        echo "<td>".$row["status"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucune commande trouvée.";
}

// Fermer la connexion à la base de données
$conn->close();
?>