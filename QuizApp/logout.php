<?php
session_start(); // Inițializează sesiunea

// Distrugerea sesiunii
session_destroy();

// Redirecționare către pagina de login sau oricare altă pagină dorită
header("Location: index.php"); // Modifică "login.php" cu pagina dorită
exit();
?>
