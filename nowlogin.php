<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email_register"];
    $password = password_hash($_POST["password_register"], PASSWORD_BCRYPT);
    $statut = "encour"; // Statut par défaut

    // Générer un numéro de téléphone aléatoire commençant par zéro et comportant dix chiffres
    $telephone = "0" . mt_rand(100000000, 999999999);

    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "db";
    $port = 3306;

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, statut, téléphone_Client) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nom, $prenom, $email, $password, $statut, $telephone);

    // Execute the statement
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccordEnergie - Création de Compte</title>
    <link rel="stylesheet" href="nowlogin.css">
</head>
<body>

    <header>
        <h1>Création de Compte</h1>
    </header>

    <form action="prg.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required>

        <label for="email_register">Email :</label>
        <input type="email" name="email_register" required>

        <label for="password_register">Mot de passe :</label>
        <input type="password" name="password_register" required>

        <input type="submit" value="S'inscrire">
    </form>

    <hr>

    <section>
        <h2>Retour à la Connexion</h2>
        <p>Déjà un compte? <a href="login.html">Connectez-vous ici</a>.</p>
    </section>

</body>
</html>
