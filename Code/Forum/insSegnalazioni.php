<?php 
session_start();
require "funzioniUtili.php";
//var_dump($_SESSION); var_dump($_POST);
//se la segnalazione è gia presente semplicemente la ignoriamo e non la inseriamo
if(presenzaSegnalazione($_SESSION['username'],$_SESSION['codPost'],$_SESSION['codice'],$_POST['motivo'])==false){
    if(sonoModeratore($_SESSION['codice'],$_SESSION['username'])==true || (ritornaCreatoreDiscussione($_SESSION['codice'])==$_SESSION['username'] && ritornaRuolo($_SESSION['username'])==0)){
        $risaltoAdmin =1;
    } 
    else $risaltoAdmin = 0;
inserisciSegnalazione($_SESSION['username'],date("Y-m-d"),$_SESSION['codPost'],$_SESSION['codice'],$_POST['motivo'],$_SESSION['creatorePost'],$risaltoAdmin);
echo "<html><head><script>alert(' Operazione completata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
}else{
    echo "<html><head><script>alert(' Segnalazione già effettuata!'); window.location.href='discussione.php'</script></head><body></body></html>";
}
