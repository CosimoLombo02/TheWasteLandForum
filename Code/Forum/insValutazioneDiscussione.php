<?php
session_start();
require "funzioniUtili.php";
if($_POST['tipoValutazione']=='spoiler'){
    $comando = 0;
}else{
    if($_POST['tipoValutazione']=='accordanza'){
        $comando = 1;
    }else{
        if($_POST['tipoValutazione']=='utilita'){
            $comando = 2;
        }
    }
}

if(presenzaValutazioneDiscussione($comando,$_SESSION['username'],$_POST['valore'],$_SESSION['codice'])){
    echo "<html><head><script>alert(' Valutazione aggiornata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
}else{
    inserisciValutazioneDiscussione($comando,$_SESSION['codice'],date('Y-m-d'),$_POST['valore'],$_SESSION['username']);
    echo "<html><head><script>alert(' Operazione effettuata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
}