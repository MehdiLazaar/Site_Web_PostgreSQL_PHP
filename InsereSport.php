<?php
include_once 'util.php';
include 'monEnv.php';
include 'connexBD.php';
$pageHTML = getDebutHTML("Insertion dnas la table athlète");
$pageHTML .= "<form method='GET'>";
$pageHTML .= getInputNumber([" Sport_Id"]);
$attri = array("Sport_Catégorie","Sport_Type");
$pageHTML .= getInputText($attri);
$pageHTML .= "<p><input type='submit' name='Envoyer' value='Envoyer' /></p>
</form>";
if (isset($_GET['Envoyer'])) {
    array_pop($_GET); // supprimer le bouton Envoyer de $_GET
    $Id = $_GET['Sport_Id'];
    $Categorie = $_GET['Sport_Catégorie'];
    $Type = $_GET['Sport_Type'];
    insertIntoSport($_GET);
    $tableau = getAllSport();
    foreach($tableau as $ligne){
        $pageHTML .= $ligne;
    }
    if (empty($Id) || empty($Categorie) || empty($Type)) {
        $erreur = "Veuillez remplir tous les champs.";
        echo $erreur;
    }
}
$pageHTML .= "<a href = 'Page1.php'> Page précédente </a>";
$pageHTML .= getFinHTML();
echo $pageHTML;
?>