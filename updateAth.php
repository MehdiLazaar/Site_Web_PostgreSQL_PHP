<?php
include_once 'util.php';
include 'monEnv.php';
include 'connexBD.php';

$pageHTML = getDebutHTML("update d'un element dans la table");

//Récupération de l'ID de la ligne à modifier :
$id = $_GET['id'];

//Récupération des données actuelles de la ligne
$ptrDB = connexion();
$query = "SELECT * FROM Athlète WHERE Athlète_Id = $1";
pg_prepare($ptrDB,'updateTable',$query);
$ptrQuery = pg_execute($ptrDB,'updateTable',array($id));
$ligne = pg_fetch_assoc($ptrQuery);

$pageHTML .= "<form method='POST'>";
$pageHTML .= intoBalise("p",'Formulaire de mise à jour');
$pageHTML .= "<input type='hidden' name='id' value='{$ligne['Athlète_Id']}'>";
$attri = array("Nom","Prénom","Nationalité");
$pageHTML .= getInputText($attri, $ligne);
$valeurs = array("Homme","Femme");
$nomVar = "Sexe";
$pageHTML .= getRadiosFromArray($valeurs,$nomVar);
$pageHTML .= "<label><input type='submit' name='Envoyer' value='Envoyer' /></label>
</form>";

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des valeurs soumises
    $id = $_POST['id'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prénom'];
    $nationalite = $_POST['Nationalité'];
    $sexe = $_POST['Sexe'];
    updateAthlete($id, $nom, $prenom, $nationalite, $sexe);
    $pageHTML .= intoBalise("p",'Le tableau des athletes');
    $Tableau1 = getAllAthlete();
    foreach($Tableau1 as $ligne){
        $pageHTML .= $ligne;
    }
}
$pageHTML .= getFinHTML();
echo $pageHTML;
/*if (isset($ligne['Athlète_Id'])) {
    $pageHTML .= "<input type='hidden' name='id' value='{$ligne['Athlète_Id']}'>";
} else {
    // Gérer le cas où la ligne n'a pas été trouvée
}*/
?>
