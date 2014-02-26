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
    if (isset($_POST['OK2']) == TRUE)
    {
        // Si nom et prénom ok
        if ($_POST['Prenom'] !== '' && $_POST['Nom'] !== '' && $_POST['Prenom'] !== 'Prenom' && $_POST['Nom'] !== 'Nom')
        {
            AjouterEleve($bdd, $_POST['idPromo']);  
            $_GET['p'] = $_POST['idPromo'];
            ScriptAjout();
        }
        else
        {
            $TabError['NomPrenom'] = 'Nom ou Prenom incorrect';
            $_GET['p'] = $_POST['idPromo'];
        }
    }
    // Si l'utilisateur à cliquer sur une croix supprimer pour etudiant
    if (isset($_POST['SupprimerEleve']) == TRUE)
    {
        // On supprime l'élève correspondant à l'id
        SupprimerEleve($bdd, $_POST['SupprimerEleve']);
        $_GET['p'] = $_POST['idPromo'];
    }
    
    
}

require 'G:\Cours\HTML-CSS-Php\TP3\view\view_etudiant.php';


