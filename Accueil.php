<?php
include_once 'util.php';
include 'monEnv.php';
include 'connexBD.php';
$pageHTML = getDebutHTML("Page d'accueil");
$pageHTML .= intoBalise("h1","Les tables existantes");

$ptrDB = connexion();
// Verification si connexion établit ou pas
if(!$ptrDB){
    echo "Connexion non établit";
}

$pageHTML .= intoBalise("p",'Le tableau des athletes');
$Tableau1 = getAllAthlete();
foreach($Tableau1 as $ligne){
    $pageHTML .= $ligne;
}
$pageHTML .= intoBalise("p",'Pour inserer un élément, veuillez suivre ce lien');
$pageHTML .= '<p><a href="insertionAth.php"> Inserer un élément dans le tableau </a></p>';


$pageHTML .= intoBalise("p",'Le tableau des sport');
$Tableau2 = getAllSport();
foreach($Tableau2 as $ligne){
    $pageHTML .= $ligne;
}
$pageHTML .= intoBalise("p",'Pour inserer un élément, veuillez suivre ce lien');
$pageHTML .= '<p><a href="InsereSport.php"> Inserer un élément dans le tableau </a></p>';


$pageHTML .= intoBalise("p",'Le tableau pratique');
$Tableau3 = getAllPratique();
foreach($Tableau3 as $ligne){
    $pageHTML .= $ligne;
}
$pageHTML .= getFinHTML();
echo $pageHTML;
?>