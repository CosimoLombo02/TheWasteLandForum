<?php
session_start();
require "funzioniUtili.php";

if(isset($_SESSION['codice'])){
    if(isset($_POST['utente'])){
        elevaAModeratore($_SESSION['codice'],$_POST['utente']);
        echo "<html><head><script>alert(' Operazione completata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
    }

}