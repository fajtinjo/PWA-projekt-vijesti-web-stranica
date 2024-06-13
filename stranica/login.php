<!DOCTYPE html>
<html lang="hr">
<link rel="stylesheet" type="text/css" href="style.css">
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
</head>
<body>
    <form action="login_skripta.php" method="POST">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Prijava</button>
        <br>

        <a href="registracija.php">Niste registrirani?</a>
        <br>
        <a href="index.php">Povratak na početnu stranicu kao gost</a>
    </form>
</body>
</html>
