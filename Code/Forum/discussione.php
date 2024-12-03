<?php
session_start();
require "funzioniUtili.php";
//se sono sospeso non posso accedere a questa discussione
if(sonoSospeso($_SESSION['codice'],$_SESSION['username'])){
    //qui controlliamo la pagina precedente che ha fatto la richiesta http
    //se proveniamo da discussioni.php allora ritorniamo in discussionià
    //altrimenti torniamo in bacheca personale
    //questo perchè solo da queste due pagine nel caso non admin posso accedere alla pagina delle discussioni
    //ricordiamo che ovviamente un admin non puo' essere sospeso da una discussione
    if (isset($_SERVER['HTTP_REFERER'])){
        $precedente = $_SERVER['HTTP_REFERER'];
        if(str_contains($precedente,'discussioni')){
            echo "<html><head><script>alert('Sei stato sospeso dalla discussione!'); window.location.href='discussioni.php'</script></head><body></body></html>";
        }else{
            echo "<html><head><script>alert('Sei stato sospeso dalla discussione!'); window.location.href='bachecapersonale.php'</script></head><body></body></html>";
        }

    }//end if isset referer
}//end if sono sospeso
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo ritornaTitoloDiscussione($_SESSION['codice'])?></title>
    <link rel ="stylesheet" href="../CSS/stilePagDiscussione.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <script type="text/javascript" src="../JS/controllaNumeroFile.js"></script>
    <script type="text/javascript" src="../JS/popUp.js"></script>
</head>
<body>

