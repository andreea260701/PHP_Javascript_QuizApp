<?php

// Declara variabila globala
global $conn;

// Atributele pentru conexiune
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizdb";

// Crează conexiunea
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifică conexiunea
if ($conn->connect_error) {
    die("Conexiunea la bază de date a eșuat: " . $conn->connect_error);
}


// Aici poți executa interogări sau alte operații pe bază de date

// Închide conexiunea la finalul scriptului sau când nu mai ai nevoie de ea
$conn->close();

session_start();