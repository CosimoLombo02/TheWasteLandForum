<!--<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">-->

<!DOCTYPE html> <!--questa potrebbe  contenere  video, viene usato html 5-->

<html>


<head>
    <title> Nuova Discussione</title> 
    <!--<link rel="stylesheet" href="foglioDiStile.css " type="text/css" /></head>-->
    <link rel ="stylesheet" href="../CSS/discussioni.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <script type="text/javascript" src="../JS/sottoCategoriaCustom.js"></script> <!--piccolo script che serve per far comparire dei div-->
    <script type="text/javascript" src="../JS/sparisci.js"></script>
    <script type="text/javascript" src="../JS/sparisciSpeciale.js"></script>
    <script type="text/javascript" src="../JS/controllaNumeroFile.js"></script>
    
</head>
<body>
    
    <?php
    session_start();/*
     if(!isset($_SESSION['username'])){
         //qui non ci posso accedere se non ho fatto il login
         $_SESSION = array();
         session_destroy(); //distruggo la sessione e reindirizzo alla pagina di login
         setcookie("PHPSESSID",'',time()-1,'/'); //cosi viene eliminato anche il cookie lato client
         header("Location: ../reservedArea.php");
    }//end  */
     
   
     require "funzioniUtili.php";
     $check2=false;
     $check3=false;

     if(isset($_POST['titolo']))
     $titolo =$_POST['titolo'];
     else $titolo="";
     if(isset($_POST['descrizione']))
     $descrizione =$_POST['descrizione'];
     else $descrizione="";
     if(isset($_POST['primoPost']))
     $primoPost =$_POST['primoPost'];
     else $primoPost="";
     


     ?>
     <div class="container"><h1>Inserimento di una nuova discussione</h1></div>
     <?php
     $check = true; //variabile di check
    
     if(empty($_POST['titolo']) || empty($_POST['primoPost']) || empty($_POST['descrizione'])){
        $check = false; 
     }
      
     if(isset($_POST['sottocategorie']) && $_POST['sottocategorie']=="altro"){
        if(empty($_POST['Sottcategoria']) || !isset($_POST['Sottocategoria'])){
            $check = false;
           // echo "<p>Sono qui</p>";
        }else{
            $check2 = true; //mi serve per dopo nella creazione della discussione nel file xml
            //qui posso già inserire la sottocategoria nel file xml dedicato

            //paranoicamente controlliamo che l'utente non abbia inserito una coppia categoria-sottocategoria già esistente
            $checkGiàInserita=false;

            //se il flag scritto sopra rimane false allora la inserisco, altrimenti non la inserisco ma uso comunque gli elementi html in ballo per 
            //operare sui dati
            $doc=caricaXML("sottocategorie.xml","");
                $sottoCategorie = $doc->getElementsByTagName('Sottocategoria');
                foreach ($sottoCategorie as $sottoCategoria) {
                   if($sottoCategoria->firstChild->textContent ==$_POST['Sottcategoria'] && $sottoCategoria->firstChild->nextSibling->textContent==$_POST['categoria']){
                    $checkGiàInserita=true;
                    break;
                   }
                }//end foreach




            if($checkGiàInserita==false){
            $xmlString = "";
            foreach ( file("../XML/sottocategorie.xml") as $node ) {
            $xmlString .= trim($node);
            } //end first foreach
            $doc = new DOMDocument();
            $doc->loadXML($xmlString);
            $root = $doc->documentElement;
            $elementi = $root->childNodes;

            $r = $doc->createElement('Sottocategoria');
                  

            $ele1 = $doc->createElement('nome');
            $ele1->nodeValue=$_POST['Sottcategoria'];
            $r->appendChild($ele1);

            $ele2 = $doc->createElement('categoriaDiRif');
            $ele2->nodeValue=$_POST['categoria'];
            $r->appendChild($ele2);

            $ele2 = $doc->createElement('inseritaDa');
            $ele2->nodeValue=$_SESSION['username'];
            $r->appendChild($ele2);

            $ele3 = $doc->createElement('dataInserimento');
            $ele3->nodeValue=date('Y-m-d');
            $r->appendChild($ele3);


            $root->appendChild($r); 

            if($doc->validate()) $doc->save("../XML/sottocategorie.xml");
            }//end check già inserita
            


        }//end else
    }//end if wrapper

        if(isset($_POST['categorieSpoiler']) && $_POST['categorieSpoiler']=="altroS"){
            if(empty($_POST['categoriaSpoilerCustom']) || !isset($_POST['categoriaSpoilerCustom'])){
                $check = false;
            }else{
                $check3 = true; //mi serve per dopo nella creazione della discussione nel file xml
                //qui posso già inserire la categoria di spoiler nel file dedicato
                //questa parte serve a caricare una categoria di spoiler inserita da un utente al momento di creazione di una discussione

                $checkGiàInserita = false;

                //paranoicamente controlliamo che un utente non abbia inserito come custom una categoria di spoiler  già esistente
                $doc=caricaXML("CategorieSpoiler.xml","");
                $categorieSpoiler = $doc->getElementsByTagName('CategoriaSpoiler');
                foreach ($categorieSpoiler as $categoriaS) {
                    $value1=$categoriaS->getElementsByTagName('nome')->item(0)->textContent;
                    if($value1 == $_POST['categoriaSpoilerCustom']){
                        $checkGiàInserita = true;
                        break;
                    }
                        
                   
                }//end foreach
                
              //se checkGiaInserita è vero allora non la inserisco, ma comunque uso gli elementi html dedicati per operare con i dati
              //altrimenti la inserisco
            if($checkGiàInserita==false){
                $xmlString = "";
                foreach ( file("../XML/CategorieSpoiler.xml") as $node ) {
                $xmlString .= trim($node);
                } //end first foreach
                $doc = new DOMDocument();
                $doc->loadXML($xmlString);
                $root = $doc->documentElement;
                $elementi = $root->childNodes;

                $r = $doc->createElement('CategoriaSpoiler');
                  
                $ele1 = $doc->createElement('nome');
                $ele1->nodeValue=$_POST['categoriaSpoilerCustom'];
                $r->appendChild($ele1);

                $ele2 = $doc->createElement('utenteCreatore');
                $ele2->nodeValue=$_SESSION['username'];
                $r->appendChild($ele2);

                $ele3 = $doc->createElement('dataInserimento');
                $ele3->nodeValue=date('Y-m-d');
                $r->appendChild($ele3);


                $root->appendChild($r); 

                if($doc->validate()) $doc->save("../XML/CategorieSpoiler.xml");
                else die("Errore generico!");
            }//end check già inserita

            
            }//end else
        }//end if wrapper


     //se sono qui posso procedere con l'inserimento dei dati
     if($check){
        $titolo = $_POST['titolo'];
        $primoPost=$_POST['primoPost'];
        $descrizione = $_POST['descrizione'];
        $xmlString = "";
                foreach ( file("../XML/Discussioni.xml") as $node ) {
                $xmlString .= trim($node);
                } //end first foreach
                $doc = new DOMDocument();
                $doc->loadXML($xmlString);
                $root = $doc->documentElement;
                $elementi = $root->childNodes;

                $r = $doc->createElement('discussione');

                if($root->childNodes->count()==0)
                $codiceDiscussione = 1;
                else $codiceDiscussione = ($root->childNodes->count())+1;

                //codice della discussione 
                $ele1 = $doc->createElement('codiceDiscussione');
                $ele1->nodeValue=$codiceDiscussione;
                $r->appendChild($ele1);

                //titolo 
                $ele1 = $doc->createElement('Titolo');
                $ele1->nodeValue=$_POST['titolo'];
                $r->appendChild($ele1);

                //tipo
                $ele2 = $doc->createElement('tipoDiscussione');
                $ele2->nodeValue=$_POST['tipoDiscussione'];
                $r->appendChild($ele2);

                //data creazione
                $ele3 = $doc->createElement('dataCreazioneD');
                $ele3->nodeValue=date('Y-m-d');
                $r->appendChild($ele3);

                //nome utente creatore
                $ele4 = $doc->createElement('nomeUtenteCreatoreDiscussione');
                $ele4->nodeValue=$_SESSION['username'];
                $r->appendChild($ele4);

                //media di riferimento
                $ele5 = $doc->createElement('MediaDiRiferimento');
                $ele5->nodeValue=$_POST['Media'];
                $r->appendChild($ele5);

                if($check2==false){
                    //se entro qui significa che non ho inserito sottocategorie custom
                    $dati = explode(",",$_POST['sottocategorie']);

                    //categoria di riferimento
                    $ele6 = $doc->createElement('Categoria');
                    $ele6->nodeValue=$dati[1];
                    $r->appendChild($ele6);

                    //sottocategoria
                    $ele7 = $doc->createElement('Sottocategoria');
                    $ele7->nodeValue=$dati[0];
                    $r->appendChild($ele7);

                }else{
                    //se sono qui significa che ho inserito sottocategorie custom
                    //categoria di riferimento
                    $ele6 = $doc->createElement('Categoria');
                    $ele6->nodeValue=$_POST['categoria'];
                    $r->appendChild($ele6);

                    //sottocategoria
                    $ele7 = $doc->createElement('Sottocategoria');
                    $ele7->nodeValue=$_POST['Sottcategoria'];
                    $r->appendChild($ele7);

                }//end else check2

                //se c'è spoiler lo inserisco altrimenti no
                if($_POST['sp']=="si"){
                    //qui ora faccio un'altro controllo, ovvero se devo inserire una categoria di spoiler creata dall'utente oppure una
                    //già esistente
                    if($check3==false){ //se sono qui significa che l'utente ha scelto una categoria di spoiler già esistente
                        $ele8 = $doc->createElement('CategoriaSpoiler');
                        $ele8->nodeValue=$_POST['categorieSpoiler'];
                        $r->appendChild($ele8);

                    }else{ //se invece sono qui l'utente ha inserito una categoria di spoiler nuova
                        $ele8 = $doc->createElement('CategoriaSpoiler');
                        $ele8->nodeValue=$_POST['categoriaSpoilerCustom'];
                        $r->appendChild($ele8);

                    }//end else check3

                    //ora tocca al livello di spoiler
                        $ele8 = $doc->createElement('SpoilerLevel');
                        $ele8->nodeValue=$_POST['livelloSpoiler'];
                        $r->appendChild($ele8);
                }//end if presenza spoiler

                //inseriamo ora la descrizione della discussione
                $desc = $_POST['descrizione'];
                $ele9 = $doc->createElement('Descrizione');
                $ele9->nodeValue=$desc;
                $r->appendChild($ele9);

                //questo tag per ora non avrà figli, verrà popolato quando il creatore della discussione 
                //eleggerà altri moderatori
                $ele10 = $doc->createElement('ModeratoriEletti');
                $ele10->nodeValue="";
                $r->appendChild($ele10);

                //prendiamo ora il tag lista post
                $ele111 = $doc->createElement('listaPost');
                $ele111->nodeValue="";
                
                //inseriamo ora il primo figlio di lista post
                $elePost = $doc->createElement('post');
                $elePost->nodeValue="";
                $ele111->appendChild($elePost);

                //ora inserisco i dati riguardanti il post

                $ele10 = $doc->createElement('codicePost');
                $ele10->nodeValue=1;
                $elePost->appendChild($ele10);

                $ele12 = $doc->createElement('utenteCreatorePost');
                $ele12->nodeValue=$_SESSION['username'];
                $elePost->appendChild($ele12);

                $ele13 = $doc->createElement('dataCreazione');
                $ele13->nodeValue=date("Y-m-d");
                $elePost->appendChild($ele13);

                $ele14 = $doc->createElement('oraCreazione');
                $ele14->nodeValue=date("H:i:s");
                $elePost->appendChild($ele14);

                $ele15 = $doc->createElement('testoPost');
                $ele15->nodeValue=$_POST['primoPost'];
                $elePost->appendChild($ele15);

                //per ora non inseriamo i file
                $ele16 = $doc->createElement('filePost');
                $ele16->nodeValue="";
                //questa parte è relativa al file uploader, se l'utente ha caricato file, li metto sia nel "server" che nel file xml(solo il nome...)
                if (isset($_FILES['files']) && count($_FILES['files']['name']) > 0) { //forse il controllo sul numero è un po' paranoico...
                foreach ($_FILES['files']['name'] as $file => $name) { //carico tutti i file inseriti dall'utente
                    $tmp_name = $_FILES['files']['tmp_name'][$file];
                    //qui volendo potrei scegliere di creare una directory dedicata per ogni post
                    $upload_dir = '../FilePostDiscussioni/';
                    $nome =  $codiceDiscussione."_"."1_".$name;//il nome del file avrà in aggiunta all'inizio il codice della discussione_codice post,//in questo 
                    //caso 1 poichè è il primo della della discussione
                    $destination = $upload_dir . basename($nome);
                    move_uploaded_file($tmp_name, $destination); //oppure possiamo usare anche copy
                    $ele = $doc->createElement('fileSrc');
                    $ele->nodeValue = $nome; 
                    $ele16->appendChild($ele); //appendo il figlio
                    
                 }//end foreach
                }//end if isset

                $elePost->appendChild($ele16); //inserisco ora file post

                $ele17 = $doc->createElement('valPostAccordanza');
                $ele17->nodeValue="";
                $elePost->appendChild($ele17);

                $ele18 = $doc->createElement('valPostUtilità');
                $ele18->nodeValue="";
                $elePost->appendChild($ele18);

                $ele19 = $doc->createElement('statoPost');
                $ele19->nodeValue="attivo";
                $elePost->appendChild($ele19);

                $r->appendChild($ele111); //inseriamo lista post e i suoi figli

                $ele19 = $doc->createElement('valutazioniDiscussioneAccordanza');
                $ele19->nodeValue="";
                $r->appendChild($ele19);

                $ele19 = $doc->createElement('valutazioniDiscussioneSpoiler');
                $ele19->nodeValue="";
                $r->appendChild($ele19);

                $ele19 = $doc->createElement('valutazioniDiscussioneUtilità');
                $ele19->nodeValue="";
                $r->appendChild($ele19);

                $ele19 = $doc->createElement('statoDiscussione');
                $ele19->nodeValue="attiva";
                $r->appendChild($ele19);

                $ele19 = $doc->createElement('utentiSospesi');
                $ele19->nodeValue="";
                $r->appendChild($ele19);



                $root->appendChild($r); //finalizzo l'inserimento della discussione

                if($doc->schemaValidate("../XML/schemiXSD/schemaDiscussioni.xsd")){ 
                $doc->save("../XML/Discussioni.xml");
                $_SESSION['titolo'] = $titolo;
                $_SESSION['codice']  = $codiceDiscussione;  
                header("Location: discussione.php");
            }
                else die("Errore generico!");

                //se tutto ok si viene reindirizzati alla pagina della discussione, ancora da implementare


       }else{
        //scriviamo dati mancanti
        //echo "<h2>Attenzione! Inserire tutti i dati!</h2>";
        //$check=true;
       // popUp('Attenzione! Dati Mancanti!');
       // $check=true;
      // header("Refresh:0");
      echo "<p>Dati mancanti!</p>";

     }
     ?>
