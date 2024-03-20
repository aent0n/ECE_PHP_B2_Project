<?php
// Vérifie si les données du formulaire sont envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si l'ID du commentaire et de l'intervenant sont définis
    if (isset($_POST["id_commentaire"]) && isset($_POST["id_intervenant"])) {
        // Récupère les valeurs des champs
        $id_commentaire = $_POST["id_commentaire"];
        $id_intervenant = $_POST["id_intervenant"];

        // Connexion à la base de données (à remplir avec vos informations de connexion)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Requête SQL pour mettre à jour l'intervenant associé au commentaire
        $sql_update = "UPDATE commentaire SET id_Client = $id_intervenant WHERE id_Commentaire = $id_commentaire";

        if ($conn->query($sql_update) === TRUE) {
            echo "L'intervenant a été associé au commentaire avec succès.";
        } else {
            echo "Erreur lors de l'association de l'intervenant au commentaire : " . $conn->error;
        }

        // Fermer la connexion à la base de données
        $conn->close();
    } else {
        echo "ID du commentaire ou de l'intervenant manquant.";
    }
} else {
    echo "Méthode de requête incorrecte.";
}
?>
