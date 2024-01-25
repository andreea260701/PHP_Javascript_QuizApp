<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular de Logare</title>

    <!-- Adaugă legătura către Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h2>Formular de Logare</h2>
<form action="procesare_login.php" method="post">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
    </div>

    <div class="form-group">
        <label for="password">Parola:</label>
        <input type="password" class="form-control" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Logare</button>
    <a class="m-lg-3" href="register.php">Daca nu ai nici un cont inregistrat, apasa aici pentru a te inregistra!</a>
    <p class="mt-4"><a href="index.php">Home</a></p>
</form>

<!-- Adaugă legătura către Bootstrap JS și jQuery pentru a activa funcționalitățile specifice Bootstrap (opțional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
