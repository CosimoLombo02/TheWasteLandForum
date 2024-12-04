<?php 

  function popUp1($string){ 
    
    echo "<script>alert('$string');</script>"; 
  }

  function caricaXML($fileName,$schemaName){ //questa funzione riceve due argomenti, il primo da sinistra è il nome del file XML, il secondo invece
                                             // è il nome dello schema di riferimento

    $xmlString = "";
    $pathFile = "../XML/".$fileName;
    foreach ( file($pathFile) as $node ) {
        $xmlString .= trim($node);
    }   //end first foreach
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
   // $root = $doc->documentElement;
        //$elementi = $root->childNodes;

        if($schemaName!=""){
            $schemaPath="../XML/SchemiXSD/".$schemaName;

        if(!$doc->schemaValidate($schemaPath)){
            die("Errore di validazione");
        }

        }else{
            if(!$doc->validate()){
                die("Errore nella validazione");
            }
        }//end else schemaValidate

return $doc;

        
    }//end function carica XML


  function mediaValutazioni($codice,$nomeTag)  {
    $d=caricaXML('discussioni.xml','schemaDiscussioni.xsd');
    $dis=$d->getElementsByTagName('discussione');
    foreach($dis as $disc){
        if($codice == $disc->firstChild->nodeValue){
            $valutazioni = $disc->getElementsByTagName($nomeTag)->item(0); //prendo il tag contenitore di quel tipo di valutazioni
            if($valutazioni->childElementCount==0){
                return 0; //se non ci sono valutazioni restituisco -1
            }else{
                $somma = 0;
                $divisore = $valutazioni->getElementsByTagName('valore')->count();
                $val = $valutazioni->getElementsByTagName('valore');
                foreach($val as $v){
                    $somma += $v->nodeValue;

                }//end foreach

                return round($somma/$divisore); //arrotondiamo in questo modo, se la prima cifra decimale è >= 5 si arrotonda per eccesso,
                                                //altrimenti per difetto

            }//end else

        }//end if codice

    }//end foreach

    return -1; //in caso di errori imprevisti

  }//end mediaValutazioni

  function statoReputazione($level){

    /*qui a seconda di dove si trova level nel range viene restituito lo stato di reputazione
    -100 punti o meno: Diffamato
    -
    Da -99 a -3: Evitato
    -
    Da -2 a +2: Neutrale
    -
    Da +3 a +99: Amato
    -
    +100 punti o più: Idolatrato*/
    if($level == null) return "Sovrintendente"; //l'admin non ha reputazione, lui è il sovrintendente

    if($level>=-2 && $level<= 2){
        $reputazione = 'Neutrale';
    }else{
        if($level>=-99 && $level<= -3){
            $reputazione = 'Evitato';
        }else{
            if($level <=-100){
                $reputazione = 'Diffamato';
            }else{
                if($level>=3 && $level<= 99){
                    $reputazione = 'Amato';
                }else{
                    //se sono qui sicuramente mi trovo nel range >=100
                    $reputazione = 'Idolatrato';
                }
            }

        }
    }//end if principale

    return $reputazione; //qui restituisco la stringa contenente la reputazione


  }//end function

  //questa funzione restituisce il titolo di una discussione attraverso il suo codice
  function ritornaTitoloDiscussione($code){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        $c = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($code == $c) return $discussione->getElementsByTagName('Titolo')->item(0)->nodeValue;
    }

    

  }//end function

  function ritornaPostDiscussione($codicePost,$codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
            $listaPost = $discussione->getElementsByTagName('listaPost')->item(0);
            $postL = $listaPost->getElementsByTagName('post');
            foreach($postL as $post){
                if($post->getElementsBytagName('codicePost')->item(0)->nodeValue==$codicePost)
                return substr($post->getElementsByTagName('testoPost')->item(0)->nodeValue,0,3).'...'; //prendo i caratteri
                //da 0 a 3 della stringa contente il post in più aggiungo anche i tre puntini
                
            }//end inner foreach 
        }//end if codice
    
    }//end foreach esterno

  }//end function


  function presenzaConseguenze($codice){
    $doc=caricaXML("conseguenzeSegnalazioni.xml","");
    $conseguenze = $doc->getElementsByTagName('ConseguenzaSegnalazioni');
    foreach($conseguenze as $conseguenza){
        if($conseguenza->getElementsbyTagName('codiceSegnalazione')->item(0)->nodeValue==$codice){
            return true;
        }

    }//end foreach
    return false; 

  }//end function


  function cambiaTutto($utenteNew,$utenteOld){

    //entro in tutti i file xml e cambio il vecchio nome utente con quello nuovo
    //conseguenze Segnalazioni
    $doc1=caricaXML("conseguenzeSegnalazioni.xml","");
    $conseguenze = $doc1->getElementsByTagName('ConseguenzaSegnalazioni');
    foreach($conseguenze as $conseguenza){
        if($conseguenza->getElementsbyTagName('versoChi')->item(0)->nodeValue==$utenteOld){
            $conseguenza->getElementsbyTagName('versoChi')->item(0)->nodeValue=$utenteNew;
        }
        if($conseguenza->getElementsbyTagName('utenteGestore')->item(0)->nodeValue==$utenteOld){
            $conseguenza->getElementsbyTagName('utenteGestore')->item(0)->nodeValue=$utenteNew;
        }

    }//end foreach conseguenze
    /*if($doc->validate()){ 
        $doc->save("../XML/conseguenzeSegnalazioni.xml");}else die ("Errore generico!");*/


     //ora vado in segnalazioni  
    $doc2=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
    $segnalazioni = $doc2->getElementsByTagName('segnalazione'); 

    foreach($segnalazioni as $segnalazione){
        if($segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue==$utenteOld){
            $segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue=$utenteNew;
        }
        if($segnalazione->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue==$utenteOld){
            $segnalazione->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue=$utenteNew;
        }

    }//end foreach segnalazione

    //ora vado nelle sottocategorie
    $doc3=caricaXML("sottocategorie.xml","");
    $sottocategorie = $doc3->getElementsByTagName('Sottocategoria');

    foreach($sottocategorie as $sottocategoria){
        if($sottocategoria->getElementsByTagName('inseritaDa')->item(0)->nodeValue==$utenteOld){
            $sottocategoria->getElementsByTagName('inseritaDa')->item(0)->nodeValue=$utenteNew;
        }
    }//end foreach sottocategorie

    //ora vado nelle categorie di spoiler
    $doc4=caricaXML("CategorieSpoiler.xml","");
    $catS = $doc4->getElementsByTagName('CategoriaSpoiler');

    foreach($catS as $cat){
        if($cat->getElementsByTagName('utenteCreatore')->length>0)
        if($cat->getElementsByTagName('utenteCreatore')->item(0)->nodeValue==$utenteOld){
            $cat->getElementsByTagName('utenteCreatore')->item(0)->nodeValue=$utenteNew;
        }
    }//end foreach categorie spoiler

    //ora vado nelle discussioni ed anche nei post
    $doc5=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc5->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        $c = $discussione->getElementsByTagName('nomeUtenteCreatoreDiscussione')->item(0)->nodeValue;
        if($utenteOld == $c) $discussione->getElementsByTagName('nomeUtenteCreatoreDiscussione')->item(0)->nodeValue=$utenteNew;
   
        $listaPost = $discussione->getElementsByTagName('listaPost')->item(0);
        $postL = $listaPost->getElementsByTagName('post');
        foreach($postL as $post){
            if($post->getElementsBytagName('utenteCreatorePost')->item(0)->nodeValue==$utenteOld)
            $post->getElementsBytagName('utenteCreatorePost')->item(0)->nodeValue=$utenteNew;
            if($post->getElementsByTagName('utenteDestRiposta')->length>0)
            if($post->getElementsBytagName('utenteDestRisposta')->item(0)->nodeValue==$utenteOld)
            $post->getElementsBytagName('utenteDestRisposta')->item(0)->nodeValue=$utenteNew;

            //ora navigo anche nelle varie valutazioni dei post
            $vAcc = $post->getElementsByTagName('valPostAccordanza')->item(0);
            $valutazioniAcc = $vAcc->getElementsByTagName('valutazioneAcc');
            foreach($valutazioniAcc as $valutazioneAcc){
                if($valutazioneAcc->lastChild->nodeValue==$utenteOld) $valutazioneAcc->lastChild->nodeValue=$utenteNew;

            }//end foreach accordanza post

            $vU = $post->getElementsByTagName('valPostUtilità')->item(0);
            $valutazioniU = $vU->getElementsByTagName('valUt');
            foreach($valutazioniU as $valutazioneU){
                if($valutazioneU->lastChild->nodeValue==$utenteOld) $valutazioneU->lastChild->nodeValue=$utenteNew;

            }//end foreach utilita post
            
        }//end inner foreach post

        $m = $discussione->getElementsByTagName('ModeratoriEletti')->item(0);
        $moderatoriEletti = $m->getElementsByTagName('nomeUtenteModeratore');
        foreach($moderatoriEletti as $moderatore){
            if($moderatore->textContent==$utenteOld) $moderatore->textContent=$utenteNew;

        }//end foreach moderatori

        //devo fare ora la stessa cosa per tutti i tipi di valutazione riguardanti la discussione
        $vAccD= $discussione->getElementsByTagName('valutazioniDiscussioneAccordanza')->item(0);
        $valutazioniAccD= $vAccD->getElementsByTagName('valutazioneDiscussioneAccordanza');

        foreach($valutazioniAccD as $valutazioneAccD){
            if($valutazioneAccD->getElementsByTagName('nomeUtente')->item(0)->nodeValue==$utenteOld)
            $valutazioneAccD->getElementsByTagName('nomeUtente')->item(0)->nodeValue=$utenteNew;
        }//end foreach valutazioni discussione Accordanza

        $vUD= $discussione->getElementsByTagName('valutazioniDiscussioneUtilità')->item(0);
        $valutazioniUtD= $vUD->getElementsByTagName('valDiscUt');

        foreach($valutazioniUtD as $valutazioneUtD){
            if($valutazioneUtD->getElementsByTagName('nomeUtente')->item(0)->nodeValue==$utenteOld)
            $valutazioneUtD->getElementsByTagName('nomeUtente')->item(0)->nodeValue=$utenteNew;
        }//end foreach valutazioni utilità discussione

        $vSD= $discussione->getElementsByTagName('valutazioniDiscussioneSpoiler')->item(0);
        $valutazioniSD= $vSD->getElementsByTagName('valutazioneDiscussioneSpoiler');

        foreach($valutazioniSD as $valutazioneSD){
            if($valutazioneSD->getElementsByTagName('nomeUtente')->item(0)->nodeValue==$utenteOld)
            $valutazioneSD->getElementsByTagName('nomeUtente')->item(0)->nodeValue=$utenteNew;
        } //end foreach valutazione spoiler

        //infine controllo anche se il nome utente da cambiare è presente fra quello degli utenti sospesi

        $uS = $discussione->getElementsByTagName('utentiSospesi')->item(0);
        if($uS->getElementsByTagName('nomeUtente')->length>0)
           {
            $utentiS=$uS->getElementsByTagName('nomeUtente');
            foreach($utentiS as $utenteS){
                if($utenteS->textContent==$utenteOld) $utenteS->nodeValue=$utenteNew; //qui segna errore ma quando lo testo non lo da

            }//end foreach utente sospeso

           }//end if utenti sospesi

   
    }//end foreach discussioni

    //ora se tutto è valido procedo con salvare
    if($doc5->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        if($doc4->validate()){
            if($doc3->validate()){
                if($doc2->schemaValidate("../XML/SchemiXSD/schemaSegnalazioni.xsd")){
                    if($doc1->validate()){
                        $doc5->save("../XML/Discussioni.xml");
                        $doc4->save("../XML/CategorieSpoiler.xml");
                        $doc3->save("../XML/sottocategorie.xml");
                        $doc2->save("../XML/segnalazioni.xml");
                        $doc1->save("../XML/conseguenzeSegnalazioni.xml");
                    } return "ok";
                }
            }
        }

    }//end primo if 

    return "non ok";




    

  }//end cambia tutto

  //questa funzione si occupa di oscurare/attivare una discussione
  //comando = 1 oscuro la discussione
  //comando = 0 attivo la discussione
  function operaSuDiscussione($comando,$codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
            if($comando == 1){
                $discussione->getElementsByTagName('statoDiscussione')->item(0)->nodeValue="eliminata";

            }else{
                $discussione->getElementsByTagName('statoDiscussione')->item(0)->nodeValue="attiva"; 

            }//end else

        }//end if controllo codice
    }//end foreach

    //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }


  }//end operaSuDiscussione


  //questa funzione serve per aggiungere un utente alla lista degli utenti sospesi dalla discussione
  //parlare con Denis per decidere cosa puo' fare o non puo' fare un utente sospeso
  //un utente viene ritenuto sospeso quando il suo nome utente fa parte della lista degli utenti
  //sospesi di una discussione
  function sospendiUtente($codiceDiscussione,$nomeUtenteSospeso){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
            $utentiSospesi=$discussione->getElementsByTagName('utentiSospesi')->item(0);
        $utenteSospeso=$doc->createElement('nomeUtente');
        $utenteSospeso->nodeValue=$nomeUtenteSospeso; 
        $utentiSospesi->appendChild($utenteSospeso);
        break;
        }
        
    }//end foreach

    //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }


   
  }//end sospendiUtente

  //questa  funzione invece si occupa di togliere la sospensione alla discussione per un determinato utente
  function attivaUtente($codiceDiscussione,$nomeUtenteDaAttivare){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
         
            $utentiSospesi = $discussione->getElementsByTagName('utentiSospesi')->item(0);
            $nomiUtentiSospesi = $utentiSospesi->getElementsByTagName('nomeUtente');
            foreach($nomiUtentiSospesi as $nomeUtenteSospeso){
               
                if($nomeUtenteSospeso->nodeValue==$nomeUtenteDaAttivare){
                    
                    $utentiSospesi->removeChild($nomeUtenteSospeso);
                    break; //uscita prematura dal ciclo
    
                }//end if interno
    
            }//end inner foreach
        }//end if codice
        
    }//end foreach

    //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }



  }//end attiva utente

  //questa funzione si occupa di attivare o disattivare un post dalla discussione
  //i post non vengono eliminati per mantenere una sorta di storico
  //0 post visibile-> attivo
  //1 post non visibile-> disattivo
  function OperaSuPost($comando,$codiceDiscussione,$codicePost){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
    if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
        $listaPost = $discussione->getElementsByTagName('listaPost')->item(0);
        $postL = $listaPost->getElementsByTagName('post');
        foreach($postL as $post){
            if($post->getElementsBytagName('codicePost')->item(0)->nodeValue==$codicePost){
                if($comando == 0){
                    $post->getElementsBytagName('statoPost')->item(0)->nodeValue="attivo";
                }else{
                    $post->getElementsBytagName('statoPost')->item(0)->nodeValue="disattivo";
                }
            }//end if codice post
       
            
        }//end inner foreach 
        }//end if codice
    }//end foreach esterno

        
    
    //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }


  }//end opera su post

  //questa funzione serve per elevare un utente normale al grado di moderatore della discussione
  function elevaAModeratore($codiceDiscussione,$nomeUtente){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        //mi posiziono nella discussione desiderata e creo un nuovo elemento moderatore
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
          
           $moderatori = $discussione->getElementsByTagName('ModeratoriEletti')->item(0);
           $moderatore = $doc->createElement('nomeUtenteModeratore');
           $moderatore->nodeValue=$nomeUtente; 
           $moderatori->appendChild($moderatore);


        }//end if esterno
    
    }//end foreach

    //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

  }//end eleva a moderatore



  //questa funzione si occupa di inserire una segnalazione nel relativo file xml
  //codiceSegnalazione - utenteSegnalatore - data - codicePostSegnalato - codiceDiscussione - motivazione - utenteCreatorePost - stato - risaltoAdmin
  function inserisciSegnalazione($utenteSegnalatore,$data,$codicePostSegnalato,$codiceDiscussione,$motivazione,$utenteCreatorePost,$risaltoAdmin){
  //ora creiamo l'elemento segnalazione e lo inseriamo nel file 
  //ora vado in segnalazioni  
  $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
  //$segnalazioni = $doc->getElementsByTagName('segnalazione'); 
  $root = $doc->documentElement;

  //un'altra modalità per fare questa cosa è con childNodes->count
  if($root->childNodes->count() == 0) $codiceSegnalazione = 1;
  else{
   // $lunghezza = $segnalazioni->length;
    //il -2 poichè per item il conteggio parte da zero mentre per lenght parte da 1 
    //$codiceUltima = $doc->getElementsByTagName('segnalazione')->item($lunghezza-2)->nodeValue;
   // $codiceUltima = $segnalazioni->item($lunghezza-2)->nodeValue;
   // $codiceSegnalazione = $codiceUltima++; //semplicemente aggiungo 1 al codice 
   $codiceSegnalazione = ($root->childNodes->count())+1;

  }//end else

  $segnalazione = $doc->createElement('segnalazione');

  $ele1 = $doc->createElement('codiceSegnalazione');
  $ele1->nodeValue=$codiceSegnalazione; 
  $segnalazione->appendChild($ele1);

  $ele2 = $doc->createElement('utenteSegnalatore');
  $ele2->nodeValue=$utenteSegnalatore;
  $segnalazione->appendChild($ele2);

  $ele3 = $doc->createElement('data');
  $ele3->nodeValue=$data;
  $segnalazione->appendChild($ele3);

  $ele4 = $doc->createElement('codicePostSegnalato');
  $ele4->nodeValue=$codicePostSegnalato;
  $segnalazione->appendChild($ele4);

  $ele5 = $doc->createElement('codiceDiscussione');
  $ele5->nodeValue=$codiceDiscussione;
  $segnalazione->appendChild($ele5);

  $ele6 = $doc->createElement('motivazione');
  $ele6->nodeValue=$motivazione;
  $segnalazione->appendChild($ele6);

  $ele7 = $doc->createElement('utenteCreatorePost');
  $ele7->nodeValue=$utenteCreatorePost;
  $segnalazione->appendChild($ele7);

  $ele8 = $doc->createElement('stato');
  $ele8->nodeValue="in lavorazione";
  $segnalazione->appendChild($ele8);

  $ele9 = $doc->createElement('risaltoAdmin');
  $ele9->nodeValue=$risaltoAdmin;
  $segnalazione->appendChild($ele9);

  
  
  $root ->appendChild($segnalazione);

  //ora controllo che tutto sia valido e salvo nel file xml relativo
  if($doc->schemaValidate("../XML/SchemiXSD/schemaSegnalazioni.xsd")){
        $doc->save("../XML/segnalazioni.xml");
}



  }//end inserisci segnalazione

