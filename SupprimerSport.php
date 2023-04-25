<?php
include_once 'util.php';
include 'monEnv.php';
include 'connexBD.php';
$pageHTML = getDebutHTML("Suppression d'un element dans la table");
//Récuperattion de l'ID de la ligne à supprimer :
$id = $_GET['id'];
if(empty($id)){
	echo "Veuillez renseigner un ID valide";
} else {
	deleteSport($id);
	$tableau = getAllSport();
    foreach($tableau as $ligne){
        $pageHTML .= $ligne;
    }
}
$pageHTML .= "<a href = 'Accueil.php'> Page précédente </a>";
echo $pageHTML;
?>