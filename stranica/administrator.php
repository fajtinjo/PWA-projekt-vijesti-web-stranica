
<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

define('UPLPATH', 'img/');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM vijesti WHERE id=?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Vijest je uspješno izbrisana.";
        } else {
            echo "Greška pri brisanju vijesti.";
        }
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($dbc, $_POST['title']);
    $about = mysqli_real_escape_string($dbc, $_POST['about']);
    $content = mysqli_real_escape_string($dbc, $_POST['content']);
    $category = mysqli_real_escape_string($dbc, $_POST['category']);
    $archive = isset($_POST['archive']) ? 1 : 0;
    $picture = $_FILES['pphoto']['name'];
    
    if ($picture) {
        $target_dir = UPLPATH . $picture;
        move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
        $query = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, slika=?, kategorija=?, arhiva=? WHERE id=?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ssssssi', $title, $about, $content, $picture, $category, $archive, $id);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Vijest je uspješno ažurirana.";
            } else {
                echo "Greška pri ažuriranju vijesti.";
            }
        }
    } else {
        $query = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=? WHERE id=?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'sssssi', $title, $about, $content, $category, $archive, $id);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Vijest je uspješno ažurirana.";
            } else {
                echo "Greška pri ažuriranju vijesti.";
            }
        }
    }
}

$query = "SELECT * FROM vijesti ORDER BY id DESC";
$result = mysqli_query($dbc, $query);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Novine</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <h1>Novine</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Početna</a></li>
            <li><a href="sport.php">Sport</a></li>
            <li><a href="kultura.php">Kultura</a></li>
            <li><a href="unos.php">Unos vijesti</a></li>
            <li><a href="administrator.php">Administracija</a></li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                <li><a href="logout.php">Odjava</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="container">
        <div class="content">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo '<form enctype="multipart/form-data" action="" method="POST">';
                echo '<div class="form-item">';
                echo '<label for="title">Naslov vijesti:</label>';
                echo '<input type="text" name="title" value="' . htmlspecialchars($row['naslov']) . '" required>';
                echo '</div>';
                echo '<div class="form-item">';
                echo '<label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>';
                echo '<textarea name="about" rows="3" maxlength="50" required>' . htmlspecialchars($row['sazetak']) . '</textarea>';
                echo '</div>';
                echo '<div class="form-item">';
                echo '<label for="content">Sadržaj vijesti:</label>';
                echo '<textarea name="content" rows="10" required>' . htmlspecialchars($row['tekst']) . '</textarea>';
                echo '</div>';
                echo '<div class="form-item">';
                echo '<label for="category">Kategorija vijesti:</label>';
                echo '<select name="category" required>';
                echo '<option value="sport" ' . ($row['kategorija'] == 'sport' ? 'selected' : '') . '>Sport</option>';
                echo '<option value="kultura" ' . ($row['kategorija'] == 'kultura' ? 'selected' : '') . '>Kultura</option>';
                echo '</select>';
                echo '</div>';
                echo '<div class="form-item">';
                echo '<label for="pphoto">Slika:</label>';
                echo '<input type="file" name="pphoto" accept="image/*">';
                echo '<br><img src="' . UPLPATH . htmlspecialchars($row['slika']) . '" width="100px">';
                echo '</div>';
                echo '<div class="form-item">';
                echo '<label for="archive">Spremiti u arhivu:</label>';
                echo '<input type="checkbox" name="archive" ' . ($row['arhiva'] ? 'checked' : '') . '>';
                echo '</div>';
                echo '<div class="form-item">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button type="submit" name="update">Izmijeni</button>';
                echo '<button type="submit" name="delete">Izbriši</button>';
                echo '</div>';
                echo '</form>';
            }
            ?>
        </div>
    </div>
    <footer>
        <p>© 2024 Novine</p>
    </footer>
</body>
</html>