//questa funzione serve per inserire la conseguenza di una segnalazione
//codiceSegnalazione-testoWarning-versoChi-descrizioneConseguenza-dataEvasioneSegnalazione-utenteGestore
function inserisciConseguenza($codiceSegnalazione,$testoWarning,$versoChi,$descrizioneConseguenza,$dataEvasioneSegnalazione,$utenteGestore){
    $doc=caricaXML("conseguenzeSegnalazioni.xml","");
    $root = $doc->documentElement; 

    $conseguenza = $doc->createElement('ConseguenzaSegnalazioni');

    $ele1 = $doc->createElement('codiceSegnalazione');
    $ele1->nodeValue=$codiceSegnalazione; 
    $conseguenza->appendChild($ele1);

    $ele2 = $doc->createElement('testoWarning');
    $ele2->nodeValue=$testoWarning; 
    $conseguenza->appendChild($ele2);

    $ele3 = $doc->createElement('versoChi');
    $ele3->nodeValue=$versoChi; 
    $conseguenza->appendChild($ele3);

    $ele4 = $doc->createElement('descrizioneConseguenza');
    $ele4->nodeValue=$descrizioneConseguenza; 
    $conseguenza->appendChild($ele4);

    $ele5 = $doc->createElement('dataEvasioneSegnalazione');
    $ele5->nodeValue=$dataEvasioneSegnalazione; 
    $conseguenza->appendChild($ele5);

    $ele6 = $doc->createElement('utenteGestore');
    $ele6->nodeValue=$utenteGestore; 
    $conseguenza->appendChild($ele6);

    $root->appendChild($conseguenza);

    //se è valido allora posso procedere con l'inserimento nel file xml
    if($doc->validate()){
        $doc->save("../XML/conseguenzeSegnalazioni.xml");
    }


}//end inserisciConseguenza