<?php /* if(isset($_SESSION['username'])){
        
        $username=$_SESSION['username'];
        
                echo "<div class='topnav'><a href='../logout.php'>Logout</a><a href='../homepage.php'>Pagina iniziale</a><a href='forumHP.php'>Forum</a><a href='regGenerali.php'>Regole Generali</a><a href='../fallout1.php'>Fallout 1</a><a href='../fallout2.php'>Fallout 2</a><a href='../fallout3.php'>Fallout 3</a><a href='../fallout4.php'>Fallout 4</a><a href='../falloutT.php'>Fallout Tactics</a><a href='../falloutB.php'>Fallout Brotherhood Of Steel</a><a href='../falloutN.php'>Fallout New Vegas</a><a href='../fallout76.php'>Fallout 76</a><a href='../falloutS.php'>Fallout Serie TV</a><a href='discussioni.php'>Discussioni</a><a href='nuovaDiscussione.php'>Nuova discussione</a><a href='bachecaPersonale.php'>$username</a></div>";
    
            }else{
                
                echo "<div class='topnav'><a href='../reservedArea.php'>Login</a><a href='../homepage.php'>Pagina iniziale</a><a href='forumHP.php'>Forum</a><a href='regGenerali.php'>Regole Generali</a><a href='../fallout1.php'>Fallout 1</a><a href='../fallout2.php'>Fallout 2</a><a href='../fallout3.php'>Fallout 3</a><a href='../fallout4.php'>Fallout 4</a><a href='../falloutT.php'>Fallout Tactics</a><a href='../falloutB.php'>Fallout Brotherhood Of Steel</a><a href='../falloutN.php'>Fallout New Vegas</a><a href='../fallout76.php'>Fallout 76</a><a href='../falloutS.php'>Fallout Serie TV</a><a href='discussioni.php'>Discussioni</a></div>";
    
    
                }//end else 

                */
                require "mostraNavBar1.php";
                
        
                ?>
                 





                <div class="pannelloSinistro"><p class="testoGenerico"><?php 
                if(isset($_SESSION['username'])){
                    //sono loggato quindi ho vari button di gestione
                    echo '<form action="discussione.php" method="post">';
                    echo '<input class="button" type="submit" name = "p" value="Nuovo post" />';
                    if($_SESSION['username'] != ritornaCreatoreDiscussione($_SESSION['codice']))
                    echo '<input class="button1" type="submit" name = "vD" value="Valuta discussione" />';
                    if($_SESSION['username']==ritornaCreatoreDiscussione($_SESSION['codice']) || sonoModeratore($_SESSION['codice'],$_SESSION['username']) || (ritornaRuolo($_SESSION['username'])==1)){
                        echo '<input class="button1" type="submit" name = "sos" value="Sospendi utente" />';
                        echo '<input class="button1" type="submit" name = "att" value="Attiva Utente" />';
                        echo '<input class="button1" type="submit" name = "seg" value="Segnalazioni" />';
                        echo '<input class="button1" type="submit" name = "attP" value="Attiva Post" />';
                    }

                    if($_SESSION['username']==ritornaCreatoreDiscussione($_SESSION['codice']) || (ritornaRuolo($_SESSION['username'])==1)){
                        echo '<input class="button1" type="submit" name = "m" value="Eleva moderatore" />';
                        echo '<input class="button1" type="submit" name = "rm" value="Rimuovi moderatore" />';
                    }

                    if(ritornaRuolo($_SESSION['username'])==1){
                        //eliminata per noi significa nascosta
                        if(statoDiscussione($_SESSION['codice'])!='eliminata')
                        echo '<input class="button1" type="submit" name = "nd" value="Nascondi discussione" />';
                        else echo '<input class="button1" type="submit" name = "nA" value="Attiva discussione" />';

                    }
                    
                    echo '</form>';
                    if(isset($_POST['nA'])){
                        operaSuDiscussione(0,$_SESSION['codice']);
                       // header('Location:discu.php');

                    }
                    if(isset($_POST['nd'])){
                        operaSuDiscussione(1,$_SESSION['codice']);
                       // header('Location:admin.php');

                    }
                    if(isset($_POST['p'])) $_SESSION['flagPost']=1;
                    if(isset($_POST['vD'])){
                        
                    echo '<div id="overlay"></div>';
                     echo '<div id="popup">';
                     echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
                     echo '<h3>Valuta discussione</h3>';
                     echo '<form id="popupForm" action="insValutazioneDiscussione.php" method="POST">';
                     echo '<label for="testo">Valuta per:</label>';
                     echo '<select name ="tipoValutazione"><option value="spoiler">Livello spoiler</option><option value="accordanza">Accordanza</option><option value="utilita">Utilità</option></select>';
                     echo '<select name="valore"><option value="1" >&#9733;&#9734;&#9734;&#9734;&#9734;</option>
                    <option value="2" >&#9733;&#9733;&#9734;&#9734;&#9734;</option>
                    <option value="3" >&#9733;&#9733;&#9733;&#9734;&#9734;</option>
                    <option value="4" >&#9733;&#9733;&#9733;&#9733;&#9734;</option>
                    <option value="5" >&#9733;&#9733;&#9733;&#9733;&#9733;</option></select>';
                     echo '<input type="submit" class="button" name="invia" value="Invia" />';
  
                     echo '</form>';
                    echo '</div>';

                    }//end if isset vD

                    if(isset($_POST['sos'])){
                        echo '<div id="overlay"></div>';
                        echo '<div id="popup">';
                        echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
                        echo '<h3>Sospendi Utente</h3>';
                        echo '<form id="popupForm" action="sospendiUtente.php" method="POST">';
                        echo '<label for="testo">Sospendi:</label>';
                        echo '<select name ="nomeUtente">';
                        $lPost = ritornaPost($_SESSION['codice']);
                        $post = $lPost->getElementsByTagName('post'); //prendo i post (figli di listapost)
                       //admin vede tutti
                       if(ritornaRuolo($_SESSION['username'])==1){
                        foreach($post as $p){
                            $creatorePost = $p->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue;
                         
                            if(sonoSospeso($_SESSION['codice'],$creatorePost)==false && $creatorePost!=$_SESSION['username']){
                               echo "<option value='$creatorePost'>".$creatorePost."</option>";
                              // echo '<option>test</option>';
                            }

                        }//end foreach

                       }//end admin
                       //il creatore della discussione vede tutti tranne che l'admin
                       if($_SESSION['username']==ritornaCreatoreDiscussione($_SESSION['codice']) && ritornaRuolo($_SESSION['username'])==0){
                        foreach($post as $p){
                            $creatorePost = $p->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue;
                         
                            if(sonoSospeso($_SESSION['codice'],$creatorePost)==false && ritornaRuolo($creatorePost)==0 && $creatorePost!=$_SESSION['username']){
                               echo "<option value='$creatorePost'>".$creatorePost."</option>";
                              // echo '<option>test</option>';
                            }

                        }//end foreach
                       }//end creatore discussione

                       //i moderatori eletti invece vedono solo gli utenti normali
                       if(ritornaRuolo($_session['username'])==0 && sonoModeratore($_SESSION['codice'],$_SESSION['username'])==true){
                        if(sonoSospeso($_SESSION['codice'],$creatorePost)==false && ritornaRuolo($creatorePost)==0 && sonoModeratore($_SESSION['codice'],$creatorePost)){
                            echo "<option value='$creatorePost'>".$creatorePost."</option>";
                           // echo '<option>test</option>';
                         }
                       }

                        echo '</select>';
                        echo '<input type="submit" class="button" name="invia" value="Invia" />';
     
                        echo '</form>';
                       echo '</div>';


                    }//end if isset sos

                    if(isset($_POST['att'])){
                        echo '<div id="overlay"></div>';
                        echo '<div id="popup">';
                        echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
                        echo '<h3>Attiva Utente</h3>';
                        echo '<form id="popupForm" action="attivaUtente.php" method="POST">';
                        echo '<label for="testo">Attiva:</label>';
                        echo '<select name ="nomeUtente">';
                        $lPost = ritornaPost($_SESSION['codice']);
                        $post = $lPost->getElementsByTagName('post'); //prendo i post (figli di listapost)
                        
                            //admin vede tutti
                       if(ritornaRuolo($_SESSION['username'])==1){
                        foreach($post as $p){
                            $creatorePost = $p->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue;
                         
                            if(sonoSospeso($_SESSION['codice'],$creatorePost)==true){
                               echo "<option value='$creatorePost'>".$creatorePost."</option>";
                              // echo '<option>test</option>';
                            }

                        }//end foreach

                       }//end admin
                       //il creatore della discussione vede tutti tranne che l'admin
                       if($_SESSION['username']==ritornaCreatoreDiscussione($_SESSION['codice']) && ritornaRuolo($_SESSION['username'])==0){
                        foreach($post as $p){
                            $creatorePost = $p->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue;
                         
                            if(sonoSospeso($_SESSION['codice'],$creatorePost)==true && ritornaRuolo($creatorePost)==0){
                               echo "<option value='$creatorePost'>".$creatorePost."</option>";
                              // echo '<option>test</option>';
                            }

                        }//end foreach
                       }//end creatore discussione

                       //i moderatori eletti invece vedono solo gli utenti normali
                       if(ritornaRuolo($_session['username'])==0 && sonoModeratore($_SESSION['codice'],$_SESSION['username'])==true){
                        if(sonoSospeso($_SESSION['codice'],$creatorePost)==true && ritornaRuolo($creatorePost)==0 && sonoModeratore($_SESSION['codice'],$creatorePost)){
                            echo "<option value='$creatorePost'>".$creatorePost."</option>";
                           // echo '<option>test</option>';
                         }
                       }

                        echo '</select>';
                        echo '<input type="submit" class="button" name="invia" value="Invia" />';
     
                        echo '</form>';
                       echo '</div>';

                    }//end if isset att

                    if(isset($_POST['seg'])){
                        header("Location:gestioneSegnalazioniDiscussione.php");
                    }


                    //ora gestiamo l'attivazione di un post, ricordiamo che i post non vengono eliminati fisicamente dal
                    //file xml ma vengono attivati/disattivati attraverso un flag
                    if(isset($_POST['attP'])){
                        echo '<div id="overlay"></div>';
                        echo '<div id="popup">';
                        echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
                        echo '<h3>Attiva post</h3>';
                        echo '<form id="popupForm" action="attivaPost.php" method="POST">';
                        echo '<label for="testo">Attiva:</label>';
                        echo '<select name ="post">';
                        $lPost = ritornaPost($_SESSION['codice']);
                        $post = $lPost->getElementsByTagName('post'); //prendo i post (figli di listapost)
                        foreach($post as $p){
                            if($p->getElementsByTagName('statoPost')->item(0)->nodeValue=='disattivo'){
                               $cP = $p->getElementsByTagName('codicePost')->item(0)->nodeValue;
                              $data = $p->getElementsByTagName('dataCreazione')->item(0)->nodeValue;
                              $ora = $p->getElementsByTagName('oraCreazione')->item(0)->nodeValue;
                              $testoPost = substr($p->getElementsByTagName('testoPost')->item(0)->nodeValue,0,3);
                              //display semplicemente serve per rendere la select più user friendly
                              $display= $testoPost." ".$data." ".$ora;
                             echo "<option value='$cP'>".$display."</option>";
                            }

                        }//end foreach

                        echo '</select>';
                        echo '<input type="submit" class="button" name="invia" value="Invia" />';
     
                        echo '</form>';
                       echo '</div>';

                    }//end if isset attivaPost

                    //ora vediamo come gestire l'elevazione di un moderatore 
                    if(isset($_POST['m'])){
                        echo '<div id="overlay"></div>';
                        echo '<div id="popup">';
                        echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
                        echo '<h3>Eleva a moderatore</h3>';
                        echo '<form id="popupForm" action="elevaModeratore.php" method="POST">';
                        echo '<label for="testo">Utente:</label>';
                        echo '<select name ="utente">';
                        $lPost = ritornaPost($_SESSION['codice']);
                        $post = $lPost->getElementsByTagName('post'); //prendo i post (figli di listapost)
                        foreach($post as $p){
                            if(ritornaRuolo($p->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue) == 0){
                                if(sonoModeratore($_SESSION['codice'],$p->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue)==false && ritornaCreatoreDiscussione($_SESSION['codice'])!=$p->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue){
                                   $value = $p->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue;
                                   echo "<option value='$value'>".$value."</option>";
                                }//end if sono moderatore
                            }//end if ritorna ruolo

                        }//end foreach

                        echo '</select>';
                        echo '<input type="submit" class="button" name="invia" value="Invia" />';
     
                       
                        echo '</form>';
                        echo '</div>';

                    }//end if isset m


                    //ora invece gestiamo la rimozione di un moderatore
                    if(isset($_POST['rm'])){
                        echo '<div id="overlay"></div>';
                        echo '<div id="popup">';
                        echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
                        echo '<h3>Rimuovi Moderatore</h3>';
                        echo '<form id="popupForm" action="rimuoviModeratore.php" method="POST">';
                        echo '<label for="testo">Rimuovi:</label>';
                        echo '<select name ="utente">';
                        $mod = ritornaModeratoriEletti($_SESSION['codice']);
                        $moder = $mod->getElementsByTagName('nomeUtenteModeratore');
                        foreach($moder as $m){
                            $value = $m->nodeValue;
                            echo "<option value='$value'>".$value."</option>";
                        }

                        echo '</select>';
                        echo '<input type="submit" class="button" name="invia" value="Invia" />';
     
                       
                        echo '</form>';
                        echo '</div>';

                    }//end if isset rimozione moderatori


                }else{
                    echo "<p class='testoGenerico'>Per poter interagire con la discussione devi essere loggato.</p>";
                    echo "<a href='../reservedArea.php'><button class='button'>Login</button></a>";
                }//end else
                
                ?><!--</p>--></div>
            <div class="pannelloDestro">
                <h1><?php echo ritornaTitoloDiscussione($_SESSION['codice'])?></h1>
                
                <?php
                
                //require "../connection.php";
                $listaPost = ritornaPost($_SESSION['codice']);
                if($listaPost->childNodes->count()==0) {
                    echo "<h1>Discussione senza post</h1>";
                }else{
                    //se entro qui significa che la discussione ha dei post
                    $postD = $listaPost->getElementsByTagName('post'); //prendo i post (figli di listapost)
                    foreach($postD as $post){
                        $statoPost = $post->getElementsByTagName('statoPost')->item(0)->nodeValue;
                        if($statoPost == "disattivo") continue; //salto e vado all'iterazione successiva se il post non è attivo
                        $utenteDestRisposta="";

                        
                        $creatorePost = $post->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue;
                        $data = $post->getElementsByTagName('dataCreazione')->item(0)->nodeValue;
                        $ora = $post->getElementsByTagName('oraCreazione')->item(0)->nodeValue;
                        //doppio controllo, vedo se il nodo esiste e se è diverso da null
                        if(($post->getElementsByTagName('utenteDestRisposta')->length>0)&&($post->getElementsByTagName('utenteDestRisposta')->item(0)->nodeValue !== null)){
                            $utenteDestRisposta = $post->getElementsByTagName('utenteDestRisposta')->item(0)->nodeValue;
                           
                        }//end if utenteDestRisposta
                        $testoPost = nl2br($post->getElementsByTagName('testoPost')->item(0)->nodeValue);
                        $nomiFile=array();
                        //ora controllo se sono presenti dei file
                        if($post->getElementsByTagName('filePost')->item(0)->childNodes->count()>0){
                            
                            $files = $post->getElementsByTagName('filePost')->item(0)->getElementsByTagName('fileSrc');
                            foreach($files as $file){
                                $nomiFile[] = $file->nodeValue; //prendo il nome del file
                            }

                        }

                        //stampa di debug 
                       /* echo $creatorePost." ".$data." ".$ora." ".$testoPost." ";
                        for($i=0; $i < count($nomiFile); $i++){
                            echo $nomiFile[$i];

                        }*/

                        //ora prendo l'avatar e i punti dell'utente che ha creato il post
                     /*   $sql = "select nomeFileAvatar,livelloReputazione from utenti where strcmp(nomeUtente,'$creatorePost')=0";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                            echo "sono qui";
                            while($row = mysqli_fetch_array($result)){
                                $avatar = $row['nomeFileAvatar'];
                                $livelloReputazionePunti = $row['livelloReputazione'];
                                
                            }//end while
                        }//end if result
                        echo $avatar; echo $livelloReputazionePunti;*/

                        /*echo ritornaAvatar($creatorePost);
                        echo statoReputazione(ritornaPunti($creatorePost));*/

                        //da qui ora cominciamo con la stampa dei post
                        //vediamo ora se è una risposta oppure un post normale
                        if($utenteDestRisposta !== ""){
                            echo "<p class='testoGenerico'>Risposta a : ".$utenteDestRisposta."</p>";
                        }
                        $path = "../Avatar/".ritornaAvatar($creatorePost);
                        echo "<img src='$path' class='avatar' alt='avatar'/>";
                        if(presenzaBan($creatorePost)==false){ echo "<p class='testoGenerico'>".$creatorePost." ".statoReputazione(ritornaPunti($creatorePost));}
                       
                       else echo "<p class='testoGenerico'>Utente Bannato</p>";
                        echo "<p class='testoGenerico'> ".$data." ".$ora."</p>";

                        //controlliamo ora se esistono delle valutazioni in merito a questo post
                        $sum = 0;
                        $valUtilità=$post->getElementsByTagName('valPostUtilità')->item(0);
                        if($valUtilità->childNodes->count()>0){

                            $valutazioni = $valUtilità->getElementsByTagName('valUt');
                            foreach($valutazioni as $valutazione){
                                $sum += intval($valutazione->firstChild->nextSibling->nodeValue);
                            }
                            $media = intval($sum/$valUtilità->childNodes->count());


                           
                            echo "<p class='testoGenerico'>Media Valutazioni Utilità:";
                            for($i=0; $i<$media; $i++)
                                echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                            for($i=0; $i<(5-$media); $i++)
                                echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                            echo "</p>";
                            // echo "<p class='testoGenerico'>".$media."</p>";
                             
                        }
                         $sum = 0;
                        $valAccordanza = $post->getElementsByTagName('valPostAccordanza')->item(0);
                        if($valAccordanza->childNodes->count()>0){
                            $valutazioni = $valAccordanza->getElementsByTagName('valutazioneAcc');
                            foreach($valutazioni as $valutazione){
                                $sum += intval($valutazione->firstChild->nextSibling->nodeValue);
                            }
                            $media = intval($sum/$valAccordanza->childNodes->count());
                           // $media = ( mediaValutazioniPost(1,$_SESSION['codice'],$post->getElementsByTagName('codicePost')->item(0)->nodeValue));
                            echo "<p class='testoGenerico'>Media Valutazioni Accordanza:";
                            for($i=0; $i<$media; $i++)
                                echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                            for($i=0; $i<(5-$media); $i++)
                                echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                            echo "</p>";
                           // echo "<p class='testoGenerico'>".$media."</p>";
                        }




                        
                       /* 
                        if($media != 0.0){
                            if($media!=0){
                                echo "<p class='testoGenerico'>Media Valutazioni Utilità:";
                                for($i=0; $i<$media; $i++)
                                    echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                                for($i=0; $i<(5-$media); $i++)
                                    echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                                echo "</p>";}
                        }

                        $media = mediaValutazioniPost(1,$_SESSION['codice'],$post->getElementsByTagName('codicePost')->item(0)->nodeValue);
                        if($media != 0.0){
                            if($media!=0){
                                echo "<p class='testoGenerico'>Media Valutazioni Accordanza:";
                                for($i=0; $i<$media; $i++)
                                    echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                                for($i=0; $i<(5-$media); $i++)
                                    echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                                echo "</p>";}
                        }*/




                        echo "<p class='testoGenerico'>".nl2br($testoPost)."</p>";
                        //ora controlliamo se ci sono immagini e/o video, se si le facciamo visualizzare
                       /* if(isset($nomiFile)){
                            echo "<div class='contenitoreImmagini'>";
                        for($i=0; $i < count($nomiFile); $i++){
                            $path1='../FilePostDiscussioni/'.$nomiFile[$i];
                            echo $nomiFile[$i];
                            if(str_contains($nomiFile[$i],'.jpg') || str_contains($nomiFile[$i],'.jpeg') || str_contains($nomiFile[$i],'.png')){
                                //stampo l'immagine
                                
                                echo "<img src='$path1'/ width='200px' height='200px' alt='immagine'>";
            
                            }else{
                                //potremmo affinare meglio questo controllo ma per ora va bene cosi...
                                echo "<video width='200px' height='200px' controls>";
                                echo "<source src='$path1' type='video/mp4'>";
                               
                              echo "</video> ";
            
                            }
                             

                        }
                        echo "</div>";*/
                        if(isset($nomiFile)){
                            echo "<div style='display: flex; gap: 10px; justify-content: center; align-items: center;'>";
                    for ($i = 0; $i < count($nomiFile); $i++) {
                         $path1 = '../FilePostDiscussioni/' . $nomiFile[$i];
                         echo "<div style='width: 300px; height: 300px; overflow: hidden; text-align: center;'>";
                         if (str_contains($nomiFile[$i], '.jpg') || str_contains($nomiFile[$i], '.jpeg') || str_contains($nomiFile[$i], '.png')) {
                             echo "<img src='$path1' style='width: 100%; height: 100%; object-fit: cover;' alt='immagine'>";
                        } else {
                        echo "<video style='width: 100%; height: 100%; object-fit: cover;' controls>";
                        echo "<source src='$path1' type='video/mp4'>";
                         echo "</video>";
                          }
                         echo "</div>";
                        }//end for
                        echo "</div>";
                        }//end isset nomiFile
                    //}

                    //pulsantiera per ogni post all'interno di un form,per essere presente ovviamente devo essere loggato
                    if(isset($_SESSION['username'])){
                        //se sono loggato ho a disposizione la pulsantiera 
                        echo "<form action='discussione.php' method='post'>";
                        echo "<button class='button' name='r' onclick='openPopup()' >Rispondi</button>";
                        //il seguente controllo serve per evitare che l'utente creatore del post valuti i suoi stessi post
                        if($_SESSION['username'] != $post->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue){
                        echo "<button class='button' name='v' >Valuta</button>";
                        //i post scritti dall'admin non possono essere segnalati
                        if(ritornaRuolo($creatorePost)==0 && ritornaRuolo($_SESSION['username'])==0)
                        echo "<button class='button' name='s'>Segnala</button>";
                        if(ritornaRuolo($_SESSION['username'])==1 && presenzaBan($creatorePost)==false)
                        echo "<button class='button' name='banna'>Banna </button>";
                    }
                        
                        if($_SESSION['username']==ritornaCreatoreDiscussione($_SESSION['codice']) || sonoModeratore($_SESSION['codice'],$_SESSION['username']) || $_SESSION['username']=='admin'){
                           //i post dell'admin non possono essere nascosti, pero lui puo' nascondere anche i propri post
                           if(ritornaRuolo($creatorePost)==0 || ritornaRuolo($_SESSION['username'])==1)
                            echo "<button class='button' name='nascondi'>Nascondi</button>";
                         }
                        echo "<input type='hidden' name='codPost' value='".$post->getElementsByTagName('codicePost')->item(0)->nodeValue."'/>";
                        echo "<input type='hidden' name='creatorePost' value='".$post->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue."'/>";
                        echo "</form>"; 

                       




                        if(isset($_POST['nascondi'])){
                            $_SESSION['codPost'] = $_POST['codPost'];
                            //OperaSuPost(1,$_SESSION['codice'],$_POST['codPost']);
                            header('Location:nascondiPost.php'); 

                        }//end isset nascondi

                        //gestiamo ora la pressione del tasto rispondi
                        //apparirà un popup con tutti i dati richiesti da inserire
                       /* echo "<div id='Overlay'></div>"; //div overlay
                        echo '<div id="popup">';
                        echo '<span class="close-btn" id="closePopup">&times;</span>';
                        echo '<form id="popupForm" action="server.php" method="POST">';
                        echo '<h3>Form Popup</h3>';
                        echo '<label for="name">Nome:</label>';
                        echo '<input type="text" id="name" name="name" required><br /><br />';

                        echo '<label for="email">Email:</label>';
                        echo '<input type="email" id="email" name="email" required><br /><br />';*/

                  /* echo ' <button type="submit">Invia</button>';
                    echo "</form>";
                    echo "</div>";*/

                        




                    }//end if isset username 
                    


                        echo "<hr />";

                        


                    }//end foreach post

                }//end else count 

                
                
                
                
                ?>











                <!--</p>-->
            </div>

          
