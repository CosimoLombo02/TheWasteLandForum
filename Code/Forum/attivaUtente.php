<?php

session_start();
require "funzioniUtili.php";

if(isset($_POST['nomeUtente'])){
    attivaUtente($_SESSION['codice'],$_POST['nomeUtente']);
    echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
}else{
    echo "<html><head><script>alert('Operazione non valida!'); window.location.href='discussione.php'</script></head><body></body></html>";
}