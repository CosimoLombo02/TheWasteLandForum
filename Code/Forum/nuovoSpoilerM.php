<?php
session_start();
require "funzioniUtili.php";
if($_SESSION['codice']){
    if(isset($_POST['categoriaPrecedente']) && $_POST['categoriaPrecedente']=='si'){
        eliminaCategoriaSpoiler($_SESSION['cS']);
        $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('CategoriaSpoiler')->count()>0)
        $catS = $discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue;
        $codiceDiscussione = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($catS == $_SESSION['cS']){
            cambiaCategoriaSpoiler('ricategorizzare',$codiceDiscussione,'0');
        }
       

    }//end foreach

     //qui ora devo salvare le modifiche effettuate 
     if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");

        
    }
}//end if isset si

if(isset($_POST['categorieSpoiler'])){
    if($_POST['categorieSpoiler']=='altroS'){
        if(empty($_POST['csc'])){ //controllo paranoico
            echo "<html><head><script>alert('Dati mancanti!'); window.location.href='Admin.php'</script></head><body></body></html>";
        }
        cambiaCategoriaSpoiler($_POST['csc'],$_SESSION['codice'],$_POST['livelloSpoiler']);
        inserisciCategoriaSpoiler($_POST['csc'],$_SESSION['username'],date('Y-m-d'));
        echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='Admin.php'</script></head><body></body></html>";
    }else{
        cambiaCategoriaSpoiler($_POST['categorieSpoiler'],$_SESSION['codice'],$_POST['livelloSpoiler']);
        echo "<html><head><script>alert('Operazione completata con successo!'); window.location.href='Admin.php'</script></head><body></body></html>";
    }

}//end if isset categorie spoiler





}