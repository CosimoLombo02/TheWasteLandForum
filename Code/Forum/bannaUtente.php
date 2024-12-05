<?php if(isset($_POST['data'])){
    session_start();
    require_once "funzioniUtili.php";
       //se sono qui banno l'utente
       bannaUtente($_SESSION['creatorePost'],$_POST['data']);
       echo "<html><head><script>alert(' Operazione completata con successo!'); window.location.href='gestioneUtenti.php'</script></head><body></body></html>";
    }