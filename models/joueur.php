<?php

function rechercherJoueur($nom, $prenom) {
    if (isset($_COOKIE['joueur'])) {
        foreach ($_COOKIE['joueur'] as $value) {
            $joueur = json_decode($value, true);
            if (strtolower($nom) == strtolower($joueur['nom']) && strtolower($prenom) == strtolower($joueur['prenom'])) {
                return $joueur;
            }
        }
    }
    return false;
}