<?xml version="1.0" encoding="UTF-8"?>
<?php

session_start();
require_once "funzioniUtili.php";

     
?>


<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<!--da modificare-->
<head>
    <title> Discussioni</title> 
    <link rel ="stylesheet" href="../CSS/discussioni.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
    
</head>
<body>
    <?php /* if(isset($_SESSION['username'])){
        
        $User=$_SESSION['username'];
        
                echo "<div class='topnav'><a href='../logout.php'>Logout</a><a href='../homepage.php'>Pagina iniziale</a><a href='forumHP.php'>Forum</a><a href='regGenerali.php'>Regole Generali</a><a href='../fallout1.php'>Fallout 1</a><a href='../fallout2.php'>Fallout 2</a><a href='../fallout3.php'>Fallout 3</a><a href='../fallout4.php'>Fallout 4</a><a href='../falloutT.php'>Fallout Tactics</a><a href='../falloutB.php'>Fallout Brotherhood Of Steel</a><a href='../falloutN.php'>Fallout New Vegas</a><a href='../fallout76.php'>Fallout 76</a><a href='../falloutS.php'>Fallout Serie TV</a><a href='nuovaDiscussione.php'>Nuova discussione</a><a href='bachecaPersonale.php'>$User</a></div>";
    
            }else{
                
                echo "<div class='topnav'><a href='../reservedArea.php'>Login</a><a href='../homepage.php'>Pagina iniziale</a><a href='forumHP.php'>Forum</a><a href='regGenerali.php'>Regole Generali</a><a href='../fallout1.php'>Fallout 1</a><a href='../fallout2.php'>Fallout 2</a><a href='../fallout3.php'>Fallout 3</a><a href='../fallout4.php'>Fallout 4</a><a href='../falloutT.php'>Fallout Tactics</a><a href='../falloutB.php'>Fallout Brotherhood Of Steel</a><a href='../falloutN.php'>Fallout New Vegas</a><a href='../fallout76.php'>Fallout 76</a><a href='../falloutS.php'>Fallout Serie TV</a></div>";
    
    
                }//end else 
*/ require "mostraNavBar1.php";
                
                
        
                ?>

          <div class="container">
            <h2>Seleziona il media di riferimento, la categoria e la sottocategoria!</h2>
          </div>   


          <div class="container">
            <form action="discussioni.php" method="post">
            
            <div class="container">
            <select class="selectCustom" name="Media">

                <option value="Fallout1" <?php if(isset($_POST['Media']) && $_POST['Media'] == "Fallout1") echo 'selected="selected"';?>>Fallout 1</option>
                <option value="Fallout2" <?php if(isset($_POST['Media']) && $_POST['Media'] == "Fallout2") echo 'selected="selected"';?>>Fallout 2</option>
                <option value="Fallout3" <?php if(isset($_POST['Media']) && $_POST['Media'] == "Fallout3") echo 'selected="selected"';?>>Fallout 3</option>
                <option value="Fallout4"<?php if(isset($_POST['Media']) && $_POST['Media'] == "Fallout4") echo 'selected="selected"';?>>Fallout 4</option>
                <option value="FalloutBOS"<?php if(isset($_POST['Media']) && $_POST['Media'] == "FalloutBOS") echo 'selected="selected"';?>>Fallout BOS</option>
                <option value="FalloutTactics"<?php if(isset($_POST['Media']) && $_POST['Media'] == "FalloutTactics") echo 'selected="selected"';?>>Fallout Tactics</option>
                <option value="FalloutNewVegas" <?php if(isset($_POST['Media']) && $_POST['Media'] == "FalloutNewVegas") echo 'selected="selected"';?>>Fallout New Vegas</option>
                <option value="FalloutSerieTv"<?php if(isset($_POST['Media']) && $_POST['Media'] == "FalloutSerieTv") echo 'selected="selected"';?>>Fallout Serie Tv</option>
            </select>
            
            <select name="sottocategorie" class="selectCustom">
            <optgroup label="Personaggi e Luoghi">
                <?php
                $doc=caricaXML("sottocategorie.xml","");
                $sottoCategorie = $doc->getElementsByTagName('Sottocategoria');
                foreach ($sottoCategorie as $sottoCategoria) {
                    if($sottoCategoria->firstChild->nextSibling->textContent == "Personaggi e Luoghi"){
                        $nomeSottoCategoria = $sottoCategoria->firstChild->textContent;
                        $value=$nomeSottoCategoria.","."Personaggi e Luoghi";
                        if(isset($_POST['sottocategorie']) && $_POST['sottocategorie'] == $value){
                            echo "<option value='$value' selected='selected'>"."Personaggi e Luoghi: ".$nomeSottoCategoria."</option>";
                        }else{
                            echo "<option value='$value'>"."Personaggi e Luoghi: ".$nomeSottoCategoria."</option>";
                        }//end else sottocategorie
                    }
                }//end foreach
                ?>
            
            </optgroup>
            <optgroup label="Mods">
            <?php
                $doc=caricaXML("sottocategorie.xml","");
                $sottoCategorie = $doc->getElementsByTagName('Sottocategoria');
                foreach ($sottoCategorie as $sottoCategoria) {
                    if($sottoCategoria->firstChild->nextSibling->textContent == "Mods"){
                        $nomeSottoCategoria = $sottoCategoria->firstChild->textContent;
                        $value=$nomeSottoCategoria.","."Mods";
                        if(isset($_POST['sottocategorie']) && $_POST['sottocategorie'] == $value){
                            echo "<option value='$value' selected='selected'>"."Mods: ".$nomeSottoCategoria."</option>";
                        }else{
                            echo "<option value='$value'>"."Mods: ".$nomeSottoCategoria."</option>";
                        }//end else sottocategorie
                    }
                }//end foreach
                ?>
           
            </optgroup>
            <optgroup label="Problemi Tecnici e Bugs">
            <?php
                $doc=caricaXML("sottocategorie.xml","");
                $sottoCategorie = $doc->getElementsByTagName('Sottocategoria');
                foreach ($sottoCategorie as $sottoCategoria) {
                    if($sottoCategoria->firstChild->nextSibling->textContent == "Problemi Tecnici e Bugs"){
                        $nomeSottoCategoria = $sottoCategoria->firstChild->textContent;
                        $value=$nomeSottoCategoria.","."Problemi Tecnici e Bugs";
                        if(isset($_POST['sottocategorie']) && $_POST['sottocategorie'] == $value){
                            echo "<option value='$value' selected='selected'>"."Problemi Tecnici e Bugs: ".$nomeSottoCategoria."</option>";
                        }else{
                            echo "<option value='$value'>"."Problemi Tecnici e Bugs: ".$nomeSottoCategoria."</option>";
                        }//end else sottocategorie
                    }
                }//end foreach
                ?>
           
            </optgroup>
            <optgroup label="Guide e Soluzioni">
            <?php
                $doc=caricaXML("sottocategorie.xml","");
                $sottoCategorie = $doc->getElementsByTagName('Sottocategoria');
                foreach ($sottoCategorie as $sottoCategoria) {
                    if($sottoCategoria->firstChild->nextSibling->textContent == "Guide e Soluzioni"){
                        $nomeSottoCategoria = $sottoCategoria->firstChild->textContent;
                        $value=$nomeSottoCategoria.","."Guide e Soluzioni";
                        if(isset($_POST['sottocategorie']) && $_POST['sottocategorie'] == $value){
                            echo "<option value='$value' selected='selected'>"."Guide e Soluzioni: ".$nomeSottoCategoria."</option>";
                        }else{
                            echo "<option value='$value'>"."Guide e Soluzioni: ".$nomeSottoCategoria."</option>";
                        }//end else sottocategorie
                    }
                }//end foreach
                ?>
            
           
            </optgroup>
        </select>
            
           
                

            </div>
            <div class="container">
                <button name="cerca">Cerca</button>
            </div>
            
            </form>
        </div>

        
            <?php
            if(isset($_POST['cerca'])){
               echo '<div class="colonnaGrandeScroll">';
              
               $dati = explode(",",$_POST['sottocategorie']); //questa funzione ci serve per estrapolare da sottocategorie la sottocategoria stessa
                                                              //e la categoria a cui fa riferimento
               $sottoC=$dati[0];
               $catRif = $dati[1];
               $media=$_POST['Media']; //questa variabile indica il media(ovvero fallout 1 ecc...), dopo più sotto nel codice viene riutilizzata per 
                                       //contenere una vera e propria media aritmetica
              
               //carico il file XML
               $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
               $discussioni = $doc->getElementsByTagName('discussione'); //prendo tutte le discussioni
               $conta =0; //questo contatore mi serve per vedere se esistono discussioni con quel media, quella categoria e quella determinata sotto categoria
               foreach ($discussioni as $discussione) {
                //controlliamo che la discussione sia coerente con il media, la categoria e la sottocategoria inserita dall'utente, inoltre essa deve essere attiva in termini di stato
                if($discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->textContent==$_POST['Media'] && $discussione->getElementsByTagName('Categoria')->item(0)->nodeValue==$catRif && $discussione->getElementsByTagName('Sottocategoria')->item(0)->nodeValue==$sottoC && $discussione->getElementsByTagName('statoDiscussione')->item(0)->nodeValue=="attiva" ){
                    $conta++;
                    echo "<div class='containerP'>"; //questo div è il contenitore principale
                    echo "<div class='colonnaGrandeD'>"; //container1
                    echo "<form action='reindirizza.php' method='post'>";
                    echo "<div class='containerTitolo'><button class='buttonF' type='submit'>".$discussione->firstChild->nextSibling->textContent."</button>"; //titolo
                    echo "<input type='hidden' name='codDiscussione' value='".$discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue."'/></div>";
                    echo "</form>";
                    echo "<p>Tipo : ".$discussione->getElementsByTagName('tipoDiscussione')->item(0)->nodeValue."</p>";
                    echo "<p>Creata da: ".$discussione->getElementsByTagName('nomeUtenteCreatoreDiscussione')->item(0)->nodeValue."</p>";
                    echo "<p>Data Creazione: ".$discussione->getElementsByTagName('dataCreazioneD')->item(0)->nodeValue."</p>";
                    if($discussione->getElementsByTagName('CategoriaSpoiler')->length==0){ //significa che la recensione non ha spoiler
                        echo "<p>Spoiler non presente</p>";
                    }else{
                        //se sono qui mostro lo spoiler level e la categoria di spoiler
                        echo "<p>Categoria di spoiler: ".$discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue."</p>";
                        $val = $discussione->getElementsByTagName('SpoilerLevel')->item(0)->nodeValue;
                        echo "<p>Livello Spoiler:";
                        for($i=0; $i<$val; $i++)
                            echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                        for($i=0; $i<(5-$val); $i++)
                            echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                        echo "</p>";


                    }//end else spoiler

                    
                     

                    $cond1 =  $discussione->getElementsByTagName('valutazioniDiscussioneSpoiler')->item(0)->childElementCount;
                    $cond2 =  $discussione->getElementsByTagName('valutazioniDiscussioneUtilità')->item(0)->childElementCount;
                    $cond3 =  $discussione->getElementsByTagName('valutazioniDiscussioneAccordanza')->item(0)->childElementCount;

                    if($cond1 || $cond2 || $cond3) {
                       
                        $codice = $discussione->firstChild->nodeValue;
                        $media = mediaValutazioni($codice,'valutazioniDiscussioneSpoiler');
                       
                        echo "<h3>Ecco cosa ne pensano gli utenti: </h3>";
                        if($media!=0){
                        echo "<p>Media Valutazioni Spoiler:";
                        for($i=0; $i<$media; $i++)
                            echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                        for($i=0; $i<(5-$media); $i++)
                            echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                        echo "</p>";}
                        
                        
                    
                    $media = mediaValutazioni($codice,'valutazioniDiscussioneAccordanza');
                    if($media!=0){
                    echo "<p>Media Valutazioni Accordanza:";
                    for($i=0; $i<$media; $i++)
                        echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                    for($i=0; $i<(5-$media); $i++)
                        echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                    echo "</p>";}

                    $media = mediaValutazioni($codice,'valutazioniDiscussioneUtilità');
                    if($media!=0){
                    echo "<p>Media Valutazioni Utilità:";
                    for($i=0; $i<$media; $i++)
                        echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                    for($i=0; $i<(5-$media); $i++)
                        echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                    echo "</p>";}

                    }else{
                        echo "<p>Nessuna valutazione</p>";
                    }//end else cond

                    
                    
                     

                    echo "</div>"; //div container 1
                    echo "<div class='colonnaGrandeD'><p>Descrizione: </p>";
                    $string = nl2br($discussione->getElementsByTagName('Descrizione')->item(0)->nodeValue);
                     echo "<p class='evidenzia'>".$string."</p></div>";




                    //echo "<hr />";
                    echo "</div>"; //div sezione principale
                    
                   
                }
                  
                   
               }//end foreach

               if($conta==0){
                //Se entro qui significa che non ho trovato nessuna recensione con questi dati
                echo "<div><h1>Nessuna discussione presente con questi dati</h1></div>";
               }
            
            }//end if cerca
            
            
            echo "</div>"; //div colonna grande scroll
            ?>
        

       
            
    

</body>


</html> 