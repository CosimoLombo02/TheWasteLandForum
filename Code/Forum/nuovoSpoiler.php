<?php
session_start();
require "funzioniUtili.php";

//filtro con trim
if(isset($_POST['csc']) && $_POST['categorieSpoiler']=='altroS'){
    $filtro = $_POST['csc'];
    if(trim($_POST['csc'])==''){
        echo "<html><head><script>alert('Testo vuoto, modifica non effettuata!'); window.location.href='Admin.php'</script></head><body></body></html>";
        die();
    }else{
         $filtro = trim($_POST['csc']);
         $_POST['csc'] =$filtro;
    }

}

if(isset($_SESSION['codice'])){

    if(isset($_POST['categorieSpoiler'])){
        if($_POST['categorieSpoiler']=='altroS'){
            if(isset($_POST['csc']) && !empty($_POST['csc'])){
                //se non è stata già inserita allora la inserisco
                if(giaInseritaSpoiler($_POST['csc']) == false){
                    inserisciCategoriaSpoiler($_POST['csc'],$_SESSION['username'],date('Y-m-d'));
                }
                inserisciSpoilerDiscussione($_SESSION['codice'],$_POST['csc'],$_POST['livelloSpoiler']);
                echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='Admin.php'</script></head><body></body></html>";
                
            }else{ //controllo paranoico
                echo "<html><head><script>alert('Dati mancanti!'); window.location.href='Admin.php'</script></head><body></body></html>";
            }
            
        }else{
            inserisciSpoilerDiscussione($_SESSION['codice'],$_POST['categorieSpoiler'],$_POST['livelloSpoiler']);
            echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='Admin.php'</script></head><body></body></html>";
        }//end else altroS

    }//end if isset categorie spoiler




}//end if isset codice