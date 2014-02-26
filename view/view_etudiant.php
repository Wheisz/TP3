<?php 
$bdd = ConnexionBDD();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Etudiant</title>
        <link rel="stylesheet" href="css/general.css"/>
    </head>
    <body>
        <form method="post" action="/HTML-CSS-Php/TP3/etudiant.php" enctype="multipart/form-data">
            <div class="error">
                <?php if (isset($TabError['NomPrenom']))  echo $TabError['NomPrenom'] ;?>
            </div>
            <div>
                <label for="AddPromo">Ajouter un étudiant</label>
                <input id="AddPromo" type="text" name="Prenom" value="Prenom" onclick="value=''" />
                <input id="AddPromo" type="text" name="Nom" value="Nom" onclick="value=''"/>
                <input type="hidden" name="idPromo" value="<?php echo $_GET['p'] ?>"/>
                <input type="submit"  name="OK2" value="OK2"/>
            </div>
        </form>
        <form method="post" action="/HTML-CSS-Php/TP3/etudiant.php" enctype="multipart/form-data">
            <div><?php echo 'Liste des ' . NombreEleve($bdd, $_GET['p']) . ' étudiants de la promotion ' . GetNomPromo($bdd, $_GET['p']) . ' :'?></div>
            <?php AfficherElevePromo($bdd, $_GET['p']); ?>
            <input type="hidden" name="idPromo" value="<?php echo $_GET['p'] ?>"/>
        </form>
        <a href="index.php" name="retour">Retour </a>
    </body>
</html>
