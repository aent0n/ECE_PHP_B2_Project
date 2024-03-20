<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="admin.css">

	<title>Standardiste</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Standardiste</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="<?php
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
							$sql = "SELECT nom_Client, prénom_Client, email, statut FROM client";
							$result = $conn->query($sql);

							// Vérifier si des données ont été trouvées
							if ($result->num_rows > 0) {
								echo "<table>";
								echo "<thead>";
								echo "<tr>";
								echo "<th>User</th>";
								echo "<th>Date Order</th>";
								echo "<th>Statut</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								while ($row = $result->fetch_assoc()) {
									echo "<tr>";
									echo "<td>";
									echo "<img src='img/people.jpg'>";
									echo "<p>" . $row["nom_Client"] . " " . $row["prénom_Client"] . "</p>";
									echo "</td>";
									echo "<td>01-10-2021</td>"; // Remplacez cette valeur par la date de commande réelle
									
									$statut = ($row["statut"] == "completed") ? "completed" : "process";
									echo "<td><span class='status " . strtolower($statut) . "'>" . ucfirst($statut) . "</span></td>";

									
									echo "</tr>";
								}
								echo "</tbody>";
								echo "</table>";
							} else {
								echo "<p>Aucun client trouvé.</p>";
							}

							// Fermer la connexion à la base de données
							$conn->close();
						?>">
					<i class='bx bxs-shopping-bag-alt' ></i>
					
					<span class="text">Mes clients</span>
				</a>
			</li>
			<li>
				<a href="message.html" onclick="toggleMessaging()">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="">
					<i class='bx bxs-group' ></i>
					<span class="text">Intervenants</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="settingsforstand.html">
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
				<span class="num">3</span>
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
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<!-- Section de réception des messages -->
			<div class="messages" id="messageSection">
				<h3>Received Messages</h3>
				<div id="receivedMessages"></div>
			</div>
			<!-- Fin de la section de réception des messages -->

			<div class="table-data">
    <div class="todo">
        <div class="head">
            <h3>Todos</h3>
            <i class='bx bx-plus' ></i>
            <i class='bx bx-filter' ></i>
        </div>
        <ul class="todo-list">
		<?php
// Connexion à la base de données (à remplir avec vos informations de connexion)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$conn = new mysqli($servername, $username, $password, $dbname);
// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer les commentaires avec le nom et prénom de l'utilisateur
$sql = "SELECT commentaire.id_Commentaire, commentaire.description_Commentaire, client.nom_Client, client.prénom_Client FROM commentaire INNER JOIN client ON commentaire.id_Client = client.id_Client";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher chaque commentaire dans la liste de tâches
    while($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<p>" . $row["description_Commentaire"] . " - " . $row["nom_Client"] . " " . $row["prénom_Client"] . "</p>";
        echo "<form action='lier_intervenant.php' method='post'>";
        echo "<input type='hidden' name='id_commentaire' value='" . $row["id_Commentaire"] . "'>";
        echo "<select name='id_intervenant'>";
        // Récupérer les intervenants depuis la base de données
        $sql_intervenants = "SELECT * FROM intervenant";
        $result_intervenants = $conn->query($sql_intervenants);
        while($row_intervenant = $result_intervenants->fetch_assoc()) {
            echo "<option value='" . $row_intervenant["id_Intervenant"] . "'>" . $row_intervenant["prénom_Intervenant"] . " " . $row_intervenant["nom_Intervenant"] . "</option>";
        }
        echo "</select>";
        echo "<input type='submit' value='Associer Intervenant'>";
        echo "</form>";
        echo "<i class='bx bx-dots-vertical-rounded'></i>";
        echo "</li>";
    }
} else {
    echo "<li>No comments found.</li>";
}
// Fermer la connexion à la base de données
$conn->close();
?>


        </ul>
    </div>
</div>

				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
    <script src="message.js"></script>
	<script src="admin.js"></script>
	<script> 
		// Fonction pour afficher/cacher la section de réception des messages
		function toggleMessaging() {
			var messageSection = document.getElementById("messageSection");
			messageSection.classList.toggle("active");
			receiveMessages(); // Appeler la fonction de réception des messages lors de l'activation
		}

		// Fonction pour recevoir et afficher les messages
		function receiveMessages() {
			var receivedMessagesContainer = document.getElementById("receivedMessages");

			// Récupérer les messages stockés localement
			var messages = JSON.parse(localStorage.getItem("messages")) || [];

			// Afficher les messages dans la page
			receivedMessagesContainer.innerHTML = "";
			for (var i = 0; i < messages.length; i++) {
				receivedMessagesContainer.innerHTML += "<p>" + messages[i] + "</p>";
			}
		}
	</script>
</body>
</html>
