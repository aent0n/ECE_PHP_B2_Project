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
		<li class="active">
			<a href="#">
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
				$table .= "<th>Utilisateur</th>";
				$table .= "<th>Date de commande</th>";
				$table .= "<th>Statut</th>";
				$table .= "</tr>";
				$table .= "</thead>";
				$table .= "<tbody style='display:flex-col; align-items: center; margin-bottom: 10px; background-color: #f0f0f0; justify-content: center;'>";
				while ($row = $result->fetch_assoc()) {
					$table .= "<tr>";
					$table .= "<td>";
					$table .= "<div style='display: flex; align-items: center; margin-bottom: 10px;'>";
					$table .= "<img src='img/people.jpg' style='width: 80px; height: 80px; border-radius: 50%; margin-right: 10px;'>";
					$table .= "<p style='font-size: 16px;'>" . $row["nom_Client"] . " " . $row["prénom_Client"] . "</p>";
					$table .= "</div>";
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
			<li>
				<a href="messages_stand.php" onclick="toggleMessaging()">
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
					<h1>Mes Clients</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Mes Clients</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Acceuil</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>
			<div class="table-data">
    <div class="todo">
        <div class="head">
            <h3>Liste</h3>
            <i class='bx bx-plus' ></i>
            <i class='bx bx-filter' ></i>
        </div>
        <ul class="todo-list">
            <?php echo $table; ?>
	</section>
	<!-- CONTENT -->
	

	<script src="admin.js"></script>
</body>
</html>