<?php 
require "funzioniUtili.php";
session_start();
/*var_dump($_FILES);
var_dump($_SESSION);*/
if($_SESSION['flagPost']==0){
    inserisciPost($_SESSION['codice'],$_SESSION['username'],date('Y-m-d'),date('H:i:s'),$_SESSION['creatorePost'],$_POST['testo']);
header("Location:discussione.php");
}else{
    unset($_SESSION['flagPost']);
    inserisciPost($_SESSION['codice'],$_SESSION['username'],date('Y-m-d'),date('H:i:s'),'',$_POST['testo']);
    echo "<html><head><script>alert(' Operazione completata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";

}

