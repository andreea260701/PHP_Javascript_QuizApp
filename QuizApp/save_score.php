<?php
session_start();
// Configurarea conexiunii la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizdb";

// Crearea conexiunii
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificarea conexiunii
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

// Obține scorul din solicitarea POST
$newScore = $_POST['score'];

// Obține numele utilizatorului (presupunând că îl ai în sesiune sau altundeva)
$username = $_SESSION['username'];

// SQL pentru a obține scorul existent
$sqlGetScore = "SELECT score FROM users WHERE username = '$username'";
$result = $conn->query($sqlGetScore);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentScore = $row['score'];

    // Verifică dacă noul scor este mai mare decât scorul curent
    if ($newScore > $currentScore) {
        // Actualizează scorul numai dacă este mai mare
        $sqlUpdateScore = "UPDATE users SET score = $newScore WHERE username = '$username'";

        if ($conn->query($sqlUpdateScore) === TRUE) {
            echo "Scorul a fost actualizat cu succes.";
        } else {
            echo "Eroare la actualizarea scorului: " . $conn->error;
        }
    } else {
        echo "Scorul nu a fost actualizat. Noul scor este mai mic sau egal cu scorul curent.";
    }
} else {
    echo "Eroare la obținerea scorului existent.";
}

// Închide conexiunea
$conn->close();
?>
