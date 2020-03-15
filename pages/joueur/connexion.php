<?php 
    include_once '../../header.php';
    include_once '../../models/joueur.php';

    if(!empty($_SESSION['joueur'])){
        header('location:/mini_projet/pages/joueur/reponse.php');
    }
    
    if(isset($_POST['connexion'])){
        extract($_POST);
        $joueurFound = rechercherJoueur($nom, $prenom);
        if($joueurFound){
            $joueurSess = ["nom" => $joueurFound["nom"], "prenom" => $joueurFound["prenom"]];
            $_SESSION['joueur'] 	= $joueurSess;
            header('location:/mini_projet/pages/joueur/reponse.php');
        }else{
            header('location:/mini_projet/pages/joueur/connexion.php?error');
        }
    }
    
?>

<div class="container">
    <h1 class="form-title">Se connecter en Joueur</h1>
    <div class="form-content">
        <form class="form-conn" method="post">
            <div class="form-group">
                <img src="../../public/img/icone-user.png">
                <input class="form-control" type="text" name="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <img src="../../public/img/icone-user.png">
                <input class="form-control" type="text" name="prenom" placeholder="Prenom">
            </div>
            <button name="connexion" class="btn btn-conn">Connexion</button>
        </form>
        <?php if(isset($_GET['error'])){ ?>
            <p class="error">Nom ou Prenom incorrect!</p>
        <?php } ?>
    </div>
</div>