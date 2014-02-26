<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'library/fonctions.php';

//var_dump($_POST);

$bdd = ConnexionBDD();

// Si tout va bien, on peut continuer
// Si $_POST est pas vide
if (empty($_POST) == FALSE)
{
    // Si l'user à cliquer sur OK
    if (isset($_POST['OK']) == TRUE)
    {
        // Si l'intitulé de la promotion est valide
        if ($_POST['Intitulé'] !== '' && $_POST['Intitulé'] !== 'Intitulé' )
        {
            AjouterPromo($bdd);
            ScriptAjout();
        }
        else
        {
            $TabError['Intitulé'] = 'Intitulé incorrect';
        }        
    }    
    // Si l'utilisateur à cliquer sur une croix supprimer pour promo
    if (isset($_POST['SupprimerPromo']) == TRUE)
    {
        // On supprime la promo correspondante
        SupprimerPromo($bdd, $_POST['SupprimerPromo']);
    }
}


require 'view/view_index.php';