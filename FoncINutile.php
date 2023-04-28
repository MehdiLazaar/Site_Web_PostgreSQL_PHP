<?php
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
            $resu[] .= "<tr>";
            foreach($ligne as $colonne){
                $resu[] .= "<td>";
                $resu[] .= $colonne." ";
                $resu[] .= "</td>";
            }
            // Add hyperlink columns
            $id = isset($ligne['Athlète_Id']) ? $ligne['Athlète_Id'] : '';
            $resu[] .= "<td><a href='updateAth.php?id=$id'>Modif</a></td>";
            $resu[] .= "<td><a href='SuprimerAth.php?id=$id'>Supprimer</a></td>";
            $resu[] .= "</tr>";
        }
        $resu[] .= "</table>";
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}


/*function getAllSportTypes() {
    $ptrDB = connexion();
    //La requete
    $query = "SELECT DISTINCT Sport_Type FROM Sport";
    //retourne un objet ressource qui représente le résultat de la requête.
    //Cet objet ressource peut ensuite être utilisé pour récupérer les données retournées par la //requête
    $result = pg_query($ptrDB, $query);
    $sportTypes = [];
    while ($row = pg_fetch_assoc($result)) {
        $sportTypes[] = $row['Sport_Type'];
    }
    return $sportTypes;
}*/

/*function getAllAthlete() : array {
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
}*/



/*function getAllSport() : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Sport";
    //Preparation de la requete
    pg_prepare($ptrDB,'reqPrepSelectSportAll',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectSportAll',array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border = "2">';
        $attributs = array("Sport Id","Catégorie","Type","Update","Supprimer");
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
            $id = $ligne[0];
            $resu[] .= "<td><a href='updateSport.php?id=$id'>Modif</a></td>";
            $resu[] .= "<td><a href='supprimerSport.php?id=$id'>Supprimer</a></td>";
            $resu[] .= "</tr>";
        }
    $resu[] .= "</table>";
}
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}*/
/*function getAllAthlete() : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Athlète";
    //Preparation de la requete
    pg_prepare($ptrDB,'reqPrepSelectAll',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectAll',array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border="2">';
        $attributs = array("Athlète Id","Nom","Prénom","Nationalité","Sexe","Update","Supprimer");
        foreach($attributs as $att){
            $resu[] .= "<th>$att</th>" ;
        }
        $resu[] .= "</tr>";
        while($ligne = pg_fetch_row($ptrQuery)){
            $resu[] .= "<tr>";
            foreach($ligne as $colonne){
                $resu[] .= "<td>";
                $resu[] .= $colonne." ";
                $resu[] .= "</td>";
            }
            // Add hyperlink column for update
            $id = $ligne[0];
            $resu[] .= "<td><a href='updateAth.php?id=$id'>Modif</a></td>";
            // Add hyperlink column for delete
            $resu[] .= "<td><a href='delete.php?id=$id'>Suppr</a></td>";
            $resu[] .= "</tr>";
        }
        $resu[] .= "</table>";
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}*/




/*
function getAllSport() : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Sport";
    //Preparation de la requete
    pg_prepare($ptrDB,'reqPrepSelectSportAll',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectSportAll',array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border = "2">';
        $attributs = array("Sport Id","Catégorie","Type","Update");
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
}*/

/*function getAllAthlete() : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Athlète";
    //Preparation de la requete
    pg_prepare($ptrDB,'reqPrepSelectAll',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectAll',array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border = "2">';
        $attributs = array("Athlète Id","Nom","Prénom","Nationalité","Sexe","Update");
        foreach($attributs as $att){
            $resu[] .= "<th> $att </th>" ;
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
}*/
/*
function getAllAthlete() : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM Athlète";
    //Preparation de la requete
    pg_prepare($ptrDB,'reqPrepSelectAll',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectAll',array());
    $resu = array();
    if($ptrQuery){
        $resu[] = '<table border="2">';
        $attributs = array("Athlète_Id","Nom","Prénom","Nationalité","Sexe","Update");
        foreach($attributs as $att){
            $resu[] .= "<th>$att</th>" ;
        }
        $resu[] .= "</tr>";
        while($ligne = pg_fetch_row($ptrQuery)){
            $resu[] .= "<tr>";
            foreach($ligne as $colonne){
                $resu[] .= "<td>";
                $resu[] .= $colonne." ";
                $resu[] .= "</td>";
            }
            // Add hyperlink column
            $id = $ligne[0];
            $resu[] .= "<td><a href='updateAth.php?Athlète_Id=$id'>Modif</a></td>";
            $resu[] .= "</tr>";
        }
        $resu[] .= "</table>";
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}*/

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

