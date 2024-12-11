<?xml version="1.0" encoding="UTF-8"?>
<!--Questa è la pagina scheletro di ogni bacheca personale-->


<!DOCTYPE html>





<head>
    <title> <?php //error_reporting(E_ALL & ~E_WARNING);  //disattiva gli warning, parlarne con Denis
     session_start(); require "funzioniUtili.php"; require "riferimento.php"; echo ritornaTitoloDiscussione($_SESSION['codice']) ?></title> 
    <link rel ="stylesheet" href="../CSS/gestioneSegnalazioni.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <script type="text/javascript" src="../JS/popUp.js"></script>
    <script type="text/javascript" src="../JS/banPerm.js"></script>
</head>
<body>
    <?php  //$_SESSION['codice'] = intval($_SESSION['codDiscussione']); echo '<h1>'.var_dump($_SESSION).'</h1>';
   // $_SESSION['codice'] = $_SESSION['codDiscussione'];
    
    if($_SESSION['username']==ritornaCreatoreDiscussione($_SESSION['codice']) || ritornaRuolo($_SESSION['username'])==1 || sonoModeratore($_SESSION['codice'],$_SESSION['username'])==true){
      $_POST['sC'] = true;
      
       echo '<form action="gestioneSegnalazioniDiscussione.php" method="post">';
       echo '<div class="centrato">';
       if(ritornaRuolo($_SESSION['username'])==0)
       echo '<input class="button1" type="submit" name = "sC" value="Segnalazioni da controllare" />';
      else echo '<input class="button1" type="submit" name = "sC" value="Da controllare senza risalto" />';
       echo '<input class="button1" type="submit" name = "sL" value="Segnalazioni lavorate" />';
       if(ritornaRuolo($_SESSION['username'])==1)
       echo '<input class="button1" type="submit" name = "r" value="Risalto Admin" />';
       echo '<input class="button1" type="submit" name = "b" value="Torna alla discussione" />';
       echo '<input class="button1" type="submit" name = "bac" value="Bacheca Personale" />';
       echo '</div>';
       echo '</form>';
       
      
    }//end if controllo
   /* if(isset($_POST['sL'])){
      echo '';
      unset($_POST['sC']);
   }*/
     ?>

     <div class="colonnaGrandeScroll">
        <?php
        //gestisco ora la pressione del button per le segnalazioni con risalto admin diretto
        //ovvero le segnalazioni che l'admin deve gestire con il bannare 
        if(isset($_POST['r'])){
         unset($_POST['sL']);
         unset($_POST['sC']);
             $sR = contaSegnalazioni($_SESSION['codice'],2);
             if($sR == 0) echo "<p class='testoGenerico'>Nessuna segnalazione con risalto!</p>";
            //se sono qui faccio vedere all'admin tutte le discussioni con risalto
            $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
            $segnalazioni = $doc->getElementsByTagName('segnalazione'); 
           
            
   
            $doc = caricaXML("conseguenzeSegnalazioni.xml","");
            $conseguenzeSegnalazioni = $doc->getElementsByTagName('ConseguenzaSegnalazioni');
            foreach ($segnalazioni as $segnalazione) {
                $codiceS = $segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
            $stato = $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue;
           // if(intval($codiceS)==$_SESSION['codice']){
               // if(trim($stato)=='in lavorazione') echo '<p class="testoGenerico">ciao</p>';
               //echo "sono qui";
            //}
            $risaltoAdmin = $segnalazione->getElementsByTagName('risaltoAdmin')->item(0)->nodeValue;
            if($risaltoAdmin==1 && $codiceS==$_SESSION['codice']){
                $titoloDiscussione = ritornaTitoloDiscussione($_SESSION['codice']);
                $motivo = $segnalazione->getElementsByTagName('motivazione')->item(0)->nodeValue;
                $testoPost = ritornaTestoPostCompleto($segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue,$_SESSION['codice']);
                $nomeUtenteSegnalatore = $segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue;
                $stato = $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue;
                $utenteCreatorePost = $segnalazione->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue;
                
                $data = $segnalazione->getElementsByTagName('data')->item(0)->nodeValue;
                $codicePostSegnalato = $segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue;

                //controlliamo ora le conseguenze della suddetta segnalazione
                if(presenzaConseguenze($segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue)){
                  //mi posiziono alla conseguenza giusta, ovvero quella con codiceSegnalazione = al codcie della segnalazione che abbiamo noi
                  foreach($conseguenzeSegnalazioni as $conseguenzaSegnalazioni){
                      if($conseguenzaSegnalazioni->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue == $segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue){
                        //se sono qui prendo tutti i dati della conseguenza 
                        $versoChi = $conseguenzaSegnalazioni->getElementsByTagName('versoChi')->item(0)->nodeValue;
                        $testoWaring = $conseguenzaSegnalazioni->getElementsByTagName('testoWarning')->item(0)->nodeValue;
                        $descrizioneConseguenza = $conseguenzaSegnalazioni->getElementsByTagName('descrizioneConseguenza')->item(0)->nodeValue;
                        $dataEvasioneSegnalazione = $conseguenzaSegnalazioni->getElementsByTagName('dataEvasioneSegnalazione')->item(0)->nodeValue;
                        $utenteGestore = $conseguenzaSegnalazioni->getElementsByTagName('utenteGestore')->item(0)->nodeValue;
                      }//end if isset conseguenza codice

                  }//end foreach

                }//end if presenzaConseguenze

                      echo "<p class='testoGenerico'>Data : ".$data."</p>";
                    echo "<p class='testoGenerico'>Titolo Discussione : ".$titoloDiscussione."</p>";
                    echo "<p class='testoGenerico'>Utente segnalatore : ".$nomeUtenteSegnalatore.'</p>';
                    echo "<p class='testoGenerico'>Utente creatorePost : ".$utenteCreatorePost.'</p>';
                    echo "<p class='testoGenerico'>Motivo : ".mappingMotivo($segnalazione->getElementsByTagName('motivazione')->item(0)->nodeValue).'</p>';
                    echo "<p class='testoGenerico'>Testo post segnalato : ".ritornaTestoPostCompleto($codicePostSegnalato,$_SESSION['codice'])."</p>";
                     //controllo ora che ci siano file, se ci sono stampo anche quelli a video
                     
                     $listaFile=ritornaFilePost($_SESSION['codice'],intval($codicePostSegnalato));
                     if($listaFile->childElementCount > 0){
                     
                        //se sono qui allora stampo i file in un div dedicato
                        $fileSrcLis = $listaFile->getElementsByTagName('fileSrc');
                        echo "<div style='display: flex; gap: 10px; justify-content: center; align-items: center;'>";
                        foreach($fileSrcLis as $fileSrc){
                           $path ='../FilePostDiscussioni/' .$fileSrc->nodeValue;
                           echo "<div style='width: 300px; height: 300px; overflow: hidden; text-align: center;'>";
                           if (str_contains($fileSrc->nodeValue, '.jpg') || str_contains($fileSrc->nodeValue, '.jpeg') || str_contains($fileSrc->nodeValue, '.png')) {
                               echo "<img src='$path' style='width: 100%; height: 100%; object-fit: cover;' alt='immagine'>";
                          } else {
                          echo "<video style='width: 100%; height: 100%; object-fit: cover;' controls>";
                          echo "<source src='$path' type='video/mp4'>";
                           echo "</video>";
                            }
                           echo "</div>";
   
                        }//end foreach
                        echo '</div>';}

                        if(presenzaConseguenze($segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue)){
                          echo '<div>';
                           echo "<p class='testoGenerico'>Utente gestore  : ".$utenteGestore."</p>";
                           echo "<p class='testoGenerico'>Valutazione : ".$stato."</p>";
                           echo "<p class='testoGenerico'>Data evasione : ".$dataEvasioneSegnalazione.'</p>';
                           if($descrizioneConseguenza != 0)
                           echo "<p class='testoGenerico'>Descrizione conseguenza : ".$descrizioneConseguenza.'</p>';
                           if($versoChi != '')
                           echo "<p class='testoGenerico'>Verso  : ".$versoChi.'</p>';
                           if($testoWaring != '')
                           echo "<p class='testoGenerico'>Testo Warning/Ringraziamento : ".nl2br($testoWaring).'</p>';
                           echo '</div>';
                        }//end if stampa presenza conseguenze 

                        if(ritornaRuolo($_SESSION['username'])==1 && $stato == 'accettata' && presenzaBan($utenteCreatorePost)==false){
                           echo '<form action="gestioneSegnalazioniDiscussione.php" method = "post">';
                           echo '<input type="submit" name = "banna" value = "Banna Utente" class="button1" />';
                           echo "<input type='hidden' name='ucp' value='".$segnalazione->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue."'/>";
                           echo '</form>';


                        }//end if ritornaRuolo
                        //se segnalazione ancora deve essere lavorata allora do la possibilità all'admin di lavorare completamente la segnalazione
                        if($stato == 'in lavorazione'){
                            echo "<form action = 'gestioneSegnalazioniDiscussione.php' method='post'>";
                            echo '<div>';
                        echo "<input  name = 'g' class='button1' type='submit' value='Gestisci'>";
                    echo "<input type='hidden' name='codSeg' value='".$segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue."'/>";
                     echo "<input type='hidden' name='ucp' value='".$segnalazione->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue."'/>";
                    echo "<input type='hidden' name='uSeg' value='".$segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue."'/>";
                    echo "<input type='hidden' name='cpSeg' value='".$segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue."'/>";
                   echo '</div>';
                    echo '</form>'; 

                        }//end if lavorazione



                       

                       

                     echo '<hr />';




            }//end if 
               
            
               
            
                        
                  
            }//end foreach
            
                   




        }//end isset risalto admin



    








        //se premo torna indietro allora torno alla pagina delle discussioni
        if(isset($_POST['b'])){
         header("Location: discussione.php");
        }
        if(isset($_POST['bac'])){
         header("Location: bachecaPersonale.php");
        }
        if(isset($_POST['banna'])){
         $_SESSION['ucp'] = $_POST['ucp'];
         unset($_POST['sC']); $_POST['sL'] = true;
         echo '<div id="overlay"></div>';
         echo '<div id="popup">';
         echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
         echo '<h3>Banna Utente</h3>';
         echo '<form id="popupForm" action="gestioneSegnalazioniDiscussione.php" method="POST" >';
         echo '<label for="data">Data fine ban:</label>';
         echo '<input type="date" class="date" name="data" value="'.date("Y-m-d", strtotime("+1 day")).'" />';
        echo '<input type="submit" class="button" name="invia" value="Invia" />';
         echo '</form>';
         echo '</div>';}//end if banna

         if(isset($_POST['data'])){
            //se sono qui banno l'utente
            bannaUtente($_SESSION['ucp'],$_POST['data']);
            unset($_POST['data']); $_POST['sL'] = true;
            echo "<p class='testoGenerico'><script>alert(' Operazione completata con successo!');</script></p>";
         }


      



         $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
         $segnalazioni = $doc->getElementsByTagName('segnalazione'); 
        
         

         $doc = caricaXML("conseguenzeSegnalazioni.xml","");
         $conseguenzeSegnalazioni = $doc->getElementsByTagName('ConseguenzaSegnalazioni');

         if(isset($_POST['sL'])){
            unset($_POST['sC']);
            $sL = contaSegnalazioni($_SESSION['codice'],1);
             if($sL == 0) echo "<p class='testoGenerico'>Nessuna segnalazione lavorata!</p>";
           

            foreach ($segnalazioni as $segnalazione) {
                $codiceS = $segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
            $stato = $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue;
           // if(intval($codiceS)==$_SESSION['codice']){
               // if(trim($stato)=='in lavorazione') echo '<p class="testoGenerico">ciao</p>';
               //echo "sono qui";
            //}
            if($stato != 'in lavorazione' && $codiceS==$_SESSION['codice']){
                $titoloDiscussione = ritornaTitoloDiscussione($_SESSION['codice']);
                $motivo = $segnalazione->getElementsByTagName('motivazione')->item(0)->nodeValue;
                $testoPost = ritornaTestoPostCompleto($segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue,$_SESSION['codice']);
                $nomeUtenteSegnalatore = $segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue;
                $stato = $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue;
                $utenteCreatorePost = $segnalazione->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue;
                $risaltoAdmin = $segnalazione->getElementsByTagName('risaltoAdmin')->item(0)->nodeValue;
                $data = $segnalazione->getElementsByTagName('data')->item(0)->nodeValue;
                $codicePostSegnalato = $segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue;

                //controlliamo ora le conseguenze della suddetta segnalazione
                if(presenzaConseguenze($segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue)){
                  //mi posiziono alla conseguenza giusta, ovvero quella con codiceSegnalazione = al codcie della segnalazione che abbiamo noi
                  foreach($conseguenzeSegnalazioni as $conseguenzaSegnalazioni){
                      if($conseguenzaSegnalazioni->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue == $segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue){
                        //se sono qui prendo tutti i dati della conseguenza 
                        $versoChi = $conseguenzaSegnalazioni->getElementsByTagName('versoChi')->item(0)->nodeValue;
                        $testoWaring = $conseguenzaSegnalazioni->getElementsByTagName('testoWarning')->item(0)->nodeValue;
                        $descrizioneConseguenza = $conseguenzaSegnalazioni->getElementsByTagName('descrizioneConseguenza')->item(0)->nodeValue;
                        $dataEvasioneSegnalazione = $conseguenzaSegnalazioni->getElementsByTagName('dataEvasioneSegnalazione')->item(0)->nodeValue;
                        $utenteGestore = $conseguenzaSegnalazioni->getElementsByTagName('utenteGestore')->item(0)->nodeValue;
                      }//end if isset conseguenza codice

                  }//end foreach

                }//end if presenzaConseguenze

                      echo "<p class='testoGenerico'>Data : ".$data."</p>";
                    echo "<p class='testoGenerico'>Titolo Discussione : ".$titoloDiscussione."</p>";
                    echo "<p class='testoGenerico'>Utente segnalatore : ".$nomeUtenteSegnalatore.'</p>';
                    echo "<p class='testoGenerico'>Utente creatorePost : ".$utenteCreatorePost.'</p>';
                    echo "<p class='testoGenerico'>Motivo : ".mappingMotivo($segnalazione->getElementsByTagName('motivazione')->item(0)->nodeValue).'</p>';
                    echo "<p class='testoGenerico'>Testo post segnalato : ".ritornaTestoPostCompleto($codicePostSegnalato,$_SESSION['codice'])."</p>";
                     //controllo ora che ci siano file, se ci sono stampo anche quelli a video
                     
                     $listaFile=ritornaFilePost($_SESSION['codice'],intval($codicePostSegnalato));
                     if($listaFile->childElementCount > 0){
                     
                        //se sono qui allora stampo i file in un div dedicato
                        $fileSrcLis = $listaFile->getElementsByTagName('fileSrc');
                        echo "<div style='display: flex; gap: 10px; justify-content: center; align-items: center;'>";
                        foreach($fileSrcLis as $fileSrc){
                           $path ='../FilePostDiscussioni/' .$fileSrc->nodeValue;
                           echo "<div style='width: 300px; height: 300px; overflow: hidden; text-align: center;'>";
                           if (str_contains($fileSrc->nodeValue, '.jpg') || str_contains($fileSrc->nodeValue, '.jpeg') || str_contains($fileSrc->nodeValue, '.png')) {
                               echo "<img src='$path' style='width: 100%; height: 100%; object-fit: cover;' alt='immagine'>";
                          } else {
                          echo "<video style='width: 100%; height: 100%; object-fit: cover;' controls>";
                          echo "<source src='$path' type='video/mp4'>";
                           echo "</video>";
                            }
                           echo "</div>";
   
                        }//end foreach
                        echo '</div>';}

                        if(presenzaConseguenze($segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue)){
                          echo '<div>';
                           echo "<p class='testoGenerico'>Utente gestore  : ".$utenteGestore."</p>";
                           echo "<p class='testoGenerico'>Valutazione : ".$stato."</p>";
                           echo "<p class='testoGenerico'>Data evasione : ".$dataEvasioneSegnalazione.'</p>';
                           if($descrizioneConseguenza != 0)
                           echo "<p class='testoGenerico'>Descrizione conseguenza : ".$descrizioneConseguenza.'</p>';
                           if($versoChi != '')
                           echo "<p class='testoGenerico'>Verso  : ".$versoChi.'</p>';
                           if($testoWaring != '')
                           echo "<p class='testoGenerico'>Testo Warning/Ringraziamento : ".nl2br($testoWaring).'</p>';
                           echo '</div>';
                        }//end if stampa presenza conseguenze 

                        if(ritornaRuolo($_SESSION['username'])==1 && $stato == 'accettata' && presenzaBan($utenteCreatorePost)==false){
                           echo '<form action="gestioneSegnalazioniDiscussione.php" method = "post">';
                           echo '<input type="submit" name = "banna" value = "Banna Utente" class="button1" />';
                           echo "<input type='hidden' name='ucp' value='".$segnalazione->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue."'/>";
                           echo '</form>';


                        }//end if ritornaRuolo

                       

                       

                     echo '<hr />';




            }//end if 
               
            
               
            
                        
                  
            }//end foreach
            
            //echo "<p class='testoGenerico'>$i</p>";
         }//end id isset segnalazioni lavorate 

         if(isset($_POST['sC'])){
         unset($_POST['sL']);
         $sC = contaSegnalazioni($_SESSION['codice'],0);
             if($sC == 0) echo "<p class='testoGenerico'>Nessuna segnalazione da lavorare!</p>";
         $doc = caricaXML('segnalazioni.xml','schemaSegnalazioni.xsd');
         $segnalazioni = $doc->getElementsByTagName('segnalazione');
         foreach($segnalazioni as $segnalazione){
            $codiceS = $segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
            $stato = $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue;
            $nomeUtenteSegnalatore= $segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue;
            $risaltoAdmin = $segnalazione->lastChild->nodeValue; 
            //echo "<p class='testoGenerico'>".$codiceS."</p>";
           // echo '<p class="testoGenerico">'ciao<'/ciao>';
         //  echo "<p class='testoGenerico'>".var_dump($_SESSION)."</p>";
            if($_SESSION['codice']==($codiceS) && $_SESSION['username']!=$nomeUtenteSegnalatore && $risaltoAdmin==0 && ($_SESSION['username']!= $segnalazione->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue)){
               // echo '<p class="testoGenerico">ciao</p>';
               if($stato == 'in lavorazione'){
                $codicePost = $segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue;
                $codiceSegnalazione = $segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue;
                $data = $segnalazione->getElementsByTagName('data')->item(0)->nodeValue;
                $titoloDiscussione = ritornaTitoloDiscussione($segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue);
               
                 //controllo ora che ci siano file, se ci sono stampo anche quelli a video
                 $listaFile=ritornaFilePost($_SESSION['codice'],intval($codicePost));
                 echo "<p class='testoGenerico'>Data : ".$data."</p>";
                    echo "<p class='testoGenerico'>Titolo Discussione : ".$titoloDiscussione."</p>";
                    echo "<p class='testoGenerico'>Utente segnalatore : ".$nomeUtenteSegnalatore.'</p>';
                    //potevamo anche usare direttamente il campo sul file xml piuttosto che la funzione ritornaCreatorePost
                    echo "<p class='testoGenerico'>Utente creatorePost : ".ritornaCreatorePost($codicePost,$_SESSION['codice']).'</p>';
                    echo "<p class='testoGenerico'>Motivo : ".mappingMotivo($segnalazione->getElementsByTagName('motivazione')->item(0)->nodeValue).'</p>';
                    echo "<p class='testoGenerico'>Testo post segnalato : ".ritornaTestoPostCompleto($codicePost,$_SESSION['codice'])."</p>";
                    echo "<div class='sinistra'>";
                    echo "<form action = 'gestioneSegnalazioniDiscussione.php' method='post'>";
                    echo "<input  name = 'g' class='button1' type='submit' value='Gestisci'>";
                    echo "<input type='hidden' name='codSeg' value='".$segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue."'/>";
                     echo "<input type='hidden' name='ucp' value='".$segnalazione->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue."'/>";
                    echo "<input type='hidden' name='uSeg' value='".$segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue."'/>";
                    echo "<input type='hidden' name='cpSeg' value='".$segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue."'/>";
                    echo '</form>'; 
                    echo '</div>'; //chiusura div button gestisci

                    //se sono presenti file li stampo a video
                    if($listaFile->childElementCount > 0){
                        //se sono qui allora stampo i file in un div dedicato
                     $fileSrcLis = $listaFile->getElementsByTagName('fileSrc');
                     echo "<div style='display: flex; gap: 10px; justify-content: center; align-items: center;'>";
                     foreach($fileSrcLis as $fileSrc){
                        $path ='../FilePostDiscussioni/' .$fileSrc->nodeValue;
                        echo "<div style='width: 300px; height: 300px; overflow: hidden; text-align: center;'>";
                        if (str_contains($fileSrc->nodeValue, '.jpg') || str_contains($fileSrc->nodeValue, '.jpeg') || str_contains($fileSrc->nodeValue, '.png')) {
                            echo "<img src='$path' style='width: 100%; height: 100%; object-fit: cover;' alt='immagine'>";
                       } else {
                       echo "<video style='width: 100%; height: 100%; object-fit: cover;' controls>";
                       echo "<source src='$path' type='video/mp4'>";
                        echo "</video>";
                         }
                        echo "</div>";

                     }//end foreach
                     echo '</div>';
                    }
                    echo '<hr />';

               }

            }//end if  codice discussione segnalazione
         }//end foreach discussioni
         

        
        
        
        
        }//end if isset sC

               




               if(isset($_POST['g'])){
                  $_SESSION['uSeg'] = $_POST['uSeg'];
                  $_SESSION['ucp'] = $_POST['ucp'];
                  $_SESSION['codSeg'] = $_POST['codSeg'];
                  $_SESSION['cpSeg'] = $_POST['cpSeg'];
                  //Se sono qui allora faccio partire un div pop up dove sono presenti tutti i dati della discussione
                  //se sono l'admin ho piu funzionalità, come ad esempio il ban dell'utente
                  echo '<div id="overlay"></div>';
    echo '<div id="popup">';
    echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
    echo '<h3>Gestisci</h3>';
    echo '<form id="popupForm" action="insConseguenza.php" method="POST">';
    echo '<label for="valuta">Valuta:</label>';
   
      echo '<select name ="valuta">';
      
  
      echo '<option value="accettata" >Accetta</option>';
      echo '<option value="rifiutata" >Rifiuta</option></select>';

      echo '<label for="nP">Nascondi post:</label>';
      echo '<select name = "nP">';
      echo '<option value="si" >Si</option>';
      echo '<option value="no" >No</option></select>';

      echo '<p class="testoGenerico">Warning/ringraziamento:</p>';
      echo '<textarea rows="10" cols="50" name="w"></textarea><br /><br />';

      
      echo '<label for="sU">Sospendi utente dalla discussione:</label>';
      echo '<select name = "sU">';
      echo '<option value="si" >Si</option>';
      echo '<option value="no" >No</option></select>';

      if(ritornaRuolo($_SESSION['username'])==0){
         echo '<label for="rA">Risalto admin:</label>';
         echo '<select name = "rA">';
         echo '<option value="si" >Si</option>';
         echo '<option value="no" >No</option></select>';
      }
      

      //se sono l'admin ho anche la possibilità di bannare un utente
      if(ritornaRuolo($_SESSION['username'])==1){
         echo '<label for="banP">Banna utente dalla forum:</label>';
         echo '<select name="banP" onchange = "onchangeBanPermanente()">';
         echo '<option value="no" >No</option>';
         echo '<option value="si" >Si</option>';
         echo '</select>';
         echo '<div id="dataBan" style="visibility:hidden;">';
         echo '<input type="date" class="date" name="dataFineBan" value="'.date("Y-m-d", strtotime("+1 day")).'" />';
         echo '</div>';

      }//end if controllo admin 
      
    
     
      
    echo '<input type="submit" class="button" name="invia" value="Invia" />';
    echo '</form>';
    echo '</div>';

               }

               

        ?>

     </div>


    
    
</body>
</html>