//questa funzione si occupa di inserire una valutazione sulla discussione in base o all'accordanza
//o al livello spoiler
//comando = 0 valutazione spoiler
//comando = 1 valutazione accordanza
//comando = 2 valutazione utilita
function inserisciValutazioneDiscussione($comando,$codiceDiscussione,$data,$valore,$nomeUtente){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
            if($comando==0){
                //se sono qui allora devo inserire una valutazione spoiler
                $valS = $discussione->getElementsByTagName('valutazioniDiscussioneSpoiler')->item(0);
                
                $valutazioneSpoiler = $doc->createElement('valutazioneDiscussioneSpoiler');

                $ele1 = $doc->createElement('data');
                $ele1->nodeValue=$data;
                $valutazioneSpoiler->appendChild($ele1);

                $ele2 = $doc->createElement('valore');
                $ele2->nodeValue=$valore;
                $valutazioneSpoiler->appendChild($ele2);

                $ele3 = $doc->createElement('nomeUtente');
                $ele3->nodeValue=$nomeUtente;
                $valutazioneSpoiler->appendChild($ele3);
                
                $valS->appendChild($valutazioneSpoiler);

            }else{
                if($comando==1){
                    //se sono qui allora devo inserire una valutazione accordanza
                $valU = $discussione->getElementsByTagName('valutazioniDiscussioneAccordanza')->item(0);
                
                $valutazioneU = $doc->createElement('valutazioneDiscussioneAccordanza');

                $ele1 = $doc->createElement('data');
                $ele1->nodeValue=$data;
                $valutazioneU->appendChild($ele1);

                $ele2 = $doc->createElement('valore');
                $ele2->nodeValue=$valore;
                $valutazioneU->appendChild($ele2);

                $ele3 = $doc->createElement('nomeUtente');
                $ele3->nodeValue=$nomeUtente;
                $valutazioneU->appendChild($ele3);
                
                $valU->appendChild($valutazioneU);

                }else{
                    //se sono qui aggiungo quelle per utilità
                    $valA = $discussione->getElementsByTagName('valutazioniDiscussioneUtilità')->item(0);
                
                $valutazioneSpoiler = $doc->createElement('valDiscUt');

                $ele1 = $doc->createElement('data');
                $ele1->nodeValue=$data;
                $valutazioneSpoiler->appendChild($ele1);

                $ele2 = $doc->createElement('valore');
                $ele2->nodeValue=$valore;
                $valutazioneSpoiler->appendChild($ele2);

                $ele3 = $doc->createElement('nomeUtente');
                $ele3->nodeValue=$nomeUtente;
                $valutazioneSpoiler->appendChild($ele3);
                
                $valA->appendChild($valutazioneSpoiler);


                }
            }//end else 0
        break;
        }//end if codice discussione
    }//end foreach

//qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }
}//end function valutazione discussione

//questa funzione serve per togliere/aggiungere punti ad un determinato utente
function punti($nomeUtente,$punti){
    require "connection1.php"; 
    $sql = "update utenti set livelloReputazione=livelloReputazione+$punti where strcmp(nomeUtente,'$nomeUtente')=0";
    $result = mysqli_query($conn,$sql) ;

}//end function punti

