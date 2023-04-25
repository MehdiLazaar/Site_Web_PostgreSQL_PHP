<?php
include_once 'util.php';
include 'monEnv.php';
include 'connexBD.php';
$pageHTML = getDebutHTML("Insertion dnas la table athlète");
$pageHTML .= "<form method='GET'>";
//$pageHTML .= getInputNumber([" Athlète_Id"]);
$attri = array("Nom","Prenom","Nationalité");
$pageHTML .= getInputText($attri);
$valeurs = array("Homme","Femme");
$nomVar = "Sexe";
$pageHTML .= getRadiosFromArray($valeurs,$nomVar);
$pageHTML .= "<p><input type='submit' name='Envoyer' value='Envoyer' /></p>
</form>";
if (isset($_GET['Envoyer'])) {
    array_pop($_GET); // supprimer le bouton Envoyer de $_GET
    //$Id = $_GET['Athlète_Id'];
    /*$Nom = $_GET['Nom'];
    $Prenom = $_GET['Prenom'];
    $Nationalite = $_GET['Nationalité'];
    $Sexe = $_GET['Sexe'];*/
    $athlete = array(
        'Athlète_Nom' => $_GET['Nom'],
        'Athlète_Prénom' => $_GET['Prenom'],
        'Athlète_Nationalité' => $_GET['Nationalité'],
        'Athlète_Sexe' => $_GET['Sexe'],
    );
    insertIntoAthlete($athlete);
    $tableau = getAllAthlete();
    foreach($tableau as $ligne){
        $pageHTML .= $ligne;
    }
    if (empty($_GET['Nom']) || empty($_GET['Prenom']) || empty($_GET['Nationalité']) || empty($_GET['Sexe'])) {
        $erreur = "Veuillez remplir tous les champs.";
        echo $erreur;
    }
}
$pageHTML .= "<a href = 'Accueil.php'> Page précédente </a>";
$pageHTML .= getFinHTML();
echo $pageHTML;
?>