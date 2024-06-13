<!DOCTYPE html>
<html lang="hr">
<link rel="stylesheet" type="text/css" href="style.css">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
</head>
<body>
    <form action="registracija_skripta.php" method="POST">
        <label for="ime">Ime:</label>
        <input type="text" id="ime" name="ime" required>
        <br>
        <label for="prezime">Prezime:</label>
        <input type="text" id="prezime" name="prezime" required>
        <br>
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="pass">Lozinka:</label>
        <input type="password" id="pass" name="pass" required>
        <br>
        <label for="passRep">Ponovite lozinku:</label>
        <input type="password" id="passRep" name="passRep" required>
        <br>
        <button type="submit">Registracija</button>
        <br>
        <a href="index.php">Povratak na početnu stranicu kao gost</a>
        <br>
        <a href="login.php">Povratak na prijavu</a>
    </form>
</body>
</html>
