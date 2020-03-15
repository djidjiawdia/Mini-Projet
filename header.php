<?php

    // Définit les cookies
    setcookie('joueur[0]', json_encode(["nom" => "Diaw", "prenom" => "Djiadji", "score" => 0]), time()+3600);
    setcookie('joueur[1]', json_encode(["nom" => "Wone", "prenom" => "Maina", "score" => 0]), time()+3600);
    setcookie('joueur[2]', json_encode(["nom" => "Guisse", "prenom" => "Ismaila", "score" => 0]), time()+3600);
    setcookie('joueur[3]', json_encode(["nom" => "Cisse", "prenom" => "Samba", "score" => 0]), time()+3600);
    setcookie('joueur[4]', json_encode(["nom" => "Sall", "prenom" => "Macky", "score" => 0]), time()+3600);

    session_start();
    if(isset($_GET['deconnexion'])){
        $_SESSION['user'] = [];
        unset($_SESSION['user']);
        $_SESSION['joueur'] = [];
        unset($_SESSION['joueur']);
        header('location:/mini_projet/');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Projet</title>
    <link rel="stylesheet" href="/mini_projet/public/css/style.css">
</head>
<body>
    <nav>
        <ul>
            <?php if(empty($_SESSION['user']) && empty($_SESSION['joueur'])){ ?>
                <li><a class="nav-link" href="/mini_projet/pages/admin/connexion.php">Page Admin</a></li>
                <li><a class="nav-link" href="/mini_projet/pages/joueur/connexion.php">Page Joueur</a></li>
            <?php }else{ ?>
                <li><a class="nav-link" href="?deconnexion">Deconnexion</a></li>
            <?php } ?>
        </ul>
    </nav>
    
    