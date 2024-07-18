<?php
session_start();

$_SESSION = array();

session_destroy(); //viene distrutta la sessione lato server
setcookie("PHPSESSID",'',time()-1,'/'); //cosi viene eliminato anche il cookie lato client

header("Location: homepage.php"); //si viene reindirizzati all'homepage principale del sito