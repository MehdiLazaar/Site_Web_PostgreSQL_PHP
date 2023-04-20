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
?>