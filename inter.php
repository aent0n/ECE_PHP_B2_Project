<?php

// Function to handle status update
function updateStatus($status) {
    // Code to update status in the database

	// Database connection
	$servername = "localhost";
	$username = "root";
	$password_db = "";
	$dbname = "db";
	$port = 3306;
	$conn = new mysqli($servername, $username, $password_db, $dbname, $port);
	$sql = "UPDATE commentaire SET Statut = '" . $status . "' WHERE id_commentaire = " . $_POST['id'];	$result = $conn->query($sql);
	if ($result === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}
	$conn->close();
}

// Function to handle click on Completed span
function clickCompleted() {
    updateStatus("Completed");


}

// Function to handle click on Process span
function clickProcess() {
    updateStatus("Process");
}

// Function to handle click on No span
function clickNo() {
    updateStatus("No");
	
}

// Call the respective functions based on span click
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'completed':
            clickCompleted();
            break;
        case 'process':
            clickProcess();
            break;
        case 'no':
            clickNo();
            break;
        default:
            echo "Invalid action";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="inter.css">

	<title>Intervenant</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Intervenant</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="analytics.html">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Tableau de commande</span>
				</a>
			</li>
			<li>
				<a href="messages_inter.html">
					<i class='bx bxs-group' ></i>
					<span class="text">Contact</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="settings_inter.html">
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
			<a href="#" class="nav-link">Catégories</a>
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
					<h1>Tableau de commande</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Tableau de commande</a>
						</li>
					</ul>
			</div>

			<ul class="box-info">
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Mission</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Utilisateur</th>
								<th>Date de commande</th>
                                <th>Adresse</th>
								<th>Statut</th>
							</tr>
                            
						</thead>
        

						<tbody>
							<tr>
								<td>
									<img src="img/people.jpg">
									<p>Felipe Wolx</p>
								</td>
								<td>25-03-2024</td>
                                <td>103, Ari St, New-York</td>
								<td><span id="completed" class="status completed" onclick="updateStatus('completed')" onclick="updateStatus('completed')">Completed</span></td>
                                <td><span id="pending" class="status pending" onclick="updateStatus('process')">process</span></td>
                                <td><span id="no" class="status process" onclick="updateStatus('no')">no</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.jpg">
									<p>Sylvia Tenno</p>
								</td>
								<td>16-01-2024</td>
                                <td>096, Golden St., Denver</td>
                                <td><span id="completed" class="status completed" onclick="updateStatus('completed')" onclick="updateStatus('completed')">Completed</span></td> 
								<td><span id="pending" class="status pending" onclick="updateStatus('process')">process</span></td>
                                <td><span id="no" class="status process" onclick="updateStatus('no')">no</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.jpg">
									<p>Max Ginner</p>
								</td>
								<td>01-12-2023</td>
                                <td>285, Fortune St., Las Vegas</td>
								<td><span id="completed" class="status completed" onclick="updateStatus('completed')" onclick="updateStatus('completed')" onclick="updateStatus('completed')">Completed</span></td> 
								<td><span id="pending" class="status pending" onclick="updateStatus('process')">process</span></td>
                                <td><span id="no" class="status process" onclick="updateStatus('no')">no</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.jpg">
									<p>Belle O'Brian</p>
								</td>
								<td>11-10-2023</td>
                                <td>056, Retam St., Salt Lake City</td>
								<td><span id="completed" class="status completed" onclick="updateStatus('completed')" onclick="updateStatus('completed')">Completed</span></td> 
								<td><span id="pending" class="status pending" onclick="updateStatus('process')">process</span></td>
                                <td><span id="no" class="status process" onclick="updateStatus('no')">no</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.jpg">
									<p>Paul Dough</p>
								</td>
								<td>06-10-2023</td>
                                <td>146, Horseshow St., Kansas City</td>
								<td><span id="completed" class="status completed" onclick="updateStatus('completed')" onclick="updateStatus('completed')">Completed</span></td> 
								<td><span id="pending" class="status pending" onclick="updateStatus('process')">process</span></td>
                                <td><span id="no" class="status process" onclick="updateStatus('no')">no</span></td>
							</tr>
						</tbody>
					</table>
				
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="admin.js"></script>
	<script>
		// Get the status spans
		var completed = document.getElementById("completed");
		var process = document.getElementById("process");
		var no = document.getElementById("no");

		// Add click event listeners to the status spans
		completed.addEventListener("click", function() {
			document.getElementById("pending").delete;
			document.getElementById("no").delete;
		});
		process.addEventListener("click", function() {
			document.getElementById("completed").delete;
			document.getElementById("no").delete;
		});
		no.addEventListener("click", function() {
			document.getElementById("completed").delete;
			document.getElementById("pending").delete;
		});
	</script>
</body>
</html>