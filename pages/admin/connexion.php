<?php
    include_once "../../header.php";
    include_once "../../models/admin.php";
    
    if(!empty($_SESSION['user'])){
        header('location:/mini_projet/pages/admin/question.php');
    }
    
    if(isset($_POST['connexion'])){
        extract($_POST);
        $userFound = rechercherAdmin($login, $mdp);
        if($userFound){
            $userSess = ["nom" => $userFound["nom"], "prenom" => $userFound["prenom"]];
            $_SESSION['user'] 	= $userSess;
            header('location:/mini_projet/pages/admin/question.php');
        }else{
            header('location:/mini_projet/pages/admin/connexion.php?error');
        }
    }
?>

<div class="container">
    <h1 class="form-title">Se connecter en Admin</h1>
    <div class="form-content">
        <form class="form-conn" method="post">
            <div class="form-group">
                <img src="../../public/img/icone-user.png">
                <input class="form-control" type="text" name="login" placeholder="Utilisateur">
            </div>
            <div class="form-group">
                <img src="../../public/img/icone-password.png">
                <input class="form-control" type="password" name="mdp" placeholder="Mot de passe">
            </div>
            <button type="submit" name="connexion" class="btn btn-conn">Connexion</button>
        </form>
        <?php if(isset($_GET['error'])){ ?>
            <p class="error">Login ou mot de passe incorrect!</p>
        <?php } ?>
    </div>
</div>