<?php  if(isset($_POST['r']) || isset($_POST['p'])){ //misto di utilizzo fra client e server ---da rivedere
    $_SESSION['creatorePost'] = $_POST['creatorePost'];
    echo '<div id="overlay"></div>';
    echo '<div id="popup">';
    echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
    echo '<h3>Inserisci Post</h3>';
    echo '<form id="popupForm" action="insPost.php" method="POST" enctype="multipart/form-data">';
    echo '<label for="testo">Testo post:</label>';
    echo '<textarea id="testo" rows="10" cols="50" name="testo" required></textarea><br /><br />';
    echo '<input class="button" type="file" id="fileInput" name="files[]" multiple="multiple" accept="image/png,image/jpeg,image/jpg,image/gif,video/*"/><div id="anteprima"></div>';
   // echo '<button class="button" type="submit" name="invPost">Invia post</button>';
   echo '<input type="submit" class="button" name="invia" value="Invia" />';
    echo '</form>';
    echo '</div>';
    //echo "<p>".$_POST['testo']."</p>";

    //se premo invia devo registrare la risposta
    //ovviamente questo accade se la textarea è riempita con testo
  /*  inserisciPost($_SESSION['codice'],$_SESSION['username'],date('Y-m-d'),date('H:i:s'),$_POST['creatorePost'],nl2br($_POST['testo']));
    unset($_POST['r']);*/


}//end isset r
if(isset($_POST['v'])){ //misto di utilizzo fra client e server ---da rivedere
    $_SESSION['codPost'] = $_POST['codPost'];
    echo '<div id="overlay"></div>';
    echo '<div id="popup">';
    echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
    echo '<h3>Valuta il post</h3>';
    echo '<form id="popupForm" action="insValutazionePost.php" method="POST">';
    echo '<label for="testo">Valuta per:</label>';
    echo '<select name ="tipoValutazione"><option value="accordanzaPost">Accordanza</option><option value="utilitaPost">Utilità</option></select>';
    echo '<select name="valore"><option value="1" >&#9733;&#9734;&#9734;&#9734;&#9734;</option>
                    <option value="2" >&#9733;&#9733;&#9734;&#9734;&#9734;</option>
                    <option value="3" >&#9733;&#9733;&#9733;&#9734;&#9734;</option>
                    <option value="4" >&#9733;&#9733;&#9733;&#9733;&#9734;</option>
                    <option value="5" >&#9733;&#9733;&#9733;&#9733;&#9733;</option></select>';
    echo '<input type="submit" class="button" name="invia" value="Invia" />';
  
    echo '</form>';
    echo '</div>';

}//end isset valutazione