//questa funzione serve per inserire eventuali valutazioni su un determinato post in base all'utilità o all'accordanza
//si occupa anche di togliere/mettere punti all'utente che subisce questa valutazione
//comando = 0 valutazione utilita
//comando = 1 valutazione accordanza
function valutaPost($comando,$codicePost,$codiceDiscussione,$data,$valore,$nomeUtente){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
    if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
        $listaPost = $discussione->getElementsByTagName('listaPost')->item(0);
        $postL = $listaPost->getElementsByTagName('post');
        foreach($postL as $post){
            if($post->getElementsBytagName('codicePost')->item(0)->nodeValue==$codicePost){
                //a seconda del comando inserisco il tipo di valutazione
                if($comando == 0){
                    //valutazione utilità
                    $vU = $post->getElementsByTagName('valPostUtilità')->item(0);
                    $vUP = $doc->createElement('valUt');

                    $ele1 = $doc->createElement('data');
                    $ele1->nodeValue=$data;
                    $vUP->appendChild($ele1);

                    $ele2 = $doc->createElement('valore');
                    $ele2->nodeValue=$valore;
                    $vUP->appendChild($ele2);

                    $ele3 = $doc->createElement('nomeUtente');
                    $ele3->nodeValue=$nomeUtente;
                    $vUP->appendChild($ele3);

                    $vU->appendChild($vUP);
                    //l'admin non riceve variazioni di punti
                    if(ritornaRuolo($post->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue)==0){ 
                        //sezione punti
                        switch($valore){
                            case 1: $punti=-2;break;
                            case 2: $punti=-1;break;
                            case 3:$punti=0;break;
                            case 4:$punti=1;break;
                            case 5: $punti=2;break;
                            default: echo "errore!";break;
    
                        }//end switch
    
                        //chiamata alla funzione che toglie/aggiunge punti al creatore del post
                        punti($post->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue,$punti);
                    }//end if 
                   


                }else{
                    //se mi trovo di qua invece significa che devo inserire una valutazione in base all accordanza
                    //in questo caso non vi sono cambiamenti di punti
                    $vA = $post->getElementsByTagName('valPostAccordanza')->item(0);
                    $vAP = $doc->createElement('valutazioneAcc');

                    $ele1 = $doc->createElement('data');
                    $ele1->nodeValue=$data;
                    $vAP->appendChild($ele1);

                    $ele2 = $doc->createElement('valore');
                    $ele2->nodeValue=$valore;
                    $vAP->appendChild($ele2);

                    $ele3 = $doc->createElement('nomeUtente');
                    $ele3->nodeValue=$nomeUtente;
                    $vAP->appendChild($ele3);

                    $vA->appendChild($vAP);


                }//end else
            }//end if codice post
       
            
        }//end inner foreach 
        }//end if codice
    }//end foreach esterno

        
    
    //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }


}//end valutaPost

//questa funzione si occupa di togliere il grado di moderatore ad un determinato utente, viene riservata solo
//all'utente creatore delle discussione
function rimuoviModeratore($codiceDiscussione,$nomeUtente){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        //mi posiziono nella discussione desiderata e creo un nuovo elemento moderatore
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
          
           $moderatori = $discussione->getElementsByTagName('ModeratoriEletti')->item(0);
           $moderatoriE = $moderatori->getElementsByTagName('nomeUtenteModeratore');
           foreach($moderatoriE as $moderatore){
            if($moderatore->nodeValue==$nomeUtente){
                $moderatori->removeChild($moderatore);
                //break;
            }//end if interno

           }//end foreach
           
        }//end if esterno
    
    }//end foreach

    //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

}//end rimuovi moderatore

//funzione che serve per inserire un post all'interno di una discussione
//dobbiamo gestire se i file vengono gestiti qui o da un'altra parte 
//codicePost-utenteCreatorePost-dataCreazione-oraCreazione-utenteDestRisposta-testoPost-filePost(fileSrc)-ValPostAccordanza-valPostUtilità-statoPost
function inserisciPost($codiceDiscussione,$utenteCreatorePost,$dataCreazione,$oraCreazione,$utenteDestRisposta,$testoPost){
    //ora vado in quella determinata discussione e inserisco il post
    //ovviamente il post all'inizio non avrà nessun tipo di valutazione
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
    if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
        $listaPost = $discussione->getElementsByTagName('listaPost')->item(0);
        //$postL = $listaPost->getElementsByTagName('post');

        $post = $doc->createElement('post');

        if($listaPost->childNodes->count()==0)
        $codicePost = 1;
        else 
        $codicePost = $listaPost->childNodes->count()+1;

        $ele1 = $doc->createElement('codicePost');
        $ele1->nodeValue=$codicePost;
        $post->appendChild($ele1);

        $ele2 = $doc->createElement('utenteCreatorePost');
        $ele2->nodeValue=$utenteCreatorePost;
        $post->appendChild($ele2);

        $ele3 = $doc->createElement('dataCreazione');
        $ele3->nodeValue=$dataCreazione;
        $post->appendChild($ele3);

        $ele4 = $doc->createElement('oraCreazione');
        $ele4->nodeValue=$oraCreazione;
        $post->appendChild($ele4);

        /*$ele5 = $doc->createElement('codicePost');
        $ele5->nodeValue=$codicePost;
        $post->appendChild($ele5);*/

        $ele6 = $doc->createElement('utenteDestRisposta');
        $ele6->nodeValue=$utenteDestRisposta;
        $post->appendChild($ele6);

        $ele7 = $doc->createElement('testoPost');
        $ele7->nodeValue=$testoPost;
        $post->appendChild($ele7);

        $ele8 = $doc->createElement('filePost');
        $ele8->nodeValue="";
        $post->appendChild($ele8);

        $ele9 = $doc->createElement('valPostAccordanza');
        $ele9->nodeValue="";
        $post->appendChild($ele9);

        $ele10 = $doc->createElement('valPostUtilità');
        $ele10->nodeValue="";
        $post->appendChild($ele10);

        $ele11 = $doc->createElement('statoPost');
        $ele11->nodeValue="attivo";
        $post->appendChild($ele11);

        //controlliamo ora se ci sono file, se l'esito di questo controllo è positivo allora inseriamo nel file xml,
        //altrimenti no
       // if(count($fileSrc)>0){
          /*  for($i = 0; $i < count($fileSrc); $i++){
                //se sono qui li inserisci nel file xml, volendo potremo inserire i file anche qui oppure lo facciamo fuori?
                $ele=$doc->createElement('fileSrc');
                $ele->nodeValue=$fileSrc[$i];
                $ele8->appendChild($ele);

            }//end for */
            if (isset($_FILES['files']) && count(array_filter($_FILES['files']['name'])) >= 1) { //forse il controllo sul numero è un po' paranoico...
               // var_dump($_FILES);
                echo "<p>".count($_FILES['files']['name'])."</p>";
            foreach ($_FILES['files']['name'] as $file => $name) { //carico tutti i file inseriti dall'utente
                echo "sono nel foreach";
                $tmp_name = $_FILES['files']['tmp_name'][$file];
                //qui volendo potrei scegliere di creare una directory dedicata per ogni post
                $upload_dir = '../FilePostDiscussioni/';
                $nome =  $codiceDiscussione."_".$codicePost."_".$name;//il nome del file avrà in aggiunta all'inizio il codice della discussione_codice post,//in questo 
                //caso 1 poichè è il primo della della discussione
                $destination = $upload_dir . basename($nome);
                move_uploaded_file($tmp_name, $destination); //oppure possiamo usare anche copy
                $ele=$doc->createElement('fileSrc');
                $ele->nodeValue=$nome;
                $ele8->appendChild($ele);
                
                
             }//end foreach
            }//end if isset
        



       // }//end if count $fileSrc

        $listaPost->appendChild($post); //aggiungo il post
        
    }//end if controllo codice discussione
    }//end foreach discussione

    //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

    
}//end inserisciPost

//questa funzione mi restituisce il creatore di una discussione
function restituisciCreatore($codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        if($discussione->getElementsBytagName('codDiscussione')->item(0)->nodeValue==$codiceDiscussione){
           return $discussione->getElementsByTagName('nomeUtenteCreatoreDiscussione')->item(0)->nodeValue;
        }//end if codice discussione


    }//end foreach

}//end restituisciCreatore

//questa funzione mi serve per capire se un utente è sospeso o meno
function sonoSospeso($codiceDiscussione,$nomeUtente){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
            $utentiSospesi = $discussione->getElementsByTagName('utentiSospesi')->item(0);
            $nomiUtentiSospesi = $utentiSospesi->getElementsByTagName('nomeUtente');
            foreach($nomiUtentiSospesi as $nomeUtenteSospeso){
               
                if($nomeUtenteSospeso->nodeValue==$nomeUtente){
                    return true;
                
                }//end if interno
    
            }//end inner foreach
            
        }//end if codice discussione
    }//end foreach

return false;
}//end sonoSospeso

