<?php
session_start();
require "funzioniUtili.php";
/*
if(isset($_SESSION['codice']) && isset($_POST['codPost'])){
    OperaSuPost(1,$_SESSION['codice'],$_POST['codPost']);
    //echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
var_dump($_SESSION['codice']); var_dump($_POST['codPost']);
}else echo "ciao";*/

if(isset($_SESSION["username"]) && isset($_SESSION["codPost"])){
    var_dump($_SESSION);
    OperaSuPost(1,$_SESSION['codice'],$_SESSION['codPost']);
    echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
}
