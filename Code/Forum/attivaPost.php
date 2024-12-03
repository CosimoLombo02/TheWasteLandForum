<?php
session_start();
require "funzioniUtili.php";

if(isset($_POST['post'])){
    OperaSuPost(0,$_SESSION['codice'],$_POST['post']);
    echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='discussione.php'</script></head><body></body></html>";
}else{
    echo "<html><head><script>alert('Operazione non valida!'); window.location.href='discussione.php'</script></head><body></body></html>";
}