//questa funzione ritorna i post di una discussione
function ritornaPost($codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        if($codiceDiscussione == $discussione->getElementsbyTagName('codiceDiscussione')->item(0)->nodeValue){
            return $discussione->getElementsByTagName('listaPost')->item(0); //restituisco l'intera lista dei post
        }//end if codiceDiscussione

    }//end foreach

}//end ritornaPost

//funzione che ritorna l'avatar per i post
function ritornaAvatar($creatorePost){
    require "connection1.php";
    $avatar=null;
    $sql = "select nomeFileAvatar from utenti where strcmp(nomeUtente,'$creatorePost')=0";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                           
                            while($row = mysqli_fetch_array($result)){
                                $avatar = $row['nomeFileAvatar'];
                                
                                
                            }//end while
                        }//end if result
   return $avatar;
}//end ritorna avatar

//funzione che serve per ritornare i punti livello di un determinato utente
function ritornaPunti($nomeUtente){
    require "connection1.php";
    $punti = 0;
    $sql = "select livelloReputazione from utenti where strcmp(nomeUtente,'$nomeUtente')=0";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                            
                            while($row = mysqli_fetch_array($result)){
                                $punti = $row['livelloReputazione'];
                                
                                
                            }//end while
                        }//end if result
   return $punti;


}//end ritorna punti

//questa funzione serve a vedere se è già presente una valutazione sul quel determinato post da quel determinato utente
//se l'utente inserisce piu valutazioni sullo stesso post non vengono inserire tutte , ma viene modificato il valore 
//dell'unica segnalazine presente sul sistema
function modificaValutazionePost($comando,$nomeUtente,$codiceDiscussione,$codicePost,$valore){
    $flag = false;
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
    if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
        $listaPost = $discussione->getElementsByTagName('listaPost')->item(0);
        $postL = $listaPost->getElementsByTagName('post');
        foreach($postL as $post){
            if($post->getElementsBytagName('codicePost')->item(0)->nodeValue==$codicePost){
                //a seconda del comando inserisco il tipo di valutazione
                if($comando == 0){
                   $valutazioniUt = $post->getElementsByTagName('valPostUtilità')->item(0);
                   $vU = $valutazioniUt->getElementsByTagName('valUt');
                   foreach($vU as $v){
                    if($v->getElementsByTagName('nomeUtente')->item(0)->nodeValue==$nomeUtente){
                        $old =$v->getElementsByTagName('valore')->item(0)->nodeValue;
                        $v->getElementsByTagName('valore')->item(0)->nodeValue=$valore;
                        
                        $flag = true;
                        //qui ora devo vedere se devo togliere o aggiungere punti all'utente in base alla vecchia
                        //e alla nuova valutazione
                        //sezione punti
                        $punti =0;
                        //in questi due casi restituiamo i punti tolti precedentemente
                        if($old==1) $punti+=2;
                        if($old==2) $punti+=1;

                        //in questi altri due casi invece i punti li togliamo
                        if($old==4) $punti-=1;
                        if($old==5) $punti-=2;

                        //ora invece aggiungiamo o togliamo punti per la valutazione aggiornata
                    switch($valore){
                        case 1: $punti-=2;break;
                        case 2: $punti-=1;break;
                        case 3:$punti=0;break;
                        case 4:$punti+=1;break;
                        case 5: $punti+=2;break;
                        default: echo "errore!";break;

                    }//end switch
                    //ora aggiorno i punti
                    punti($nomeUtente,$punti);
                    }//end controllo nomeUtente
                   }//end foreach 


                }else{
                   
                    $vA = $post->getElementsByTagName('valPostAccordanza')->item(0);
                    $vAcc = $vA->getElementsByTagName('valutazioneAcc');
                    foreach($vAcc as $v){
                        if($v->getElementsByTagName('nomeUtente')->item(0)->nodeValue==$nomeUtente){
                            $v->getElementsByTagName('valore')->item(0)->nodeValue=$valore;
                            $flag = true;
                    
                        }
                       }//end foreach 
                       
                   

                }//end else
            }//end if codice post
       
            
        }//end inner foreach 
        }//end if codice
    }//end foreach esterno
//qui ora devo salvare le modifiche effettuate 
if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
    $doc->save("../XML/Discussioni.xml");
}
return $flag;
        
}//end presenzaValutazionePost

//questa funzione serve per vedere se l'utente ha già effettuato una segnalazione su quel determinato post
//con lo stesso motivo
function presenzaSegnalazione($nomeUtente,$codicePost,$codiceDiscussione,$motivo){
    $doc2=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
    $segnalazioni = $doc2->getElementsByTagName('segnalazione'); 

    foreach($segnalazioni as $segnalazione){
        if($segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue==$nomeUtente){
            if($segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione)
                if($segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue==$codicePost)
                    if($segnalazione->getElementsByTagName('motivazione')->item(0)->nodeValue==$motivo){
                        return true;
                    }//end if motivazione
        }}
        return false;
        }//end presenza segnalazioni

//questa funzione serve per controllare la presenza o meno di una valutazione per una discussione,se la trovo la modifico
function presenzaValutazioneDiscussione($comando,$nomeUtente,$valore,$codiceDiscussione){
    $flag = false;
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
            if($comando==0){
                //se sono qui allora devo inserire una valutazione spoiler
                $valS = $discussione->getElementsByTagName('valutazioniDiscussioneSpoiler')->item(0);
                $valutazioneSpoiler = $valS->getElementsByTagName('valutazioneDiscussioneSpoiler');
                foreach($valutazioneSpoiler as $v){
                    if($v->getElementsByTagName('nomeUtente')->item(0)->nodeValue==$nomeUtente){
                        $v->getElementsByTagName('valore')->item(0)->nodeValue=$valore;
                        $flag = true;
                    }
                }//end foreach
                

            }else{
                if($comando==2){
                   
                    $valU = $discussione->getElementsByTagName('valutazioniDiscussioneUtilità')->item(0);
                    $valutazioneU = $valU->getElementsByTagName('valDiscUt');
                    foreach($valutazioneU as $v){
                        if($v->getElementsByTagName('nomeUtente')->item(0)->nodeValue==$nomeUtente){
                            $v->getElementsByTagName('valore')->item(0)->nodeValue=$valore;
                            $flag = true;
                        }
                    }//end foreach
                    
                }//end if comando == 2
                if($comando == 1){
                    $valA= $discussione->getElementsByTagName('valutazioniDiscussioneAccordanza')->item(0);
                    $valutazioneA = $valA->getElementsByTagName('valutazioneDiscussioneAccordanza');
                    foreach($valutazioneA as $v){
                        if($v->getElementsByTagName('nomeUtente')->item(0)->nodeValue==$nomeUtente){
                            $v->getElementsByTagName('valore')->item(0)->nodeValue=$valore;
                            $flag = true;
                        }
                    }//end foreach
                }
            }//end else 0
        break;
        }//end if codice discussione
    }//end foreach

//qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

    return $flag;

}//end presenza valutazione discussione

//function sono moderatore, serve per capire se un'utente è moderatore o meno
function sonoModeratore($codiceDiscussione,$nomeUtente){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        //mi posiziono nella discussione desiderata e creo un nuovo elemento moderatore
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
          
           $moderatori = $discussione->getElementsByTagName('ModeratoriEletti')->item(0);
           $moderatoriE = $moderatori->getElementsByTagName('nomeUtenteModeratore');
           foreach($moderatoriE as $moderatore){
            if($moderatore->nodeValue==$nomeUtente){
                return true; //ovvero sono un moderatore
                //break;
            }//end if interno

           }//end foreach
           
        }//end if esterno
    
    }//end foreach


    return false;

}//end sono moderatore

//questa funzione si occupa di ritornare il creatore della discussione
function ritornaCreatoreDiscussione($codice){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        $c = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($codice == $c) return $discussione->getElementsByTagName('nomeUtenteCreatoreDiscussione')->item(0)->nodeValue;
    }

}//end ritornacreratore discussione

//questa funzione ritorna il ruolo di un utente
function ritornaRuolo($nomeUtente){
    require "connection1.php";
    
    $sql = "select ruolo from utenti where strcmp(nomeUtente,'$nomeUtente')=0";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                           
                            while($row = mysqli_fetch_array($result)){
                                $ruolo = $row['ruolo'];
                                
                                
                            }//end while
                        }//end if result
   return $ruolo;
}//end ritorna avatar

