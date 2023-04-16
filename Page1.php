<?php
include 'util.php';
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
$pageHTML .= '<p><a href="Page2.php"> Inserer un élément dans le tableau </a></p>';
$pageHTML .= intoBalise("p",'Pour supprimer un élément, veuillez suivre ce lien');
$pageHTML .= '<p><a href="Page4.php"> Supprimer un élément du tableau </a></p>';
$pageHTML .= intoBalise("p",'Pour mettre a jou un élément dans le tableau');
$pageHTML .= '<p><a href="Page5.php"> Update du tableau </a></p>';

$pageHTML .= intoBalise("p",'Le tableau des sport');
$Tableau2 = getAllSport();
foreach($Tableau2 as $ligne){
    $pageHTML .= $ligne;
}
$pageHTML .= intoBalise("p",'Pour inserer un élément, veuillez suivre ce lien');
$pageHTML .= '<p><a href="Avenir.php"> Inserer un élément dans le tableau </a></p>';
$pageHTML .= intoBalise("p",'Pour supprimer un élément, veuillez suivre ce lien');
$pageHTML .= '<p><a href="Avenir.php"> Supprimer un élément du tableau </a></p>';
$pageHTML .= intoBalise("p",'Pour mettre a jou un élément dans le tableau');
$pageHTML .= '<p><a href="Page5.php"> Update du tableau </a></p>';

$pageHTML .= intoBalise("p",'Le tableau pratique');
$Tableau3 = getAllPratique();
foreach($Tableau3 as $ligne){
    $pageHTML .= $ligne;
}
$pageHTML .= getFinHTML();
echo $pageHTML;
?>