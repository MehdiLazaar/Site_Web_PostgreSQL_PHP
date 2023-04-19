<?php
include_once 'util.php';
include 'monEnv.php';
include 'connexBD.php';
$pageHTML = getDebutHTML("Suppression d'un element dans la table");
$pageHTML .= "<form action='SuprimerAth.php' method='GET'>";
$pageHTML .= getInputNumber([" Athlète_Id"]);
$pageHTML .= "<p><input type='submit' name='Envoyer' value='Envoyer' /></p>
</form>";
if(isset($_GET['Envoyer'])){
	array_pop($_GET);
	$Id = $_GET['Athlète_Id'];
	if(empty($Id)){
		echo "Veuillez renseigner un ID valide";
	} else {
		deleteAthlete($Id);
		$tableau = getAllAthlete();
    	foreach($tableau as $ligne){
        	$pageHTML .= $ligne;
    	}
	}
}
$pageHTML .= "<a href = 'Accueil.php'> Page précédente </a>";
echo $pageHTML;
?>