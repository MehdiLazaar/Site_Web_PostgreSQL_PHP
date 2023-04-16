<?php
include 'util.php';
include 'monEnv.php';
include 'connexBD.php';
include 'Page2.php';
insertIntoAthlete($_GET);
getAllAthlete();
?>