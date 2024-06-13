<?php
session_start();
include 'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM korisnik WHERE korisnicko_ime=?";
$stmt = mysqli_stmt_init($dbc);
if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['lozinka'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['korisnicko_ime'];
            header('Location: administrator.php');
        } else {
            echo "Pogrešno korisničko ime ili lozinka!";
        }
    } else {
        echo "Pogrešno korisničko ime ili lozinka!";
        echo '<br>';
        echo '<a href="login.php">Pokušajte ponovno</a>';
        echo '<br>';
        echo '<a href="index.php">Povratak na početnu stranicu</a>';
    }
}
mysqli_close($dbc);
?>
