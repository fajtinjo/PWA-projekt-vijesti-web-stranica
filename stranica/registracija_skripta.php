<?php
include 'connect.php';

$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$username = $_POST['username'];
$lozinka = $_POST['pass'];
$hashed_password = password_hash($lozinka, PASSWORD_BCRYPT);
$razina = 0;
$registriranKorisnik = '';

$sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
$stmt = mysqli_stmt_init($dbc);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
}
if (mysqli_stmt_num_rows($stmt) > 0) {
    $msg = 'Korisničko ime već postoji!';
} else {
    $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
        mysqli_stmt_execute($stmt);
        $registriranKorisnik = true;
    }
}
mysqli_close($dbc);
?>

<?php if ($registriranKorisnik == true) { ?>
    <p>Korisnik je uspješno registriran!</p>
    <a href="index.php">Povratak na početnu stranicu</a>
<?php } else { ?>
    <p><?php echo $msg; ?></p>
    <a href="registracija.php">Pokušajte ponovno</a>
    <br>
    <a href="index.php">Povratak na početnu stranicu</a>
<?php } ?>
