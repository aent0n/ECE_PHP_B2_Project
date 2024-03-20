<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email_register"];
    $password = password_hash($_POST["password_register"], PASSWORD_BCRYPT);
    
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "db";
    $port = 3306;




    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password_db);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        // Prepare a SELECT statement to check if the email already exists
        $stmt = $conn->prepare("SELECT * FROM client WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();


        // Fetch the result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        // Check if a user was found
        if ($user) {
            // User already exists, redirect to the account creation failed page
            echo "<script>
                setTimeout(function() {
                    window.location.href = '/login.html';
                }, 2000);  // 2000 milliseconds = 2 seconds
            </script>";
            echo "User with this email already exists. You will be redirected in 5 seconds.";
            exit;
        }


        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO client (nom_Client, prénom_Client, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)");


        // Bind the parameters
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $password);


        // Execute the statement
        $stmt->execute();


        echo "<script>
            setTimeout(function() {
                window.location.href = '/client.php';
            }, 5000);  // 5000 milliseconds = 5 seconds
        </script>";
        echo "Your account has been created. You will be redirected in 5 seconds.";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }


        $conn = null; // Close the connection
    }


?>