/*function insertIntoAthlete(array $athlete) : array {
    $ptrDB = connexion();
    $query = 'INSERT INTO Athlète VALUES(DEFAULT,$2,$3,$4,$5)';
    pg_prepare($ptrDB,'reqPrepInsertIntoAthlete',$query);
    pg_execute($ptrDB,'reqPrepInsertIntoAthlete',$athlete);
    return getAthleteById($athlete['Athlète_Id']);
}*/
/*function insertIntoAthlete(array $athlete) : array {
    $ptrDB = connexion();
    $query = 'INSERT INTO Athlète(Athlète_Id,Athlète_Nom,Athlète_Prénom,Athlète_Nationalité,Athlète_Sexe) VALUES(DEFAULT,$2,$3,$4,$5) RETURNING Athlète_Id';
    pg_prepare($ptrDB,'reqPrepInsertIntoAthlete',$query);
    $result = pg_execute($ptrDB, 'reqPrepInsertIntoAthlete', $athlete);
    $newAthlete = pg_fetch_assoc($result);
    return getAthleteById($athlete['Athlète_Id']);
}*/
/*function insertIntoAthlete(array $athlete) : array {
    $ptrDB = connexion();
    $query = "INSERT INTO Athlète VALUES(DEFAULT,$1,$2,$3,$4) RETURNING Athlète_Id";
    $result = pg_prepare($ptrDB,'reqPrepInsertIntoAthlete',$query);
    $newAthlete = pg_fetch_assoc($result);
    return getAthleteById($newAthlete['Athlète_Id']);
}*/

/*function insertIntoAthlete(array $athlete) : array { 
    $ptrDB = connexion();
    $queryAthlete = 'INSERT INTO Athlète VALUES($1,$2,$3,$4,$5)';
    $queryPratique = 'INSERT INTO Pratique VALUES($1,$2,$3)';
    // Préparation des requêtes
    pg_prepare($ptrDB,'reqPrepInsertIntoAthlete',$queryAthlete);
    pg_prepare($ptrDB,'reqPrepInsertIntoPratique',$queryPratique);
    // Exécution des requêtes
    pg_execute($ptrDB,'reqPrepInsertIntoAthlete',$athlete);
    pg_execute($ptrDB,'reqPrepInsertIntoPratique', array($athlete['Athlète_Id'],$athlete['Pratique_Id'], $athlete['Niveau'])); 
    return getAthleteById($athlete['Athlète_Id']);
}*/ 

/*function getSportIdByCategoryAndType(string $category, string $type): ?int {
    $ptrDB = connexion();
    $query = "SELECT Sport_Id FROM Sport WHERE Sport_Catégorie = $1 AND Sport_Type = $2";
    pg_prepare($ptrDB, 'reqGetSportIdByCategoryAndType', $query);
    $result = pg_execute($ptrDB, 'reqGetSportIdByCategoryAndType', [$category, $type]);
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return intval($row['Sport_Id']);
    } else {
        return null;
    }
}*/

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
/*function listeDeroulante(String $req,String $titre, array $att){
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
}*/

/*function insertIntoAthlete(array $athlete) : array {
    $ptrDB = connexion(); $query = "INSERT INTO Athlète VALUES(DEFAULT,$1,$2,$3,$4) RETURNING Athlète_Id";
    pg_prepare($ptrDB,'reqPrepInsertIntoAthlete',$query);
    $result = pg_execute($ptrDB, 'reqPrepInsertIntoAthlete', $athlete);
    $newAthlete = pg_fetch_assoc($result);
    if (!isset($newAthlete['Athlète_Id'])) {
        return array("message" => "Erreur lors de l'insertion de l'athlète dans la base de données");
    }
    return $athleteId = getAthleteById($newAthlete['Athlète_Id']);
} */
/*function insertIntoAthlete(array $athlete) : array {
    $ptrDB = connexion();
    $query = "INSERT INTO Athlète VALUES(DEFAULT,$1,$2,$3,$4) RETURNING Athlète_Id";
    pg_prepare($ptrDB,'reqPrepInsertIntoAthlete',$query);
    $result = pg_execute($ptrDB, 'reqPrepInsertIntoAthlete', $athlete);
    $newAthlete = pg_fetch_row($result);
    if (!$newAthlete) {
        return array("message" => "Erreur lors de l'insertion de l'athlète dans la base de données");
    }
    return $athleteId = $newAthlete[0];
}*/

/*function getAllAthlete() : array {
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
            $id = $ligne['Athlète_Id'];
            $resu[] .= "<tr>";
            foreach($ligne as $colonne){
                $resu[] .= "<td>";
                $resu[] .= $colonne." ";
                $resu[] .= "</td>";
            }
            // Add hyperlink columns
            $resu[] .= "<td><form method='GET' action='updateAth.php'><input
                            type='hidden' name='id' value='$id'><button
                            type='submit'>Modifier</button></form></td>";

            $resu[] .= "<td><form method='GET' action='SuprimerAth.php'><input
                            type='hidden' name='id' value='$id'><button
                            type='submit'>Supprimer</button></form></td>";
            $resu[] .= "</tr>";
        }
        $resu[] .= "</table>";
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}*/

/*function getSportID(string $sportcategory, string $sporttype){
    $ptrDB = connexion();
    $query = "SELECT Sport_Id FROM Sport WHERE Sport_Catégorie = $1 AND Sport_Type = $2";
    pg_prepare($ptrDB, 'reqgetSportID', $query);
    $result = pg_execute($ptrDB, 'reqgetSportID', [$sportcategory, $sporttype]);
    return $result;
}*/
/*function getSportID(array $spCatTyp) {
    $ptrDB = connexion();
    $query = "SELECT Sport_Id FROM Sport WHERE Sport_Catégorie = $1 AND Sport_Type = $2";
    pg_prepare($ptrDB, 'reqgetSportID', $query);
    $result = pg_execute($ptrDB, 'reqgetSportID', [$spCatTyp['Sport_Catégorie'], $spCatTyp['Sport_Type']]);
    return $result;
}*/
?>