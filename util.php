<?php
// début du document HTML 5
function getDebutHTML(string $title='Title content') : string {
    return "<!doctype html>
    <html lang='fr'>
    <head>
      <meta charset='utf-8'>
      <title>$title</title>
      <link rel='stylesheet' href='Projet.css'>
    </head>
    <body>";
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

function getInputText(array $name){
    $formulaire = "";
    foreach($name as $attribut){
      $formulaire .= "<label> $attribut : <input type='text' name='$attribut' size='15' /></label>";
    }
    return $formulaire;
}

function getInputPassword($attribut){
    $formulaire = "<label> $attribut : <input type='password' name='$attribut' size='15' /></label>";
    return $formulaire;
}

function getInputNumber(array $name){
    $formulaire = "";
    foreach($name as $attribut){
      $formulaire .= "<label><b> $attribut : <input type='number' name='$attribut' size='15' /></label>";
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
        $resu[] = '<table border="2">';
        $attributs = array("Athlète_Id","Nom","Prénom","Nationalité","Sexe","Update","Supprimer");
        foreach($attributs as $att){
            $resu[] .= "<th>$att</th>" ;
        }
        $resu[] .= "</tr>";
        while($ligne = pg_fetch_assoc($ptrQuery)){
            //$numb = 1;
            $resu[] .= "<tr>";
            foreach($ligne as $colonne){
                $resu[] .= "<td>";
                $resu[] .= $colonne." ";
                $resu[] .= "</td>";
            }
            // Add hyperlink columns
            //$id = $numb;
            $id = isset($ligne['Athlète_Id']) ? $ligne['Athlète_Id'] : '';
            //$resu[] .= "<td><a href='updateAth.php?id=$id'>Modif</a></td>";
            $resu[] .= "<td><form method='GET' action='updateAth.php'><input
                            type='hidden' name='id' value='$id'><button
                            type='submit'>Modifier</button></form></td>";

            $resu[] .= "<td><form method='GET' action='SuprimerAth.php'><input
                            type='hidden' name='id' value='$id'><button
                            type='submit'>Supprimer</button></form></td>";
            $resu[] .= "</tr>";
            //$numb++;
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
    //Préparation de la requête
    pg_prepare($ptrDB, 'reqPrepSelectSportAll', $query);
    $ptrQuery = pg_execute($ptrDB, 'reqPrepSelectSportAll', array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border = "2">';
        $attributs = array("Sport Id","Catégorie","Type","Update","Supprimer");
        foreach($attributs as $att){
            $resu[] .= "<th> $att </th>";
        }
        while($ligne = pg_fetch_assoc($ptrQuery)){
            $resu[] .=  "<tr>";
            foreach($ligne as $valeur){
                $resu[] .= "<td>";
                $resu[] .=  $valeur." ";
                $resu[] .= "</td>";
            }
            $id = $ligne['sport_id'];
            $resu[] .= "<td><a href='updateSport.php?id=$id'>Modif</a></td>";
            $resu[] .= "<td><a href='supprimerSport.php?id=$id'>Supprimer</a></td>";
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
    $query = "SELECT Athlète_Nom AS Nom, Athlète_Prénom AS prènom,Athlète_Nationalité AS nationalité, Athlète_Sexe 
                                    AS Sexe, Sport_Catégorie, Sport_Type FROM Athlète NATURAL JOIN Sport NATURAL JOIN Pratique";
    //Preparation de la requete
    pg_prepare($ptrDB,'reqPrepSelectAllPratique',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectAllPratique',array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border = "2">';
        $attributs = array("Nom","Prénom","Nationalité","Sexe","Sport catégorie","Sport type");
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
    $ptrDB = connexion(); $query = "INSERT INTO Athlète VALUES(DEFAULT,$1,$2,$3,$4) RETURNING Athlète_Id";
    pg_prepare($ptrDB,'reqPrepInsertIntoAthlete',$query);
    $result = pg_execute($ptrDB, 'reqPrepInsertIntoAthlete', $athlete);
    $newAthlete = pg_fetch_assoc($result);
    if (!isset($newAthlete['Athlète_Id'])) {
        return array("message" => "Erreur lors de l'insertion de l'athlète dans la base de données");
    }
    return getAthleteById($newAthlete['Athlète_Id']);
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
    return getAllAthlete();
}
// Suppression dans la table Sport
function deleteSport(String $id) {
    $ptrDB = connexion();
    //Preparation de la requete
    $query = 'DELETE FROM Sport WHERE Sport_Id = $1';
    pg_prepare($ptrDB, 'reqPrepDeletSport',$query);
    pg_execute($ptrDB,'reqPrepDeletSport',array($id));
}

//Affichage de l'athlè
function getAthleteByNom(String $nom) : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Athlète WHERE Athlète_Nom = $1";
    // La fonction pg_prepare pour preparer la requete
    pg_prepare($ptrDB,'reqPrepSelectByNom',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectByNom',array($nom));
    if(isset($ptrQuery)){
        //recuperation du tableau associatif avec pg_fetch_assoc dans $resu
        $resu = pg_fetch_row($ptrQuery, 0);
        if(empty($resu)){
            $resu = array("message" => "Nom introuvable : $nom");
        }
    }
    //Liberation de ressource
    pg_free_result($ptrQuery);
    //On ferme la connexion avec pg_close()
    pg_close($ptrDB);
    return $resu;
}
// Formuliare
// A modfier
/*function getFormulaire(array $formu){
    $ptrDB = connexion();
    //Preparation de la requete
    $query = "SELECT Athlète_Nom AS Nom, Athlète_Prénom AS prènom,Athlète_Nationalité AS nationalité, Athlète_Sexe 
    AS Sexe, Sport_Catégorie, Sport_Type FROM Athlète NATURAL JOIN Sport NATURAL JOIN Pratique";
    pg_prepare($ptrDB,'reqDuFormulaire',$query);
    //execution de la requete
    $ptrQuery = pg_execute($ptrDB,'reqDuFormulaire',$formu);
    while ($ligne = pg_fetch_row($ptrQuery)) {
        listeDeroulante($ligne);
    }
}*/
function listeDeroulante(String $req,String $titre, array $att){
    $ptrDB = connexion();
    $query = "SELECT DISTINCT $req FROM Sport";
    pg_prepare($ptrDB,'reqDeLaListeDeroulante',$query);
    $ptrQuery = pg_execute($ptrDB,'reqDuFormulaire',$att);
    $formulaire = "<label for= '$titre'> '$titre'</label><select>";
    foreach($att as $val){
        $formulaire .= "<option value = '$val'> $val </option>";
    }
    $formulaire .= "</select>";
    return $formulaire;
}
?>