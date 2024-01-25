<?php
// Verificăm dacă s-a trimis formularul
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prelucrăm datele primite din formular
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $status = $_POST["status"]; // Adăugăm preluarea statusului din formular

    // Verificăm dacă parolele coincid
    if ($password !== $confirm_password) {
        echo '<script>alert("Eroare: Parolele nu coincid.");</script>';
        echo '<script>window.location = "register_admin.php";</script>';
        exit; // Oprire pentru a preveni executarea ulterioară a codului
    } else {
        // Hasurăm parola
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Validare pentru a verifica dacă email-ul sau username-ul există deja în baza de date
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "quizdb";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
        }

        // Verificare unicitate email
        $email_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $email_result = $conn->query($email_check_query);

        if ($email_result->num_rows > 0) {
            echo '<script>alert("Eroare: Acest email este deja înregistrat.");</script>';
            echo '<script>window.location = "register_admin.php";</script>';
            exit;
        }

        // Verificare unicitate username
        $username_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $username_result = $conn->query($username_check_query);

        if ($username_result->num_rows > 0) {
            echo '<script>alert("Eroare: Acest username este deja înregistrat.");</script>';
            echo '<script>window.location = "register_admin.php";</script>';
            exit;
        }

        // Poți folosi o interogare SQL de tipul INSERT pentru a adăuga datele în tabela users
        $sql = "INSERT INTO users (email, parola, nume, username, status) VALUES ('$email', '$hashed_password', '$name', '$username', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Înregistrare reușită!");</script>';
            echo '<script>window.location = "index.php";</script>';
        } else {
            echo '<script>alert("Eroare la înregistrare: ' . $conn->error . '");</script>';
            echo '<script>window.location = "index.php";</script>';
        }

        $conn->close();
    }
}
?>
