<?php
session_start(); // Inițializează sesiunea

// Verificăm dacă s-a trimis formularul
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prelucrăm datele primite din formular
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Conectare la baza de date
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "quizdb";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
    }

    // Verificare utilizator în baza de date
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificare parolă
        if (password_verify($password, $row["parola"])) {
            // Salvare informații despre utilizator în sesiune
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["status"] = $row["status"];

            echo '<script>alert("Logare reușită!");</script>';
            // Redirecționare către pagina principală sau altă pagină după logare
            header("Location: index.php"); // Modifică "index.php" cu pagina dorită
            exit();
        } else {
            echo '<script>alert("Eroare: Parolă incorectă.");</script>';
            echo '<script>window.location = "login.php";</script>';
        }
    } else {
        echo '<script>alert("Eroare: Utilizatorul nu există.");</script>';
        echo '<script>window.location = "login.php";</script>';
    }

    $conn->close();
}
?>
