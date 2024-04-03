<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="admin.css">

    <title>Mes Clients</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">Admin</span>
    </a>
    <ul class="side-menu top">
        <li class="">
            <a href="admin.php">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Tableau de commande</span>
            </a>
        </li>
        <li class="active">
            <a href="my_clients.html">
                <i class='bx bxs-shopping-bag-alt' ></i>
                <span class="text">Mes clients</span>
            </a>
        </li>
        <li>
            <a href="analytics.html">
                <i class='bx bxs-doughnut-chart' ></i>
                <span class="text">Statistiques</span>
            </a>
        </li>
        <li>
            <a href="megclient.html">
                <i class='bx bxs-message-dots' ></i>
                <span class="text">Messages</span>
            </a>
        </li>
        <li>
            <a  href="teams.html">
                <i class='bx bxs-group' ></i>
                <span class="text">Équipe</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="settings.html">
                <i class='bx bxs-cog' ></i>
                <span class="text">Paramètres</span>
            </a>
        </li>
        <li>
            <a href="login.html" class="logout">
                <i class='bx bxs-log-out-circle' ></i>
                <span class="text">Se déconnecter</span>
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
        </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Mes Clients</h1>
                <ul class="breadcrumb">
                    <li>
                        <a claSS="active" href="admin.php">Tableau de commande</a>
                    </li>
                    <li><i class='bx bx-chevron-right' ></i></li>
                    <li>
                        <a class="" href="#">Mes Clients</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Commandes Récentes</h3>
                    <i class='bx bx-search' ></i>
                    <i class='bx bx-filter' ></i>
                </div>
                <table>
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
                    $sql = "SELECT id_Client, nom_Client, prénom_Client, email, Statut FROM client";
                    $result = $conn->query($sql);
                    // Vérifier si des données ont été trouvées
                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Utilisateur</th>";
                        echo "<th>Date de commande</th>";
                        echo "<th>Statut</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>";
                            echo "<img src='img/people.jpg'>";
                            echo "<p>" . htmlspecialchars($row["nom_Client"]) . " " . htmlspecialchars($row["prénom_Client"]) . "</p>";
                            echo "</td>";
                            echo "<td>01-10-2021</td>"; // Remplacez cette valeur par la date de commande réelle

                            $statut = ($row["Statut"] == "completed") ? "completed" : "process";
                            echo "<td><span class='status " . strtolower($statut) . "'>" . ucfirst($statut) . "</span></td>";

                            echo "<td>";
                            if ($statut == "process") {
                                echo "<button class='complete-btn' data-id='" . $row["id_Client"] . "'>Complete</button>";
                            }
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

                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script>
$(document).ready(function(){
  $('.complete-btn').click(function(){
    var id = $(this).data('id');
    $.ajax({
      url: 'update_statut.php',
      type: 'POST',
      data: {id:id},
      success: function(response){
        console.log(response);
        location.reload();
      }
    });
  });
});
</script>

</body>
</html>
