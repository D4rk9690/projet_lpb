<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chalets de Rêve</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Oswald:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ff4f8ab1ed.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">
</head>
<body>
<?php 
$currentURL = $_SERVER['PHP_SELF'];
$currentPage = basename($currentURL);
?>
    <header>
        <nav>
            <a class="logo" href="./index.php">
                <img class="logo" src="../images/logo.png" alt="Logo">
            </a>
            <ul>
            <li>
                    <a <?php
                if($currentPage=="index.php"){
                    ?>
                        style="color: rgb(214, 157, 1)"
                    <?php
                }
                ?>class="nav-link" href="./index.php">Accueil</a>
                </li>
                <li>
                    <a <?php
                if($currentPage=="shop.php"){
                    ?>
                        style="color: rgb(214, 157, 1)"
                    <?php
                }
                ?>class="nav-link" href="./shop.php">Nos Chalets</a>
                </li>
                <li>
                    <a                 <?php
                if($currentPage=="contact.php"){
                    ?>
                        style="color: rgb(214, 157, 1)"
                    <?php
                }
                ?> class="nav-link" href="./contact.php">Contact</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="https://www.linkedin.com/company/chalet-nursery/">
                        <i class="fa-brands fa-lg fa-linkedin"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/groups/546749599041947">
                        <i class="fa-brands fa-lg fa-facebook"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </header>