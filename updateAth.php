<?php
include_once 'util.php';
include 'monEnv.php';
include 'connexBD.php';

$pageHTML = getDebutHTML("update d'un element dans la table");

//Récuperattion de l'ID de la ligne à modifier :
$id = $_GET['id'];
// intval() prend une valeur en argument et retourne sa valeur numérique entière.
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
//Récupération des données actulle de la ligne
$ptrDB = connexion();
$query = "SELECT * FROM Athlète WHERE id = $id";
pg_prepare($ptrDB,'updateDeLaligneSelec',$query);
$ptrQuery = pg_execute($ptrDB,'updateDeLaligneSelec',array($id));
$ligne = pg_fetch_assoc($ptrQuery);

$pageHTML .= "<form method='POST'>";
$pageHTML .= intoBalise("p",'Formulaire de mise à jour');
$pageHTML .= "<input type='hidden' name='id' value='{$ligne['id']}'>";
$attri = array("Nom","Prenom","Nationalité");
$pageHTML .= getInputText($attri);
$valeurs = array("Homme","Femme");
$nomVar = "Sexe";
$pageHTML .= getRadiosFromArray($valeurs,$nomVar);
$pageHTML .= "<label><input type='submit' name='Envoyer' value='Envoyer' /></label>
</form>";

// traiter le formulaire de mise à jour
/*La première ligne vérifie que la méthode de requête utilisée est POST.
Si c'est le cas, cela signifie que le formulaire a été soumis et que les données ont été envoyées. */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // récupérer les valeurs soumises
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nationalite = $_POST['nationalite'];
    updateAthlete($_POST);
    $pageHTML .= intoBalise("p",'Le tableau des athletes');
    $Tableau1 = getAllAthlete();
    foreach($Tableau1 as $ligne){
    $pageHTML .= $ligne;
    }
}
$pageHTML .= getFinHTML();
echo $pageHTML;
?>