<?php 
session_start();
require "funzioniUtili.php";
//var_dump($_SESSION); var_dump($_POST);
//se la segnalazione è gia presente semplicemente la ignoriamo e non la inseriamo
if(presenzaSegnalazione($_SESSION['username'],$_SESSION['codPost'],$_SESSION['codice'],$_POST['motivo'])==false){
inserisciSegnalazione($_SESSION['username'],date("Y-m-d"),$_SESSION['codPost'],$_SESSION['codice'],$_POST['motivo'],$_SESSION['creatorePost'],0);
echo "<html><head><script>alert(' Operazione completata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
}else{
    echo "<html><head><script>alert(' Segnalazione già effettuata!'); window.location.href='discussione.php'</script></head><body></body></html>";
}
