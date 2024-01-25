<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

// Interogare pentru a prelua întrebările
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

$questions = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();

// Returnează întrebările sub formă de JSON
header('Content-Type: application/json');
echo json_encode($questions);
?>
