<?php
include 'connect.php';
define('UPLPATH', 'img/');
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM vijesti WHERE id=$id";
    $result = mysqli_query($dbc, $query);
    
    if ($result) {
        $row = mysqli_fetch_array($result);
    } else {
        die('Error querying database.');
    }
} else {
    die('No article id provided.');
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['naslov']); ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .article-image {
            width: 100%;
            height: auto;
            max-width: 600px;
            display: block;
            margin: 0 auto;
            border-radius: 8px;
        }
    </style>
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
            <li><a href="administracija.php">Administracija</a></li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                <li><a href="logout.php">Odjava</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="container">
        <div class="content article-content">
            <section role="main">
                <div class="row">
                    <h2 class="category">
                        <?php echo "<span>" . htmlspecialchars($row['kategorija']) . "</span>"; ?>
                    </h2>
                    <h1 class="title">
                        <?php echo htmlspecialchars($row['naslov']); ?>
                    </h1>
                    <p>AUTOR:</p>
                    <p>OBJAVLJENO: 
                        <?php echo "<span>" . htmlspecialchars($row['datum']) . "</span>"; ?>
                    </p>
                </div>
                <section class="slika">
                    <?php 
                    $imagePath = UPLPATH . htmlspecialchars($row['slika']);
                    if (file_exists($imagePath)) {
                        echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($row['naslov']) . '" class="article-image">'; 
                    } else {
                        echo '<p>Slika nije pronađena: ' . $imagePath . '</p>';
                    }
                    ?>
                </section>
                <section class="about">
                    <p><?php echo "<i>" . htmlspecialchars($row['sazetak']) . "</i>"; ?></p>
                </section>
                <section class="sadrzaj">
                    <p><?php echo htmlspecialchars($row['tekst']); ?></p>
                </section>
            </section>
        </div>
    </div>
    <footer>
        <p>© 2024 Novine</p>
    </footer>
</body>
</html>


