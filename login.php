<?php
// Database connection
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "db";
$port = 3306;

// Create connection
$db = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get the email and password from the form
$email = $_POST['email'];
$password = $_POST['password'];

// Query the database to find the user in the client table
$query_client = "SELECT * FROM client WHERE email = ?";
$stmt_client = $db->prepare($query_client);
$stmt_client->bind_param('s', $email);
$stmt_client->execute();
$result_client = $stmt_client->get_result();
$user_client = $result_client->fetch_assoc();

// Check if the user exists in the client table and the password is correct
if ($user_client && password_verify($password, $user_client['mot_de_passe'])) {
    // Start the session and store the user's ID in it
    session_start();
    $_SESSION['user_id'] = $user_client['id_Client'];

    // Redirect to client.html
    header('Location: /client.php');
    exit;
} 

// Query the database to find the user in the admin table
$query_admin = "SELECT * FROM admin WHERE user = ?";
$stmt_admin = $db->prepare($query_admin);
$stmt_admin->bind_param('s', $email);
$stmt_admin->execute();
$result_admin = $stmt_admin->get_result();
$user_admin = $result_admin->fetch_assoc();

// Check if the user exists in the admin table and the password is correct
if ($user_admin && $password == $user_admin['paseword']) {
    // Start the session and store the user's ID in it
    session_start();
    $_SESSION['admin_id'] = $user_admin['id_Admin'];

    // Redirect to admin.html
    header('Location: /admin.php');
    exit;

} 

// Query the database to find the user in the standardist table
$query_standardist = "SELECT * FROM standardiste WHERE user = ?";
$stmt_standardist = $db->prepare($query_standardist);
$stmt_standardist->bind_param('s', $email);
$stmt_standardist->execute();
$result_standardist = $stmt_standardist->get_result();
$user_standardist = $result_standardist->fetch_assoc();

// Check if the user exists in the standardist table and the password is correct
if ($user_standardist && $password == $user_standardist['PASSWORD']) {
    // Start the session and store the user's ID in it
    session_start();
    $_SESSION['standardist_id'] = $user_standardist['id_standardiste'];

    // Redirect to standardist.html
    header('Location: /stand.php');
    exit;
} 

// Query the database to find the user in the intervenant table
$query_intervenant = "SELECT * FROM intervenant WHERE user = ?";
$stmt_intervenant = $db->prepare($query_intervenant);
$stmt_intervenant->bind_param('s', $email);
$stmt_intervenant->execute();
$result_intervenant = $stmt_intervenant->get_result();
$user_intervenant = $result_intervenant->fetch_assoc();

// Check if the user exists in the intervenant table and the password is correct
if ($user_intervenant && password_verify($password, $user_intervenant['password'])) {
    // Start the session and store the user's ID in it
    session_start();
    $_SESSION['intervenant_id'] = $user_intervenant['id_Intervenant'];

    // Redirect to intervenant.html
    header('Location: /intervenant.html');
    exit;
} 

// User does not exist or incorrect password
echo "Authentication failed: User not found or incorrect password.";


?>
