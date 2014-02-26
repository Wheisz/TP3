<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Crée et retourne une instance de PDO (objet de connexion à la base de données)
 * @return \PDO
 */
function ConnexionBDD()
{
    try
    {
            return $bdd = new PDO('mysql:host=localhost;dbname=iia', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
}

/**
 * Affiche les élèves d'une promotion
 * @param type $bdd
 * @param type $idPromo
 */
function AfficherElevePromo($bdd, $idPromo) 
{
    $requete = $bdd->prepare('SELECT * FROM eleve WHERE id_promotion = ?');
    $requete->execute(array($idPromo)) or die(print_r($requete->errorInfo()));
    while ($donnees = $requete->fetch())
    {
        echo '<li>' . $donnees['nom_eleve'] . ' ' . $donnees['prenom_eleve'];
        echo ' <input type="image" src="Croix_Rouge_Bis.png" name="SupprimerEleve" value="' . $donnees['id_eleve'] . '" />';
        echo '</li>';
    }
}

/**
 * Ajoute un élève dans la bdd
 * @param type $bdd
 * @param type $idPromo
 */
function AjouterEleve($bdd, $idPromo)
{
    $requete = $bdd->prepare('INSERT INTO eleve (nom_eleve, prenom_eleve, id_promotion) VALUES (?, ?, ?)');
    $requete->execute(array($_POST['Prenom'], $_POST['Nom'], $idPromo)) or die(print_r($requete->errorInfo()));
}

/**
 * Supprime un élève de la bdd
 * @param type $bdd
 * @param type $idEleve
 */
function SupprimerEleve($bdd, $idEleve)
{
    $requete = $bdd->prepare('DELETE FROM eleve WHERE id_eleve = ?');
    $requete->execute(array($idEleve)) or die(print_r($requete->errorInfo()));
}

/**
 * Affiche les promotions ainsi que les listes déroulantes de leurs étudiants
 * @param type $bdd
 */
function AfficherPromo($bdd)
{
    $requete = $bdd->prepare('SELECT * FROM promotion');
    $requete->execute() or die(print_r($requete->errorInfo()));
    while ($donnees = $requete->fetch())
    {
        echo '<li>';
        echo '<a href="etudiant.php?p=' . $donnees['id_promotion'] . '" name="promo">' . $donnees['lib_promotion'] . '</a>';
        echo '<input type="image" src="Croix_Rouge_Bis.png" name="SupprimerPromo" value="' . $donnees['id_promotion'] . '" />';
        echo '</li>';
        ListeDeroulEtudiant($bdd, $donnees['id_promotion']);
    }
}

/**
 * Liste déroulante pour afficher les élèves d'une promotion
 * @param type $bdd
 * @param type $id_promotion
 */
function ListeDeroulEtudiant($bdd, $id_promotion)
{
    $requete = $bdd->prepare('SELECT * FROM eleve');
    $requete->execute() or die(print_r($requete->errorInfo()));
    echo '<select name="etudiant">';
    while ($donnees = $requete->fetch())
    {
        if ($id_promotion == $donnees['id_promotion'])
        {
            echo '<option value="' . $donnees['id_eleve'] . '">' . $donnees['nom_eleve'] . ' ' . $donnees['prenom_eleve'] . '</option>';
        }    
    }
    echo '</select>';
}

/**
 * Ajoute une ligne dans la table promotion
 * @param type $bdd
 */
function AjouterPromo($bdd)
{
    $requete = $bdd->prepare('INSERT INTO promotion (lib_promotion) VALUES (?)');
    $requete->execute(array($_POST['Intitulé'])) or die(print_r($requete->errorInfo()));
}

/**
 * Supprime une promotion de la bdd
 * @param type $bdd
 * @param type $idPromo
 */
function SupprimerPromo($bdd, $idPromo)
{
    $requete = $bdd->prepare('DELETE FROM promotion WHERE id_promotion = ?');
    $requete->execute(array($idPromo)) or die(print_r($requete->errorInfo()));
}

/**
 * Retourne le nombre de promotion
 * @param type $bdd
 * @return type
 */
function NombrePromo($bdd)
{
    $requete = $bdd->prepare('SELECT COUNT(*) FROM promotion');
    $requete->execute() or die(print_r($requete->errorInfo()));
    $donnees = $requete->fetch();
       
    return $donnees['COUNT(*)'];
}

/**
 * Retourn le nombre d'élève d'une promotion
 * @param type $bdd
 * @param type $idPromo
 * @return type
 */
function NombreEleve($bdd, $idPromo)
{
    $requete = $bdd->prepare('SELECT COUNT(*) FROM promotion p, eleve e WHERE e.id_promotion = p.id_promotion AND e.id_promotion = ?');
    $requete->execute(array($idPromo)) or die(print_r($requete->errorInfo()));
    $donnees = $requete->fetch();
       
    return $donnees['COUNT(*)'];
}

/**
 * Retourne le nom d'une promotion en fonction de son id
 * @param type $bdd
 * @param type $idPromo
 * @return type
 */
function GetNomPromo($bdd, $idPromo)
{
    $requete = $bdd->prepare('SELECT lib_promotion FROM promotion WHERE id_promotion = ?');
    $requete->execute(array($idPromo)) or die(print_r($requete->errorInfo()));
    $donnees = $requete->fetch();
       
    return $donnees['lib_promotion'];
}

function ScriptAjout()
{
    alert('Ajout réussi !');
}