//questa funzione serve per visualizzare la media delle valutazioni riguardanti un post
//comando = 0 utilita
//comando = 1 accordanza

/*function mediaValutazioniPost($comando,$codiceDiscussione,$codicePost){
   /* $media = 0.0; $i=0.0;
    $listaPost = ritornaPost($codiceDiscussione);
    $listaP = $listaPost->getElementsByTagName('post');
    foreach($listaP as $p){
        if($comando == 0){
            //utilità
            $valU = $p->getElementsByTagName('valPostUtilità')->item(0);
            $VU = $valU->getElementsByTagName('valUt');
            foreach($VU as $v){
                $media+=floatval($v->getElementsByTagName('valore')->item(0)->nodeValue);
                $i++;
            }//end foreach

        }else{
            //accordanza
            $valA = $p->getElementsByTagName('valPostAccordanza')->item(0);
            $VA = $valA->getElementsByTagName('valutazioneAcc');
            foreach($VA as $v){
                $media+=floatval($v->getElementsByTagName('valore')->item(0)->nodeValue);
                $i++;
            }//end foreach

        }//end else
    }//end foreach

    //per evitare la divisione per zero
    if($i==0){
        $media = 0.0;
        return $media;
    }

    return ($media/($i));*/
  /*  $listaPost = ritornaPost($codiceDiscussione);
    $listaP = $listaPost->getElementsByTagName('post');
    $media = 0;
    $i = 0;
    foreach($listaP as $p){
        if($comando == 0){
            //utilità
            $i++;
            $valU = $p->getElementsByTagName('valPostUtilità')->item(0);
            $VU = $valU->getElementsByTagName('valUt');
            foreach($VU as $v){
                $media+=intval($v->getElementsByTagName('valore')->item(0)->nodeValue);
                
            }//end foreach

        }else{
            //accordanza
            $i++;
            $valA = $p->getElementsByTagName('valPostAccordanza')->item(0);
            $VA = $valA->getElementsByTagName('valutazioneAcc');
            foreach($VA as $v){
                $media+=intval($v->getElementsByTagName('valore')->item(0)->nodeValue);
                
            }//end foreach

        }//end else
    }//end foreach

return ($media /($i));

}//end mediaValutazioniPost*/

function ritornaModeratoriEletti($codiceDiscussione){
$doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
$discussioni = $doc->getElementsByTagName('discussione');
foreach($discussioni as $discussione){
    //mi posiziono nella discussione desiderata 
    if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
      
       $moderatori = $discussione->getElementsByTagName('ModeratoriEletti')->item(0);
       return $moderatori;

       
       
    }//end if esterno

}//end foreach
    
}//end ritornaModeratori

//ritorna il testo completo di un post
function ritornaTestoPostCompleto($codicePost,$codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
            $listaPost = $discussione->getElementsByTagName('listaPost')->item(0);
            $postL = $listaPost->getElementsByTagName('post');
            foreach($postL as $post){
                if($post->getElementsBytagName('codicePost')->item(0)->nodeValue==$codicePost)
                return $post->getElementsByTagName('testoPost')->item(0)->nodeValue;
                
                
            }//end inner foreach 
        }//end if codice
    
    }//end foreach esterno
}//end ritornaTestoCompleto

function ritornaCreatorePost($codicePost,$codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
            $listaPost = $discussione->getElementsByTagName('listaPost')->item(0);
            $postL = $listaPost->getElementsByTagName('post');
            foreach($postL as $post){
                if($post->getElementsBytagName('codicePost')->item(0)->nodeValue==$codicePost)
                return $post->getElementsByTagName('utenteCreatorePost')->item(0)->nodeValue;
                
                
            }//end inner foreach 
        }//end if codice
    
    }//end foreach esterno
}//end ritorna creatore post

//questa funzione si occupa di ritornare il tag listaFile di un determinato post in una determinata discussione
function ritornaFilePost($codiceDiscussione,$codicePost){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codiceDiscussione){
            $listaPost = $discussione->getElementsByTagName('listaPost')->item(0);
            $postL = $listaPost->getElementsByTagName('post');
            foreach($postL as $post){
                if($post->getElementsBytagName('codicePost')->item(0)->nodeValue==$codicePost)
                return $post->getElementsByTagName('filePost')->item(0);
                
                
            }//end inner foreach 
        }//end if codice
    
    }//end foreach esterno
}//end ritorna File Post

//funzione che serve per motivi grafici nel visualizzare il motivo di una segnalazione
function mappingMotivo($string){
    if($string == 'linguaggioOff') return 'Linguaggio Offensivo';
    if($string == 'offTopic') return 'Off-Topic';
    if($string == 'Razzismo') return 'Razzismo';
    if($string == 'Politica') return 'Politica';
    if($string == 'suggDannosi') return 'Suggerimenti Dannosi';
    if($string == 'Bullismo') return 'Bullismo';
    
}//end mappingMotivo

//questa funzione serve per bannare un utente
function bannaUtente($nomeUtente,$dataFineBan){
    require "connection1.php";
    $sql = "update utenti set ban=1,dataFineBan='$dataFineBan' where strcmp(nomeUtente,'$nomeUtente')=0";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                           return true;
                        }//end if result
   
else return false;
}//end bannaUtente
  
//funzione che serve per accettare/rifiutare segnalazioni, ovvero per settare il file xml
function accettaRifiutaSegnalazione($stato,$codiceSegnalazione){
    $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
  $segnalazioni = $doc->getElementsByTagName('segnalazione'); 
  foreach($segnalazioni as $segnalazione){
    if($segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue==$codiceSegnalazione){
      // echo "sono qui";
        $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue=$stato;
    }//end if codice Segnalazione

  }//end foreach
  //ora controllo che tutto sia valido e salvo nel file xml relativo
  if($doc->schemaValidate("../XML/SchemiXSD/schemaSegnalazioni.xsd")){
    $doc->save("../XML/segnalazioni.xml");
}

}//end accettaRifiutaSegnalazione
 

//serve per il risalto dell'admin
function cambiaRisalto($risalto,$codiceSegnalazione){
    $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
  $segnalazioni = $doc->getElementsByTagName('segnalazione'); 
  foreach($segnalazioni as $segnalazione){
    if($segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue==$codiceSegnalazione){
      // echo "sono qui";
        $segnalazione->getElementsByTagName('risaltoAdmin')->item(0)->nodeValue=$risalto;
    }//end if codice Segnalazione

  }//end foreach
  //ora controllo che tutto sia valido e salvo nel file xml relativo
  if($doc->schemaValidate("../XML/SchemiXSD/schemaSegnalazioni.xsd")){
    $doc->save("../XML/segnalazioni.xml");
}

}//end accettaRifiutaSegnalazione

//questa funzione serve per vedere se un utente è bannato o meno
function presenzaBan($nomeUtente){
    require "connection1.php";
    $sql = "select ban from utenti where strcmp(nomeUtente,'$nomeUtente')=0";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                            while($row = mysqli_fetch_array($result)){
                                $ban = $row['ban'];
                            }
                            if($ban== 0)  return false;
                            else return true;
                           //return true;
                        }//end if result
                        else return false;
   
//else return false;


}//end presenzaBan

//questa funzione serve per eliminare fisicamente una discussione dal file xml
function eliminaDiscussione($codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    $root = $doc->documentElement;

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue == $codiceDiscussione){
            $root->removeChild($discussione);
            
        }

    }//end foreach

    eliminaSegnalazione($codiceDiscussione); //elimino anche tutte le segnalazioni su questa discussione



     //qui ora devo salvare le modifiche effettuate 
     if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }
}//end elimina discussione

//questa funzione serve per cambiare il media di una discussione
function cambiaMedia($media,$codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    //$root = $doc->documentElement;

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue == $codiceDiscussione){
            $discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->nodeValue = $media;
            
        }

    }//end foreach



     //qui ora devo salvare le modifiche effettuate 
     if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

}//end cambia media 

//ritorna il media di una discussione
function ritornaMedia($codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    //$root = $doc->documentElement;

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue == $codiceDiscussione){
            return $discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->nodeValue ;
            
        }

    }//end foreach



     //qui ora devo salvare le modifiche effettuate 
     if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

}//end ritornaMedia

