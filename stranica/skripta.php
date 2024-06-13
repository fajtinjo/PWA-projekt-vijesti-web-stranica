<?php
include 'connect.php';
define('UPLPATH', 'img/');

if (!file_exists(UPLPATH)) {
    mkdir(UPLPATH, 0777, true);
}

$picture = $_FILES['pphoto']['name'];
$target_dir = UPLPATH . $picture;
move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

$title = $_POST['title'];
$about = $_POST['about'];
$content = $_POST['content'];
$category = $_POST['category'];
$archive = isset($_POST['archive']) ? 1 : 0;

$query = "INSERT INTO vijesti (naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES ('$title', '$about', '$content', '$picture', '$category', '$archive')";
$result = mysqli_query($dbc, $query) or die('Error querying database.');

mysqli_close($dbc);
header("Location: index.php");
?>

