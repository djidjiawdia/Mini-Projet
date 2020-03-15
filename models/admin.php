<?php

function rechercherAdmin($login, $mdp) {
    $users = [
        ["nom" => "diaw", "prenom" => "djiadji", "login" => "jahji", "mdp" => "test"],
        ["nom" => "guisse", "prenom" => "Ismaila", "login" => "izo", "mdp" => "test2"],
        ["nom" => "diop", "prenom" => "ngoné", "login" => "ngone", "mdp" => "test3"],
        ["nom" => "cisse", "prenom" => "samba", "login" => "paco", "mdp" => "test4"]
    ];
    foreach($users as $user){
        if (strtolower(trim($login)) == strtolower($user['login']) && $mdp == $user['mdp']) {
			return $user;
		}
    }
    return false;
}