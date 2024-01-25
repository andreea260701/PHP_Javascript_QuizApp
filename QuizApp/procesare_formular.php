<?php
// Verificăm dacă s-a trimis formularul
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prelucrăm datele primite din formular
    $question_text = $_POST["question_text"];
    $choice1 = $_POST["choice1"];
    $choice2 = $_POST["choice2"];
    $choice3 = $_POST["choice3"];
    $choice4 = $_POST["choice4"];
    $correct_answer = $_POST["correct_answer"];

    // Conectare la baza de date
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "quizdb";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
    }

    // Poți folosi o interogare SQL de tipul INSERT pentru a adăuga datele în tabela quiz
    $sql = "INSERT INTO questions (question_text, choice1, choice2, choice3, choice4, correct_answer) VALUES ('$question_text', '$choice1', '$choice2', '$choice3', '$choice4', '$correct_answer')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Întrebare adăugată cu succes!");</script>';
        echo '<script>window.location = "quizform.php";</script>';
    } else {
        echo '<script>alert("Eroare la adăugarea întrebării: ' . $conn->error . '");</script>';
        echo '<script>window.location = "quizform.php";</script>';
    }

    $conn->close();
}
?>
