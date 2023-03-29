<?php
// début du document HTML 5
function getDebutHTML(string $title='Title content') : string {
    return '<!doctype html>
    <html lang="fr">
    <head>
      <meta charset="utf-8">
      <title>Page d\'accueil</title>
      <link rel="stylesheet" href="Projet.css">
    </head>
    <body>';
}

// fin du document HTML
function getFinHTML(): string {
    return '</body></html>';
}

function intoBalise_v1(string $nomElement, string $contenuElement) : string {
    if ($contenuElement==='') // if (!$contenuElement) ne suffit pas
        $resu ="<$nomElement />";
    else
        $resu = "<$nomElement>$contenuElement</$nomElement>";
    return $resu;
}

function intoBalise(string $nomElement, string $contenuElement,
                    array $params = null) : string {
    $resu = "<$nomElement "; // amorce la construction de la balise ouvrante
    if (isset($params)) { // traite le 3e parametre s'il existe
        foreach ($params as $attribut => $valeur)
            $resu .= $attribut."='$valeur' "; // construit les attributs de la balise HTML
    }
    if ($contenuElement==='')
        $resu .=' />'; // ferme la balise s'il s'agit d'un élément vide
    else
        $resu .= ">$contenuElement</$nomElement>"; // termine la balise ouvrante, intègre le contenu et ferme la balise
    return $resu; // retourne la chaine de caractères construite
}

/*function getInputTextV2(string $nomVar, array $attributs=[]) : string {
    $inputHtml = "<input type='text' name='$nomVar' ";
    //$inputHtml .= getInputValue($nomVar);
    if (!empty($attributs)) {
        foreach ($attributs as $attribut => $valeur)
        $inputHtml.= $attribut."='$valeur' ";
    }
    $inputHtml .= "/>";
    return $inputHtml;
}*/
function getInputText(array $name){
    $formulaire = "";
    foreach($name as $attribut){
      $formulaire .= "<p><b> $attribut : </b><input type='text' name='$attribut' size='15' /></p>";
    }
    return $formulaire;
}

function getInputPassword($attribut){
    $formulaire = "<p><b> $attribut : </b><input type='password' name='$attribut' size='15' /></p>";
    return $formulaire;
}
function getInputNumber(array $name){
    $formulaire = "";
    foreach($name as $attribut){
      $formulaire .= "<p><b> $attribut : </b><input type='number' name='$attribut' size='15' /></p>";
    }
    return $formulaire;
}

// fabrication d'une collection de checkbox HTML à partir d'un tableau de valeurs

function getCheckBoxesFromArray(array $valeurs, string $nomVar): string {
    $lesCheckBoxes = "";
    foreach ($valeurs as $valeur) {
        $lesCheckBoxes .= "$valeur <input type='checkbox' name='$nomVar"."[]' ";
        if (isset($_REQUEST[$nomVar]) && in_array($valeur, $_REQUEST[$nomVar])) {
            $lesCheckBoxes .= "checked='checked' ";
        }
        $lesCheckBoxes .= "value='$valeur'>\n";
    }
    return $lesCheckBoxes;
}

// fabrication d'une collection de boutons radio HTML à partir d'un tableau de valeurs

function getRadiosFromArray(array $valeurs, string $nomVar): string {
    $lesRadios = "";
    foreach ($valeurs as $valeur) {
        $lesRadios .= "$valeur <input type='radio' name='$nomVar' ";
        if (isset($_REQUEST[$nomVar]) && $valeur == $_REQUEST[$nomVar]) {
            $lesRadios .= "checked='checked' ";
        }
        $lesRadios .= "value='$valeur'>\n";
    }
    return $lesRadios;
}
function connexion(){
    $strConnex = 'host='.$_ENV['dbHost'].' dbname='.$_ENV['dbName'].' user='.$_ENV['dbUser'].' password='.$_ENV['dbPassword'];
    $ptrDB = pg_connect($strConnex);
    return $ptrDB;
}

