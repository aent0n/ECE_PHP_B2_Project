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
			<li>
				<a href="stand.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Tableau de commande</span>
				</a>
			</li>
		<li>
			<a href="mes_clients.php">
				<i class='bx bxs-shopping-bag-alt'></i>
				<span class="text">Mes clients</span>
			</a>
		</li>

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
			$sql = "SELECT nom_Client, prénom_Client, email, statut FROM client";
			$result = $conn->query($sql);

			// Vérifier si des données ont été trouvées
			$table = "";
			if ($result->num_rows > 0) {
				$table .= "<table>";
				$table .= "<thead>";
				$table .= "<tr>";
				$table .= "<th>User</th>";
				$table .= "<th>Date Order</th>";
				$table .= "<th>Statut</th>";
				$table .= "</tr>";
				$table .= "</thead>";
				$table .= "<tbody>";
				while ($row = $result->fetch_assoc()) {
					$table .= "<tr>";
					$table .= "<td>";
					$table .= "<img src='img/people.jpg' style='width:25%;'>";
					$table .= "<p>" . $row["nom_Client"] . " " . $row["prénom_Client"] . "</p>";
					$table .= "</td>";
					$table .= "<td>01-10-2021</td>"; // Remplacez cette valeur par la date de commande réelle

					$statut = ($row["statut"] == "completed") ? "completed" : "process";
					$table .= "<td><span class='status " . strtolower($statut) . "'>" . ucfirst($statut) . "</span></td>";

					$table .= "</tr>";
				}
				$table .= "</tbody>";
				$table .= "</table>";
			} else {
				$table = "<p>Aucun client trouvé.</p>";
			}

			// Fermer la connexion à la base de données
			$conn->close();
		?>
			<li class="active">
				<a href="">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Messages</span>
				</a>
			</li>
			<li style="cursor: not-allowed;">
				<a  style="cursor: not-allowed;" href="">
					<i class='bx bxs-group' ></i>
					<span class="text">Intervenants</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="param_stand.html">
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
					<h1>Messages</h1>
					<ul class="breadcrumb">
						<li>
							<a claSS="active" href="admin.php">Tableau de commande</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="" href="#">Messages</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Télécharger PDF</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
                    <!-- conversation 1 -->
                    <div class="conversation">
                        </div>
                        <div class="info">
                            <h3>Anton ADAM</h3>
                            <p class="message-content">Bonjour, j'aimerais savoir où en est ma demande ! <br> Numéro: 123456, merci !</p>
                        </div>
                        <div class="date">
                            <span>9:22 PM</span>
                            <div class="reply">
                                <i class='bx bx-reply' ></i>
                        </div>
                    </div>
				</li>
				<li>
                    <!-- conversation 2 -->
                    <div class="conversation">
                        </div>
                        <div class="info">
                            <h3>Mélanie FLANELLE</h3>
                            <p class="message-content">Bonjour, je ne pourrais pas être dipsonible au rendez-vous convenu. Désolé d'avance.</p>
                        </div>
                        <div class="date">
                            <span>10:56 AM</span>
                            <div class="reply">
                                <i class='bx bx-reply' ></i>
                        </div>
                    </div>
				</li>
				<li>
                    <!-- conversation 3 -->
                    <div class="conversation">
                        </div>
                        <div class="info">
                            <h3>Phillipe MAOH</h3>
                            <p class="message-content">Merci beaucoup pour le travail effectué. Je ferai appel à vous encore au besoin.</p>
                        </div>
                        <div class="date">
                            <span>5:06 PM</span>
                            <div class="reply">
                                <i class='bx bx-reply' ></i>
                        </div>
                    </div>
				</li>
			</ul>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="admin.js"></script>
</body>
</html>