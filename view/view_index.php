<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>IIA</title>
        <link rel="stylesheet" href="css/general.css"/>
    </head>
    <body>
        <h1>IIA</h1>
        <form method="post" action="index.php" enctype="multipart/form-data">
            <div class="error">
                <?php if (isset($TabError['Intitulé']))  echo $TabError['Intitulé'] ;?>
            </div>
            <div>
                <label for="AddPromo">Ajouter une promotion</label>
                <input id="AddPromo" type="text" value="Intitulé" onclick="value=''" name="Intitulé"/>
                <input type="submit" name="OK" value="OK"/>
            </div>
        </form>
        <form method="post" action="index.php" enctype="multipart/form-data">
            <div><?php echo 'Liste des ' . NombrePromo($bdd) . ' promotions de l IIA :'; ?></div>
            <u1><?php AfficherPromo($bdd); ?></u1>
        </form>
    </body>
</html>