function getAthleteById(String $id) : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Athlète WHERE Athlète_Id = $1";
    // La fonction pg_prepare pour preparer la requete
    pg_prepare($ptrDB,'reqPrepSelectById',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectById',array($id));
    if(isset($ptrQuery)){
        //recuperation du tableau associatif avec pg_fetch_assoc dans $resu
        $resu = pg_fetch_row($ptrQuery, 0);
        if(empty($resu)){
            $resu = array("message" => "Identifiant d'athlète non valide : $id");
        }
    }
    //Liberation de ressource
    pg_free_result($ptrQuery);
    //On ferme la connexion avec pg_close()
    pg_close($ptrDB);
    return $resu;
}
function getSportById(String $id) : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Sport WHERE Sport_Id = $1";
    // La fonction pg_prepare pour preparer la requete
    pg_prepare($ptrDB,'reqPrepSelectSportById',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectSportById',array($id));
    if(isset($ptrQuery)){
        //recuperation du tableau associatif avec pg_fetch_assoc dans $resu
        $resu = pg_fetch_assoc($ptrQuery);
        if(empty($resu)){
            $resu = array("message" => "Identifiant de sport non valide : $id");
        }
    }
    //Liberation de ressource
    pg_free_result($ptrQuery);
    //On ferme la connexion avec pg_close()
    pg_close($ptrDB);
    return $resu;
}
function getAllAthlete() : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Athlète";
    //Preparation de la requete
    pg_prepare($ptrDB,'reqPrepSelectAll',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectAll',array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border = "2">';
        $attributs = array("Athlète Id","Nom","Prénom","Nationalité","Sexe");
        foreach($attributs as $att){
            $resu[] .= "<th> $att </th>";
        }
        $numeroLigne = 0;
        while($ligne = pg_fetch_row($ptrQuery)){
            $resu[] .=  "<tr>";
            foreach($ligne as $colonne){
                $resu[] .= "<td>";
                $resu[] .=  $colonne." ";
                $resu[] .= "</td>";
            }
            $numeroLigne++;
            $resu[] .= "</tr>";
        }
    $resu[] .= "</table>";
}
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}
function getAllSport() : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Sport";
    //Preparation de la requete
    pg_prepare($ptrDB,'reqPrepSelectSportAll',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectSportAll',array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border = "2">';
        $attributs = array("Sport Id","Catégorie","Type");
        foreach($attributs as $att){
            $resu[] .= "<th> $att </th>";
        }
        $numeroLigne = 0;
        while($ligne = pg_fetch_row($ptrQuery)){
            $resu[] .=  "<tr>";
            for($j = 0; $j < count($ligne); $j++){
                $resu[] .= "<td>";
                $resu[] .=  $ligne[$j]." ";
                $resu[] .= "</td>";
            }
            $numeroLigne++;
            $resu[] .= "</tr>";
        }
    $resu[] .= "</table>";
}
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}
function getAllPratique() : array {
    $ptrDB = connexion();
    $query = "SELECT Athlète_Nom, Athlète_Prénom FROM Pratique NATURAL JOIN Sport, Athlète";
    //Preparation de la requete
    pg_prepare($ptrDB,'reqPrepSelectAllPratique',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectAllPratique',array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border = "2">';
        $attributs = array("Athlète_Nom","Athlète_Prénom");
        foreach($attributs as $att){
            $resu[] .= "<th> $att </th>";
        }
        $numeroLigne = 0;
        while($ligne = pg_fetch_row($ptrQuery)){
            $resu[] .=  "<tr>";
            foreach($ligne as $colonne){
                $resu[] .= "<td>";
                $resu[] .=  $colonne." ";
                $resu[] .= "</td>";
            }
            $numeroLigne++;
            $resu[] .= "</tr>";
        }
    $resu[] .= "</table>";
}
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}
//Insertion dans la table Athlete.
function insertIntoAthlete(array $athlete) : array {
    $ptrDB = connexion();
    $query = 'INSERT INTO Athlète VALUES($1,$2,$3,$4,$5)';
    pg_prepare($ptrDB,'reqPrepInsertIntoAthlete',$query);
    pg_execute($ptrDB,'reqPrepInsertIntoAthlete',$athlete);
    return getAthleteById($athlete['Athlète_Id']);
}
//Insertion dans la table Sport.
function insertIntoSport(array $spt) : array {
    $ptrDB = connexion();
    $query = 'INSERT INTO Sport VALUES($1,$2,$3)';
    pg_prepare($ptrDB,'reqPrepInsertIntoSport',$query);
    pg_execute($ptrDB,'reqPrepInsertIntoSport',$spt);
    return getSportById($spt['Sport_Id']);
}

//Update de la table Athlète
function updateAthlete(array $Ath) {
    $ptrDB = connexion();
    //Preparation de la requete
    $query = 'UPDATE Athlète SET Athlète_Nom = $2; Athlète_Prénom = $3, Athlète_Nationalité = $4, Athlète_Sexe = $5 WHERE Athlète_Id = $1';
    pg_prepare($ptrDB,'reqUpdateAthlete',$query);
    //execution de la requete
    pg_execute($ptrDB,'reqUpdateAthlete',$Ath);
    return getAthleteById($Ath['Athlète_Id']);
}

//Update de la table Sport
function updateSport(array $spt) {
    $ptrDB = connexion();
    //Preparation de la requete
    $query = 'UPDATE Sport SET Sport_Catégorie = $2; Sport_Type = $3 WHERE Sport_Id = $1';
    pg_prepare($ptrDB,'reqUpdateSport',$query);
    //execution de la requete
    pg_execute($ptrDB,'reqUpdateSport',$spt);
    return getSportById($spt['Sport_Id']);
}
// Suppression dans la table Athlete
function deleteAthlete(String $id) {
    $ptrDB = connexion();
    //Preparation de la requete
    $query = 'DELETE FROM Athlète WHERE Athlète_Id = $1';
    pg_prepare($ptrDB, 'reqPrepDeletAthlete',$query);
    pg_execute($ptrDB,'reqPrepDeletAthlete',array($id));
}
// Suppression dans la table Sport
function deleteSport(String $id) {
    $ptrDB = connexion();
    //Preparation de la requete
    $query = 'DELETE FROM Sport WHERE Sport_Id = $1';
    pg_prepare($ptrDB, 'reqPrepDeletSport',$query);
    pg_execute($ptrDB,'reqPrepDeletSport',array($id));
}
?>