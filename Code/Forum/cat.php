<?php session_start(); require "funzioniUtili.php";
if(isset($_SESSION['codice'])){
    if(isset($_POST['categoriaSottoCategoria'])){
        if($_POST['categoriaSottoCategoria'] == 'altroC'){
           // if(giaInseritaCat($_POST['stc'],$_POST['categoria1']==false)){
           if(giaInseritaCat($_POST['stc'],$_POST['categoria1'])==false){
            inserisciSottocategoria($_POST['stc'],$_POST['categoria1'],$_SESSION['username'],date('Y-m-d'));
           // }
           }
            cambiaCatSottoCat($_POST['categoria1'],$_POST['stc'],$_SESSION['codice']);
            echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='Admin.php'</script></head><body></body></html>";
        }else{
            $dati = explode(':',$_POST['categoriaSottoCategoria']);
            cambiaCatSottoCat($dati[1],$dati[0],$_SESSION['codice']);
            echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='Admin.php'</script></head><body></body></html>";
        }
        if($_POST['categoriaPrecedenteEl']=='si'){
            rimuoviSottoCategoria($_SESSION['sottoC'],$_SESSION['cat']);
            echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='Admin.php'</script></head><body></body></html>";
        }
    }

}//end if isset codice