<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="admin.css">

    <title>Clients</title>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Clients</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="#">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Messages</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="settings.html">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Paramètres</span>
                </a>
            </li>
            <li>
                <a href="login.html" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Déconnexion</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Catégories</a>
            <form action="#">
              <div class="form-input">
                    <input type="search" placeholder="Rechercher...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>  
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.jpg" alt="Profil">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Tableau de bord</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Tableau de bord</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Accueil</a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Télécharger PDF</span>
                </a>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Mes demandes</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                    // Paramètres de connexion à la base de données
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = ""; // Remplacez par le mot de passe de votre base de données
                                    $dbname = "db"; // Remplacez par le nom de votre base de données
                                    $port = 3306;

                                    try {
                                        // Connexion à la base de données avec PDO
                                        $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
                                        // Définir le mode d'erreur PDO à exception
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        // Démarrer la session pour accéder aux variables de session
                                        session_start();

                                        // Vérifier si l'utilisateur est connecté en vérifiant si l'ID utilisateur est stocké dans la session
                                        if (!isset($_SESSION['user_id'])) {
                                            // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
                                            header('Location: /page_de_connexion.php');
                                            exit;
                                        }

                                        // Récupérer l'ID client à partir de la session
                                        $user_id = $_SESSION['user_id'];

                                        // Requête préparée pour récupérer les informations du client en fonction de l'ID client
                                        $stmt = $conn->prepare("SELECT * FROM client WHERE id_Client = :id_client");
                                        $stmt->bindParam(':id_client', $user_id);
                                        $stmt->execute();

                                        // Récupérer les résultats de la requête
                                        $client_info = $stmt->fetch(PDO::FETCH_ASSOC);
                                        // Vérifier si des données ont été trouvées
                                        if ($client_info) {
                                            // Afficher les informations du client
                                            echo "Nom: " . $client_info['nom_Client'] . "<br>";
                                            echo "Prénom: " . ($client_info['prénom_Client'] ?? '') . "<br>";
                                            echo "Téléphone: " . ($client_info['téléphone_Client'] ?? '') . "<br>";
                                            echo "Email: " . $client_info['email'] . "<br>";
                                           
                                        } else {
                                            // Aucun client trouvé avec cet ID client
                                            echo "Aucun client trouvé avec cet ID client.";
                                        }
                                        
                                        // Fermer la connexion à la base de données
                                        $conn = null;
                                    } catch(PDOException $e) {
                                        // En cas d'erreur de connexion, afficher le message d'erreur
                                        echo "Échec de la connexion : " . $e->getMessage();
                                    }
                                    ?>
                                </td>
                                <td>Status</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="messaging" id="messagingSection">
                <input type="text" id="messageInput" placeholder="Tapez votre message...">
                <button onclick="envoyerMessage()">Envoyer</button> 
                <div id="messageContainer"></div>
            </div>
            <!-- Fin de la section de messagerie -->
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="admin.js"></script>
    <script>
        // Fonction pour envoyer un message
        function envoyerMessage() {
            var messageInput = document.getElementById("messageInput");
            var messageContainer = document.getElementById("messageContainer");

            // Obtenir le texte du message
            var texteMessage = messageInput.value;

            // Envoyer le message au standardiste via PHP
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "envoyer_message.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Afficher la réponse du serveur si la requête est réussie
                        messageContainer.innerHTML += "<p>Message envoyé : " + texteMessage + "</p>";
                        // Effacer le champ de saisie
                        messageInput.value = "";
                    } else {
                        // Afficher un message d'erreur si la requête échoue
                        messageContainer.innerHTML += "<p>Erreur lors de l'envoi du message.</p>";
                    }
                }
            };
            xhr.send("message=" + encodeURIComponent(texteMessage));
        }
        function chargerMessages() {
            var messageContainer = document.getElementById("messageContainer");

            // Charger les messages du client depuis la base de données via PHP
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "charger_messages.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Afficher les messages du client
                    messageContainer.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Charger les messages du client lors du chargement de la page
        window.onload = chargerMessages;
    </script>
</body>
</html>
