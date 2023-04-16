<?php
include_once 'util.php';
include 'monEnv.php';
include 'connexBD.php';
$pageHTML = getDebutHTML("Formulaire");
$pageHTML .= "<form action='Page5.php' method='GET'>";
$pageHTML .= intoBalise("p",'Veuillez choisir les éléments de la table à mettre à jour');
$pageHTML .= intoBalise("label",'Veuillez choisir la catégorie du sport :');

$pageHTML .= getFinHTML();
echo $pageHTML;
?>