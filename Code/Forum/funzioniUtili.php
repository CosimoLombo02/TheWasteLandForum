<?php 

  function popUp($string){ 
    
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

 