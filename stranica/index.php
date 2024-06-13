<?php
include 'connect.php';
define('UPLPATH', 'img/');
session_start();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Početna</title>
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
        <div class="content home-content">
        <h2>Sport</h2>
            <section class="sport">
                
                <div class = "home-vijest">
                <?php
                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='sport' ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<div class="article">';
                   
                    echo '<img src="' . UPLPATH . $row['slika'] . '"class = sport_img>';
                    
                    echo '<div class="media_body">';
                    echo '<h4 class="title">';
                    echo '<a href="clanak.php?id='.$row['id'].'">';
                    echo $row['naslov'];
                    echo '</a></h4>';
                    echo '</div></div>';
                    echo '</article>';
                }
                ?>
                </div>
                <div class =home-vijest>
                <?php
                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='sport' ORDER BY id DESC LIMIT 1,1";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<div class="article">';
                    
                    echo '<img src="' . UPLPATH . $row['slika'] . '"class = sport_img>';
                    
                    echo '<div class="media_body">';
                    echo '<h4 class="title">';
                    echo '<a href="clanak.php?id='.$row['id'].'">';
                    echo $row['naslov'];
                    echo '</a></h4>';
                    echo '</div></div>';
                    echo '</article>';
                }
                ?>
                </div>
                <div class =home-vijest>
                <?php
                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='sport' ORDER BY id DESC LIMIT 2,1";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<div class="article">';
                    
                    echo '<img src="' . UPLPATH . $row['slika'] . '"class = sport_img>';
                    
                    echo '<div class="media_body">';
                    echo '<h4 class="title">';
                    echo '<a href="clanak.php?id='.$row['id'].'">';
                    echo $row['naslov'];
                    echo '</a></h4>';
                    echo '</div></div>';
                    echo '</article>';
                }
                ?>
                </div>
            </section>
            <hr>
            <h2>Kultura</h2>
            <section class="kultura">
                
            <div class = "home-vijest">
                <?php
                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='kultura' ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<div class="article">';
                   
                    echo '<img src="' . UPLPATH . $row['slika'] . '"class = sport_img>';
                    
                    echo '<div class="media_body">';
                    echo '<h4 class="title">';
                    echo '<a href="clanak.php?id='.$row['id'].'">';
                    echo $row['naslov'];
                    echo '</a></h4>';
                    echo '</div></div>';
                    echo '</article>';
                }
                ?>
                </div>
                <div class =home-vijest>
                <?php
                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='kultura' ORDER BY id DESC LIMIT 1,1";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<div class="article">';
                    
                    echo '<img src="' . UPLPATH . $row['slika'] . '"class = sport_img>';
                    
                    echo '<div class="media_body">';
                    echo '<h4 class="title">';
                    echo '<a href="clanak.php?id='.$row['id'].'">';
                    echo $row['naslov'];
                    echo '</a></h4>';
                    echo '</div></div>';
                    echo '</article>';
                }
                ?>
                </div>
                <div class =home-vijest>
                <?php
                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='kultura' ORDER BY id DESC LIMIT 2,1";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<div class="article">';
                    
                    echo '<img src="' . UPLPATH . $row['slika'] . '"class = sport_img>';
                    
                    echo '<div class="media_body">';
                    echo '<h4 class="title">';
                    echo '<a href="clanak.php?id='.$row['id'].'">';
                    echo $row['naslov'];
                    echo '</a></h4>';
                    echo '</div></div>';
                    echo '</article>';
                }
                ?>
                </div>
            </section>
        </div>
    </div>
    <footer>
        <p>© 2024 Novine</p>
    </footer>
</body>
</html>