<div class="containerP">

     
     <form id="form"  class="form1" action = "nuovaDiscussione.php" method="post"   enctype="multipart/form-data">
     <div class="colonnaGrandeC"><!--div1-->
            
            <p>Titolo della discussione: </p>
            <input type="text"  name="titolo" value='<?php echo $titolo ?>' />
            <p>Tipo della discussione: </p>
            <select name ="tipoDiscussione" class="selectCustom">
                <option value="Tutorial" <?php if(isset($_POST['tipoDiscussione']) && $_POST['tipoDiscussione'] == "Tutorial") echo 'selected="selected"';?>>Tutorial</option>
                <option value="Discussioni sulla lore" <?php if(isset($_POST['tipoDiscussione']) && $_POST['tipoDiscussione'] == "Discussioni sulla lore") echo 'selected="selected"';?>>Discussioni sulla lore</option>
                <option value="Richiesta di aiuto" <?php if(isset($_POST['tipoDiscussione']) && $_POST['tipoDiscussione'] == "Richiesta di aiuto") echo 'selected="selected"';?>>Richiesta di aiuto</option>
                <option value="Easter egg" <?php if(isset($_POST['tipoDiscussione']) && $_POST['tipoDiscussione'] == "Easter egg") echo 'selected="selected"';?>>Easter egg</option>
            </select>
            <p>Media: </p>
            <select class="selectCustom" name="Media">
                <option value="Fallout1" <?php if(isset($_POST['Media']) && $_POST['Media'] == "Fallout1") echo 'selected="selected"';?>>Fallout 1</option>
                <option value="Fallout2" <?php if(isset($_POST['Media']) && $_POST['Media'] == "Fallout2") echo 'selected="selected"';?>>Fallout 2</option>
                <option value="Fallout3" <?php if(isset($_POST['Media']) && $_POST['Media'] == "Fallout3") echo 'selected="selected"';?>>Fallout 3</option>
                <option value="Fallout4"<?php if(isset($_POST['Media']) && $_POST['Media'] == "Fallout4") echo 'selected="selected"';?>>Fallout 4</option>
                <option value="FalloutBOS"<?php if(isset($_POST['Media']) && $_POST['Media'] == "FalloutBOS") echo 'selected="selected"';?>>Fallout BOS</option>
                <option value="FalloutTactics"<?php if(isset($_POST['Media']) && $_POST['Media'] == "FalloutTactics") echo 'selected="selected"';?>>Fallout Tatics</option>
                <option value="FalloutNewVegas" <?php if(isset($_POST['Media']) && $_POST['Media'] == "FalloutNewVegas") echo 'selected="selected"';?>>Fallout New Vegas</option>
                <option value="FalloutSerieTv"<?php if(isset($_POST['Media']) && $_POST['Media'] == "FalloutSerieTv") echo 'selected="selected"';?>>Fallout Serie Tv</option>
            </select>
            <p>Categoria e sottocategoria: </p>

            <select name="sottocategorie" class="selectCustom">
            <optgroup label="Personaggi e Luoghi" onclick="sparisci('sottoCategoriaCustom')">
                <?php
                $string = 'sottoCategoriaCustom'; //serve per il div a scomparsa
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
            <optgroup label="Mods" onclick="sparisci('sottoCategoriaCustom')">
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
            <optgroup label="Problemi Tecnici e Bugs" onclick="sparisci('sottoCategoriaCustom')">
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
            <optgroup label="Guide e Soluzioni" onclick="sparisci('sottoCategoriaCustom')">
                
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
                }//end foreach?>
                
                
            
                
            </optgroup>
            <option  value="altro" onclick="visibile('sottoCategoriaCustom')">Altro</option>
        </select>
        
        <div id="sottoCategoriaCustom" style="visibility:hidden" >
        <p>Categoria di riferimento: </p>
        <select class="selectCustom" name="categoria">
                <option value="Personaggi e Luoghi" <?php if(isset($_POST['categoria']) && $_POST['categoria'] == "Personaggi e Luoghi") echo 'selected="selected"';?>>Personaggi e Luoghi</option>
                <option value="Mods" <?php if(isset($_POST['categoria']) && $_POST['categoria'] == "Mods") echo 'selected="selected"';?>>Mods</option>
                <option value="Problemi Tecnici e Bugs" <?php if(isset($_POST['categoria']) && $_POST['categoria'] == "Problemi Tecnici e Bugs") echo 'selected="selected"';?>>Problemi Tecnici e Bugs</option>
                <option value="Guide e Soluzioni"<?php if(isset($_POST['categoria']) && $_POST['categoria'] == "Guide e Soluzioni") echo 'selected="selected"';?>>Guide e Soluzioni</option>
               
        </select><div>
        <input type="text" name ="Sottcategoria" /></div>
        
        </div>
            <div id ="anteprima"></div>
            
        
     </div><!--chiusura div1-->
     <div class="colonnaGrandeCR">
        <p>Presenza spoiler?</p>
        <select name ="sp" class="selectCustom">
        <option value="si" <?php if(isset($_POST['sp']) && $_POST['sp'] == "si") echo 'selected="selected"';?> onclick="visibile('spoiler')">Si</option>
        <option value="no" <?php if(isset($_POST['sp']) && $_POST['sp'] == "no") echo 'selected="selected"';?> onclick="sparisciSpeciale('spoiler','catSpoilerCustom')">No</option>
        </select>

        <div id="spoiler" style="visibility:visible">
            <p>Categoria Spoiler: </p>
            <select name ="categorieSpoiler"  class="selectCustom">
                <optgroup label="Categorie di Spoiler" onclick="sparisci('catSpoilerCustom')">
            <?php
                $doc=caricaXML("CategorieSpoiler.xml","");
                $categorieSpoiler = $doc->getElementsByTagName('CategoriaSpoiler');
                foreach ($categorieSpoiler as $categoriaS) {
                    
                        $value = $categoriaS->firstChild->textContent;
                        
                        if(isset($_POST['categorieSpoiler']) && $_POST['categorieSpoiler'] == $value){
                            echo "<option value='$value' selected='selected'>".$value."</option>";
                        }else{
                            echo "<option value='$value'>".$value."</option>";
                        }//end else sottocategorie
                   
                }//end foreach?>
                </optgroup>
                <option  value ="altroS" onclick="visibile('catSpoilerCustom')">Altro</option>
                
                </select>
                <div id="catSpoilerCustom" style="visibility:hidden">
                    <p>Nome della categoria: </p>
                    <input type ="text"  name ="categoriaSpoilerCustom"/>
                </div>
                <p>Livello Spoiler: </p>
                <select name="livelloSpoiler" class="selectCustom">
                    <option value="1" <?php if(isset($_POST['livelloSpoiler']) && $_POST['livelloSpoiler'] == 1) echo 'selected="selected"'; ?>>&#9733;&#9734;&#9734;&#9734;&#9734;</option>
                    <option value="2" <?php if(isset($_POST['livelloSpoiler']) && $_POST['livelloSpoiler'] == 2) echo 'selected="selected"'; ?>>&#9733;&#9733;&#9734;&#9734;&#9734;</option>
                    <option value="3" <?php if(isset($_POST['livelloSpoiler']) && $_POST['livelloSpoiler'] == 3) echo 'selected="selected"'; ?>>&#9733;&#9733;&#9733;&#9734;&#9734;</option>
                    <option value="4" <?php if(isset($_POST['livelloSpoiler']) && $_POST['livelloSpoiler'] == 4) echo 'selected="selected"'; ?>>&#9733;&#9733;&#9733;&#9733;&#9734;</option>
                    <option value="5" <?php if(isset($_POST['livelloSpoiler']) && $_POST['livelloSpoiler'] == 5) echo 'selected="selected"'; ?>>&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                </select>
        </div><!--div id spoiler-->

        <p>Descrizione della discussione: </p>
        <textarea name="descrizione" rows="10" cols="50"><?php echo $descrizione ?></textarea>

        <p>Inserisci il primo post</p>
        <p>Testo</p>
        <textarea name="primoPost" rows="10" cols="50" ><?php echo $primoPost ?></textarea>
        <p>Inserisci eventuali foto o video(massimo due file): </p>
        <input type="file" id="fileInput" name="files[]" multiple="multiple" accept="image/png,image/jpeg,image/jpg,image/gif,video/*"/>





        <input type="submit" name="inserisci" value="Inserisci Discussione" />
       

        <input type="reset" value="annulla" />
       
     </div>
     </form>
     
     
   </div><!--chiusura div wrapper-->
   

   
   
   
   
   
  
    
    

    
     
     
</body>


</html> 