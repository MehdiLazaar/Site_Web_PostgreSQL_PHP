<?php
include 'util.php';
include 'monEnv.php';
include 'connexBD.php';
include 'insertionAth.php';
insertIntoAthlete($_GET);
getAllAthlete();
?>