if(isset($_POST['s'])){
    $_SESSION['codPost'] = $_POST['codPost'];
    $_SESSION['creatorePost'] = $_POST['creatorePost'];
    echo '<div id="overlay"></div>';
    echo '<div id="popup">';
    echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
    echo '<h3>Segnala post</h3>';
    echo '<form id="popupForm" action="insSegnalazioni.php" method="POST">';
    echo '<label for="motivo">Segnala per:</label>';
   /* echo '<select name="valore">
                    <option value="linguaggioOff" >Linguaggio Offensivo</option>
                    <option value="offTopic" >Off-Topic</option>
                    <option value="Razzismo" >Razzismo</option>
                    <option value="Politica" >Politica</option>
                    <option value="suggDannosi" >Suggerimenti Dannosi</option>
                    <option value="Bullismo" >Bullismo</option></select>';*/
      echo '<select name ="motivo">';
      
  
      echo '<option value="linguaggioOff" >Linguaggio Offensivo</option>';
      echo '<option value="offTopic" >Off-Topic</option>';
      echo '<option value="Razzismo" >Razzismo</option>';
      echo '<option value="Politica" >Politica</option>';
      echo '<option value="suggDannosi" >Suggerimenti Dannosi</option>';
      echo '<option value="Bullismo" >Bullismo</option>';
    
      echo '</select>';
      
    echo '<input type="submit" class="button" name="invia" value="Invia" />';
    echo '</form>';
    echo '</div>';
//var_dump($_POST['codPost']);

}//end segnalazione

if(isset($_POST['banna'])){
    $_SESSION['creatorePost'] = $_POST['creatorePost'];               
    echo '<div id="overlay"></div>';
    echo '<div id="popup">';
    echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
    echo '<h3>Banna Utente</h3>';
    echo '<form id="popupForm" action="bannaUtente.php" method="POST" >';
    echo '<label for="data">Testo post:</label>';
    echo '<input type="date" class="date" name="data" value="'.date("Y-m-d").'" />';
   echo '<input type="submit" class="button" name="invia" value="Invia" />';
    echo '</form>';
    echo '</div>';}//end if banna

    





?><!--
<div id="overlay"></div>
<div id="popup">
    <span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>
    <h3>Rispondi al Post</h3>
    <form id="popupForm" action="server.php" method="POST">
        <label for="risposta">La tua risposta:</label>
        <textarea id="risposta" name="risposta" required></textarea><br><br>
        <button type="submit">Invia</button>
    </form>
</div>-->

</body>
    

</html>