//questa funzione mi serve per eliminare una categoria di spoiler
//cambia   mi dice se voglio cambiare la categoria di spoiler
//elimina se la voglio eliminare
/*
function operaCategoriaSpoiler($cambia,$elimina,$codiceDiscussione,$nome,$nomeNew,$valoreNew){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    $r=$doc->documentElement;
    //$root = $doc->documentElement;

    foreach($discussioni as $discussione){
        $codice = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if(($codice == $codiceDiscussione) && count($discussione->getElementsByTagName('CategoriaSpoiler'))>0){
            if($cambia ==true && $nomeNew != ''){
               
                $discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue==$nomeNew;
               
            }
            if($elimina == true){
                //se sono qui la elimino ed elimino tutte le valutazioni che ha ricevuto quel post su quella categoria
                $valSpoiler = $discussione->getElementsByTagName('valutazioniDiscussioneSpoiler')->item(0);
                $valS = $valSpoiler->childNodes;
                foreach($valS as $v){
                    $valSpoiler->removeChild($v);
                }
                $doc4=caricaXML("CategorieSpoiler.xml","");
                $catS = $doc4->getElementsByTagName('CategoriaSpoiler');
                $root = $doc4->documentElement;
                foreach($catS as $c){
                    if($c->getElementsByTagName('nome')->item(0)->nodeValue == $nome){
                        $root->removeChild($c);
                    }
                }
                if($nomeNew == ''){
                    $discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue=='ricategorizzare';
                    $discussione->getElementsByTagName('SpoilerLevel')->item(0)->nodeValue==0;
                }

            }
            
        }

    }//end foreach



     //qui ora devo salvare le modifiche effettuate 
     if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd") && $doc4->validate()){
        $doc->save("../XML/Discussioni.xml");  
         $doc4->save("../XML/CategorieSpoiler.xml");
    }
    

}//end function categoria <spoiler></spoiler>
*/

//questa funzione mi permette di eliminare una categoria di spoiler
function eliminaCategoriaSpoiler($nome){
    $doc4=caricaXML("CategorieSpoiler.xml","");
    $catS = $doc4->getElementsByTagName('CategoriaSpoiler');
    $root = $doc4->documentElement;

    foreach($catS as $c){
        if($c->getElementsByTagName('nome')->item(0)->nodeValue==$nome){
         $root->removeChild($c);
        }
    }

    //ora entro nelle discussioni
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('CategoriaSpoiler')->count()>0){
            if($discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue==$nome){
              cambiaCategoriaSpoiler('ricategorizzare',$discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue,0);
            }//end if nome
        }//end if count

    }//end foreach

     //qui ora devo salvare le modifiche effettuate 
     if( $doc4->validate()){
        
    $doc4->save("../XML/CategorieSpoiler.xml");
    }


}//end eliminaCategoriaSpoiler

function cambiaCategoriaSpoiler($nome,$codiceDiscussione,$valoreNew){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    $root = $doc->documentElement;

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue == $codiceDiscussione){
            $discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue = $nome;
            $discussione->getElementsByTagName('SpoilerLevel')->item(0)->nodeValue = $valoreNew;
           $valS = $discussione->getElementsByTagName('valutazioniDiscussioneSpoiler')->item(0);
        /* echo $valS->childElementCount;
         echo $valS->childNodes->count();
         echo $codiceDiscussione;
           if($valS->childNodes->count() > 0){
            
            eliminaValutazioniSpoilerDiscussione($codiceDiscussione); //elimino tutte le valutazioni spoiler
         }*/
        //eliminaValutazioniSpoilerDiscussione($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue);
        
        }//end if codice discussione

    }//end foreach



     //qui ora devo salvare le modifiche effettuate 
     if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

}//end cambia categoria Spoiler

// questa funzione serve per eliminare le valutazioni spoiler di una discussione
function eliminaValutazioniSpoilerDiscussione($codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    $root = $doc->documentElement;

    foreach($discussioni as $discussione){
        $conta = $discussione->getElementsByTagName('valutazioniDiscussioneSpoiler')->item(0)->childElementCount;
        $codice = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($codice == $codiceDiscussione && $conta > 0){
            //mi posiziono sul tag valutazioni discussione spoiler e elimino i figli
            $figli = $discussione -> getElementsByTagName('valutazioneDiscussioneSpoiler');
            $padre = $figli->item(0)->parentNode;
            while($padre->firstChild){
                $padre->removeChild($padre->firstChild);
            }
            

        }//end if codice discussione
    }

    //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

}//end elimina valutazioni discussione spoiler

/*questa funzione mi permette di cambiare una sottocategoria
function cambiaCategoria($categoria,$codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    $root = $doc->documentElement;

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue == $codiceDiscussione){
            $discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue = $nome;
            $discussione->getElementsByTagName('SpoilerLevel')->item(0)->nodeValue = $valoreNew;
           $valS = $discussione->getElementsByTagName('valutazioniDiscussioneSpoiler')->item(0);
           $val = $valS->getElementsByTagName('valutazioneDiscussioneSpoiler');
           if($valS->childNodes->count()>0){
            foreach($val as $v){
                $valS->removeChild($v);
            }//end foreach interno
           }//end if count
        
        }//end if codice discussione

    }//end foreach



     //qui ora devo salvare le modifiche effettuate 
     if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

}//end <cambiaCategoria></cambiaCategoria>
*/

//questa funzione mi permette di rimuovere una sottocategoria
function rimuoviSottoCategoria($nome,$categoria){
    $doc3=caricaXML("sottocategorie.xml","");
    $sottocategorie = $doc3->getElementsByTagName('Sottocategoria');
    $root = $doc3->documentElement;

    foreach($sottocategorie as $sottocategoria){
        $nomeS = $sottocategoria->getElementsByTagName('nome')->item(0)->nodeValue;
        $categoriaDiRif = $sottocategoria->getElementsByTagName('categoriaDiRif')->item(0)->nodeValue;
   if($nomeS == $nome && $categoria == $categoriaDiRif){
    $root->removeChild($sottocategoria);
   }
   
    }//end foreach sottocategoria
    //ora vado in tutte le discussioni con quella determinaat sottocategoria e le metto come ricategorizzare
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('Categoria')->item(0)->nodeValue==$categoria && $discussione->getElementsByTagName('Sottocategoria')->item(0)->nodeValue==$nome){
           /* $discussione->getElementsByTagName('Categoria')->item(0)->nodeValue='ricategorizzare';
            $discussione->getElementsByTagName('Sottocategoria')->item(0)->nodeValue='ricategorizzare';
            
        */ echo 'sono qui'; //debug
        $discussione->getElementsByTagName('Categoria')->item(0)->nodeValue='ricategorizzare';
        $discussione->getElementsByTagName('Sottocategoria')->item(0)->nodeValue='ricategorizzare';
    }
    }//end foreach discussioni





    if($doc3->validate()){
         //qui ora devo salvare le modifiche effettuate 
    if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
        $doc3->save("../XML/sottocategorie.xml");
    }

        
        
 
        }
    

}//end rimuovi Sottocategoria

function cambiaCatSottoCat($categoria,$sottocategoria,$codiceDiscussione){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    //$root = $doc->documentElement;

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue == $codiceDiscussione){
            $discussione->getElementsByTagName('Categoria')->item(0)->nodeValue = $categoria;
            $discussione->getElementsByTagName('Sottocategoria')->item(0)->nodeValue = $sottocategoria;
        }

    }//end foreach



     //qui ora devo salvare le modifiche effettuate 
     if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }

}//end cambia

//questa funzione mi serve per inserire una sottocategoria

function inserisciSottocategoria($nome,$categoriaDiRif,$inseritaDa,$dataInserimento){
    $doc=caricaXML("sottocategorie.xml","");
            $root = $doc->documentElement;
            

            $r = $doc->createElement('Sottocategoria');
                  

            $ele1 = $doc->createElement('nome');
            $ele1->nodeValue=$nome;
            $r->appendChild($ele1);

            $ele2 = $doc->createElement('categoriaDiRif');
            $ele2->nodeValue=$categoriaDiRif;
            $r->appendChild($ele2);

            $ele2 = $doc->createElement('inseritaDa');
            $ele2->nodeValue=$inseritaDa;
            $r->appendChild($ele2);

            $ele3 = $doc->createElement('dataInserimento');
            $ele3->nodeValue=$dataInserimento;
            $r->appendChild($ele3);


            $root->appendChild($r); 

            if($doc->validate()) $doc->save("../XML/sottocategorie.xml");
            
}//end inserisci sottocategoria

