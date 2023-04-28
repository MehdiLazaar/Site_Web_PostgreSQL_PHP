<?php
include_once 'util.php';
include 'monEnv.php';
include 'connexBD.php';
//Récupération de l'ID de la ligne à modifier :
$pageHTML = getDebutHTML("Suppression dnas la table athlète");
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	deletePratique($id);
	deleteAthlete($id);
	$pageHTML .= intoBalise('p',"Les éléments de la table 'Athlète'");
	$tableau1 = getAllAthlete();
    foreach($tableau1 as $ligne){
        $pageHTML .= $ligne;
    }
	$pageHTML .= intoBalise('p',"Les éléments de la table 'Pratqiue'");
	$tableau2 = getAllAthlete();
    foreach($tableau2 as $ligne){
        $pageHTML .= $ligne;
    }
}
$pageHTML .= "<a href = 'Accueil.php'> Page précédente </a>";
$pageHTML .= getFinHTML();
echo $pageHTML;

?>