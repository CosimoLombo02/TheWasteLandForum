<?xml version="1.0" encoding="UTF-8"?>
<!--Questa è la pagina scheletro di ogni bacheca personale-->

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> <?php error_reporting(E_ALL & ~E_WARNING);  //disattiva gli warning, parlarne con Denis
     session_start(); require "funzioniUtili.php"; echo ritornaTitoloDiscussione($_SESSION['codice']) ?></title> 
    <link rel ="stylesheet" href="../CSS/gestioneSegnalazioni.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
</head>
<body>
    <?php //var_dump($_SESSION); 
    echo "cio";
    if($_SESSION['username']==ritornaCreatoreDiscussione($_SESSION['codice']) || ritornaRuolo($_SESSION['username'])==1 || sonoModeratore($_SESSION['codice'],$_SESSION['username'])==true){
      
       echo '<div class="centrato">';
       echo '<form action="gestioneSegnalazioniDiscussione.php" method="post">';
       echo '<input class="button1" type="submit" name = "sC" value="Segnalazioni da controllare" />';
       echo '<input class="button1" type="submit" name = "sL" value="Segnalazioni lavorate" />';
       echo '</form>';
       echo '</div>';
      
    }//end if controllo
     ?>

     <div class="colonnaGrandeScroll">
        <?php
         $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
         $segnalazioni = $doc->getElementsByTagName('segnalazioni'); 
         $conta=0; 
         

         $doc = caricaXML("conseguenzeSegnalazioni.xml","");
         $conseguenzeSegnalazioni = $doc->getElementsByTagName('ConseguenzaSegnalazioni');

         if(isset($_POST['sC'])){}//end if isset sC

         foreach($segnalazioni as $segnalazione){
            // echo "<p>Sono qui</p>"; debug
             if($segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$_SESSION['codice']){
                 $conta++;
                 $codicePost = $segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue;
                 $codiceSegnalazione = $segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue;
                 $data = $segnalazione->getElementsByTagName('data')->item(0)->nodeValue;
                 $stato = $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue;
                 $titoloDiscussione = ritornaTitoloDiscussione($segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue);
                 $nomeUtenteSegnalatore= $segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue;
                 if($nomeUtenteSegnalatore == $_SESSION['username']) continue; //salto l'iterazione se la segnalazione è fatta da me
                 if($stato !='accettata' && $stato!='rifiutata'){
                    echo "<p class='testoGenerico'>Data : ".$data."</p>";
                    echo "<p class='testoGenerico'>Titolo Discussione : ".$titoloDiscussione."</p>";
                    echo "<p class='testoGenerico'>Testo post segnalato : ".ritornaTestoPostCompleto($codicePost,$_SESSION['codice'])."</p>";
                    echo "<p>Utente segnalatore : ".$nomeUtenteSegnalatore.'</p>';
                    echo "<p>Utente creatorePost : ".ritornaCreatorePost($codicePost,$_SESSION['codice']).'</p>';
                 }
         
                 
                }//end if isset codice discussione
                }//end foreach
                if($conta == 0) echo '<p>Non ci sono segnalazioni non lavorate</p>';


        ?>

     </div>


    
    
</body>
</html>


