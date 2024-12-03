<?php 
session_start(); require "funzioniUtili.php";
if(isset($_POST['inviaNM'])){
    // if(isset($_POST['Media'])) $_SESSION['Media'] = $_POST['Media'];
     cambiaMedia($_POST['MediaNew'],$_SESSION['codice']);
     echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='Admin.php'</script></head><body></body></html>";
     //popUp1('Operazione Riuscita');
     //$_POST['cerca'] = true;
 }