//questa funzione serve per inserire una categoria di spoiler
function inserisciCategoriaSpoiler($nome,$utenteCreatore,$dataInserimento){
    $doc=caricaXML("CategorieSpoiler.xml","");
    $root = $doc->documentElement;
    

    $r = $doc->createElement('CategoriaSpoiler');
      
    $ele1 = $doc->createElement('nome');
    $ele1->nodeValue=$nome;
    $r->appendChild($ele1);

    $ele2 = $doc->createElement('utenteCreatore');
    $ele2->nodeValue=$utenteCreatore;
    $r->appendChild($ele2);

    $ele3 = $doc->createElement('dataInserimento');
    $ele3->nodeValue=$dataInserimento;
    $r->appendChild($ele3);


    $root->appendChild($r); 

    if($doc->validate()) $doc->save("../XML/CategorieSpoiler.xml");
    else die("Errore generico!");
}//end inserisci categoria spoiler

/*questa funzione permette di far inserie all'admin uno spoiler che non è presente nella discussione
function inserisciSpoilerDiscussione($codiceDiscussione,$tipo,$level){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');
    //$root = $doc->documentElement;

    foreach($discussioni as $discussione){
        if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue == $codiceDiscussione){
            $spoilerLevel = $doc->createElement('SpoilerLevel');
            $spoilerLevel->nodeValue  = $level;
            $t = $doc->createElement('CategoriaSpoiler');
            $t->nodeValue=$tipo;
            $discussione->insertBefore($t,$discussione->getElementsByTagName('Descrizione')->item(0));
            $discussione->insertBefore($spoilerLevel,$discussione->getElementsByTagName('Descrizione')->item(0));
        }

    }//end foreach



     //qui ora devo salvare le modifiche effettuate 
     if($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")){
        $doc->save("../XML/Discussioni.xml");
    }else{
        $doc->save("../XML/error.xml");
    }

}//end inserisci spoiler discussione
*/

function inserisciSpoilerDiscussione($codiceDiscussione, $tipo, $level) {
    $doc = caricaXML("Discussioni.xml", "schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach ($discussioni as $discussione) {
        if ($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue == $codiceDiscussione) {
            
            // Crea gli elementi CategoriaSpoiler e SpoilerLevel
            $spoilerLevel = $doc->createElement('SpoilerLevel');
            $spoilerLevel->nodeValue = $level;
            $categoriaSpoiler = $doc->createElement('CategoriaSpoiler');
            $categoriaSpoiler->nodeValue = $tipo;

            // Trova il nodo Descrizione
            $descrizione = $discussione->getElementsByTagName('Descrizione')->item(0);
            
            // Verifica che Descrizione esista
            if ($descrizione) {
                // Debug: stampiamo il nodo Descrizione per vedere la posizione
                //echo "Descrizione trovato: " . $descrizione->nodeValue . "<br>";

                // Inserisci CategoriaSpoiler e SpoilerLevel prima di Descrizione
                $discussione->insertBefore($categoriaSpoiler, $descrizione);
                $discussione->insertBefore($spoilerLevel, $descrizione);
            } else {
                echo "Errore: Descrizione non trovata.<br />"; //debug 
            }
        }
    }

    // Validazione dello schema prima di salvare
    if ($doc->schemaValidate("../XML/SchemiXSD/schemaDiscussioni.xsd")) {
        // Debug: stampa il documento XML per vedere se tutto è a posto
        
        $doc->save("../XML/Discussioni.xml");
    } else {
       
        $doc->save("../XML/error.xml");
    }
}

//questa funzione ci permette di capire se una categoria è gia stata inserita o meno(intendo di spoiler)
function giaInseritaSpoiler($nome){
   
    $doc=caricaXML("CategorieSpoiler.xml","");
    $categorieSpoiler = $doc->getElementsByTagName('CategoriaSpoiler');
    foreach($categorieSpoiler as $categoriaSpoiler){
        if($categoriaSpoiler->getElementsByTagName('nome')->item(0)->nodeValue == $nome) return true;
    }//end foreach

return false; 
}//end giainserita spoiler


//questa funzione mi permette di capire se una categoria ed una sottocategoria sono gia state inserite
function giaInseritaCat($nome1,$nome2){
    $doc = caricaXML("sottocategorie.xml","");
    $sottocategorie = $doc->getElementsByTagName('Sottocategoria');
    foreach($sottocategorie as $sottocategoria){
        if($sottocategoria->getElementsByTagName('nome')->item(0)->nodeValue==$nome1 && $sottocategoria->getElementsByTagName('categoriaDiRif')->item(0)->nodeValue==$nome2){
            return true;
        }//end if 

    }//end foreach
    return false;
}//end gia inserita

//questa funzione mi permette di eliminare tutte le segnalazioni ricevute su una determinata discussione
function eliminaSegnalazione($codiceDiscussione){
    $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
    $segnalazioni = $doc->getElementsByTagName('segnalazione');
    $root = $doc->documentElement;
    foreach($segnalazioni as $segnalazione){
        $codiceDis = $segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($codiceDis == $codiceDiscussione){
            $root->removeChild($segnalazione);
        }
    }
    if($doc->schemaValidate("../XML/SchemiXSD/schemaSegnalazioni.xsd")){
        $doc->save("../XML/segnalazioni.xml");
    }


}//end eliminaSegnalazione

//questa funzione conta le segnalazioni 
//comando = 0 segnalazioni non lavorate
//comando = 1 segnalazioni lavorate
//comando =  2 segnalazioni con risalto
function contaSegnalazioni($codDiscussione,$comando){
    $conta = 0; 
    $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
    $segnalazioni = $doc->getElementsByTagName('segnalazione');
    
    foreach($segnalazioni as $segnalazione){
        if($segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codDiscussione && $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue == 'in lavorazione' && $comando == 0){
            $conta++; 
        }
        if($segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codDiscussione && $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue != 'in lavorazione' && $comando == 1){
            $conta++;
        }
        if($segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$codDiscussione && $segnalazione->getElementsByTagName('risaltoAdmin')->item(0)->nodeValue == 1 && $comando == 2){
            $conta++;
        }
      
    }
   
    return $conta  ;
}//end contaSegnalazioni

//questa funzione invece con le segnalazioni con risalto dell'intero sistema
function contaSegnalazioniRisalto(){
    $conta = 0; 
    $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
    $segnalazioni = $doc->getElementsByTagName('segnalazione');
    
    foreach($segnalazioni as $segnalazione){
       
        if( $segnalazione->getElementsByTagName('risaltoAdmin')->item(0)->nodeValue == 1 ){
            $conta++;
        }
      
    }
   
    return $conta  ;
}//end contaSegnalazioniRisalto

//questa funzione serve per ritornare lo stato di una discussione
function statoDiscussione($code){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        $c = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($code == $c) return $discussione->getElementsByTagName('statoDiscussione')->item(0)->nodeValue;
    }

}

//questa funzione restituisce la categoria di spoiler  di una discussione attraverso il suo codice
function ritornaTipoSpoiler($code){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        $c = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($code == $c) return $discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue;
    }

    

  }//end function

  //questa funzione ritorna lo spoiler level di una discussione
  function ritornaLevelSpoiler($code){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        $c = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($code == $c) return $discussione->getElementsByTagName('SpoilerLevel')->item(0)->nodeValue;
    }

    

  }//end function


//questa funzione serve per ritornare la categoria di una discussione
function ritornaCategoria($code){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        $c = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($code == $c) return $discussione->getElementsByTagName('Categoria')->item(0)->nodeValue;
    }

}//end function

//questa funzione ritorna una sottocategoria di una discussione
function ritornasottoCategoria($code){
    $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
    $discussioni = $doc->getElementsByTagName('discussione');

    foreach($discussioni as $discussione){
        $c = $discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue;
        if($code == $c) return $discussione->getElementsByTagName('Sottocategoria')->item(0)->nodeValue;
    }

}//end function
