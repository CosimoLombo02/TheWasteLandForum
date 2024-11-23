<?php
require "funzioniUtili.php";
session_start();
//prima controllo se la valutazione non sia gia stata inserita, se cosi fosse allora ne andiamo a modificare solo il valore
$comando = $_POST['tipoValutazione'];

if($comando == 'accordanzaPost') $comando=1;
else $comando = 0;

if(modificaValutazionePost($comando,$_SESSION['username'],$_SESSION['codice'],$_SESSION['codPost'],$_POST['valore']) == false){
    //se sono qui significa che non devo modificare una nuova valutazione ma devo inserire una nuova
    valutaPost($comando,$_SESSION['codPost'],$_SESSION['codice'],date('Y-m-d'),$_POST['valore'],$_SESSION['username']);
    echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
}else{
     echo "<html><head><script>alert(' Valutazione aggiornata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
}

//var_dump($_SESSION); var_dump($_POST);