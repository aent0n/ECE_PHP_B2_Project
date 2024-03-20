<!DOCTYPE html>
<html lang="vf">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="admin.css">

    <title>Admin</title>
</head>
<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Admin</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="my_clients.PHP">
                    <i class='bx bxs-shopping-bag-alt' ></i>
                    <span class="text">Mes clients</span>
                </a>
            </li>
            <li>
                <a href="analytics.html">
                    <i class='bx bxs-doughnut-chart' ></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li>
                <a href="message.html">
                    <i class='bx bxs-message-dots' ></i>
                    <span class="text">Message</span>
                </a>
            </li>
            <li>
                <a href="teams.html">
                    <i class='bx bxs-group' ></i>
                    <span class="text">Teams</span></a>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="settings.html">
                    <i class='bx bxs-cog' ></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="login.html" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->



    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu' ></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell' ></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.jpg">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="admin.php">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <i class='bx bxs-calendar-check'></i>
                    <span class="text">
                    <h3>
                        <?php
                            // Connexion à la base de données
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "db";
                            $port = 3306;
                            $conn = new mysqli($servername, $username, $password, $dbname, $port);
                            
                            if ($conn->connect_error) {
                                die("Échec de la connexion à la base de données: " . $conn->connect_error);
                            }
                            
                            // Requête SQL pour récupérer le nombre de demandes
                            $sql = "SELECT COUNT(*) AS `id-client` FROM client";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo $row["id-client"];
                            } else {
                                echo "0";
                            }
                            
                            $conn->close();
                            ?>
                        </h3>
                        <p>Demande client</p>
                            </span>
                </li>
                <li>

                    <i class='bx bx-headphone'></i>
                    <span class="text">
                        <h3><?php
                        // Connexion à la base de données
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "db";
                                $port = 3306;
                                $conn = new mysqli($servername, $username, $password, $dbname, $port);

                                if ($conn->connect_error) {
                                    die("Échec de la connexion à la base de données: " . $conn->connect_error);
                                }

                                // Requête SQL pour récupérer le nombre de standardistes
                                $sql = "SELECT COUNT(*) AS id_standardiste FROM standardiste";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    echo $row["id_standardiste"];
                                } else {
                                    echo "0";
                                }

                                $conn->close();;
                            ?></h3>
                        <p>Standardiste</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group' ></i>
                    <span class="text">
                        <h3><?php
                        // Connexion à la base de données
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "db";
                                $port = 3306;
                                $conn = new mysqli($servername, $username, $password, $dbname, $port);

                                if ($conn->connect_error) {
                                    die("Échec de la connexion à la base de données: " . $conn->connect_error);
                                }

                                // Requête SQL pour récupérer le nombre de intervenant
                                $sql = "SELECT COUNT(*) AS id_intervenant FROM intervenant";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    echo $row["id_intervenant"];
                                } else {
                                    echo "0";
                                }

                                $conn->close();;
                            ?></h3>
                        <p>Intervenant</p>
                    </span>
                </li>
            </ul>


            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Orders</h3>
                        <i class='bx bx-search' ></i>
                        <i class='bx bx-filter' ></i>
                    </div>
                    <table>
                        <tbody>
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

// Requête SQL pour récupérer les clients
$sql = "SELECT id_Client, nom_Client, prénom_Client, email, statut FROM client";
$result = $conn->query($sql);

// Vérifier si des données ont été trouvées
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>User</th>";
    echo "<th>Date Order</th>";
    echo "<th>Statut</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>";
        echo "<img src='img/people.jpg'>";
        echo "<p>" . $row["nom_Client"] . " " . $row["prénom_Client"] . "</p>";
        echo "</td>";
        echo "<td>01-10-2024</td>"; // Remplacez cette valeur par la date de commande réelle

        $statut = ($row["statut"] == "completed") ? "completed" : "process";
        echo "<td><span class='status " . strtolower($statut) . "'>" . ucfirst($statut) . "</span></td>";

        echo "<td>";
        echo "<form method='POST' action='transferer_role.php'>"; // Ajout de l'attribut action avec la valeur 'transferer_role.php'
        echo "<input type='hidden' name='id_utilisateur' value='" . $row["id_Client"] . "'>";
        echo "<select name='nouveau_role'>";
        echo "<option value='admin'>Admin</option>";
        echo "<option value='standard'>Standard</option>";
        echo "<option value='intervenant'>Intervenant</option>";
        echo "</select>";
        echo "<input type='submit' value='Transférer le rôle' id='transfer-role-button'>";
;
        echo "</form>";
        echo "</td>";

        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>Aucun client trouvé.</p>";
}

// Fermer la connexion à la base de données
$conn->close();
?>

                    </table>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    

    <script src="admin.js"></script>
</body>
</html>
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
    $nouveau_role = "client"; // Modifier le rôle par défaut ici

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
