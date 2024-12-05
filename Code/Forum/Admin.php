<?xml version="1.0" encoding="UTF-8"?>
<!--Questa è la pagina scheletro di ogni bacheca personale-->
<?php
session_start(); 
require "riferimento.php";
if(isset($_SESSION['codice'])) unset($_SESSION['codice']);
if(isset($_SESSION['codDiscussione'])) unset($_SESSION['codDiscussione']);
if(isset($_SESSION['titolo'])) unset($_SESSION['titolo']);
require "funzioniUtili.php";
require "connection1.php";
if(isset($_SESSION['username'])){
    if(ritornaRuolo($_SESSION['username']) == 0){
        header("Location: ../homepage.php"); //gli utenti normali non possono entrare qui 
    }else{
        //se sono qui prendo i vari dati dell'admin
        $username = $_SESSION['username'];
        $sql = "select * from utenti where nomeUtente='$username'";
        $result=mysqli_query($conn,$sql);
        if($result){
           // echo "sono qui";
            while($row = mysqli_fetch_array($result)){
                //prendo tutti i dati dell'utente
               // echo $row['nomeUtente'];
                $avatar=$row['nomeFileAvatar'];
                $email_user=$row['email'];
                //ricordiamo che l'admin ha come livello di reputazione sovrintendente
            }
        }//end if result
        
        $path = "../Avatar/".$avatar;
    }

}else{
    header('Location: ../reservedArea.php');
} ?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Admin</title> 
    <link rel ="stylesheet" href="../CSS/adminStile.css" type = "text/css" />
    <link rel ="stylesheet" href="../CSS/gestioneSegnalazioni.css" type = "text/css" />
    <link rel ="stylesheet" href="../CSS/bachecapersonale.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <script type="text/javascript" src="../JS/popUp.js"></script>
    <script type="text/javascript" src="../JS/onchange1.js"></script>
<!--<script type="text/javascript" src="../JS/controllaInput.js"></script>-->
    <script type="text/javascript" src="../JS/controllaInputMS.js"></script>
    <script type="text/javascript" src="../JS/controllaInputSI.js"></script>
    <script type="text/javascript" src="../JS/controllaInputSott.js"></script> 

 

   
    
    
</head>
<body>
<?php require "mostraNavBar1.php"; //echo "<div class='topnav'><a href='../logout.php'>Logout</a><a href='../homepage.php'>Pagina iniziale</a><a href='forumHP.php'>Forum</a><a href='regGenerali.php'>Regole Generali</a><a href='../fallout1.php'>Fallout 1</a><a href='../fallout2.php'>Fallout 2</a><a href='../fallout3.php'>Fallout 3</a><a href='../fallout4.php'>Fallout 4</a><a href='../falloutT.php'>Fallout Tactics</a><a href='../falloutB.php'>Fallout Brotherhood Of Steel</a><a href='../falloutN.php'>Fallout New Vegas</a><a href='../fallout76.php'>Fallout 76</a><a href='../falloutS.php'>Fallout Serie TV</a><a href='discussioni.php'>Discussioni</a><a href='nuovaDiscussione.php'>Nuova discussione</a><a href='gestioneUtenti.php'>Gestione Utenti</a><a href='gestioneCategorie.php'>Gestione categorie e sottocategorie</a></div>";?>


</body>
<div class='container'>
   
            <?php
            //controllo ora le pressioni dei tasti
        if(isset($_POST['discussione'])){
            $_SESSION['codice'] = $_POST['codDiscussione'];
            header("Location: discussione.php");
        }

        if(isset($_POST['sgn'])){
            $_SESSION['codice'] = $_POST['codDiscussione'];
            header("Location: gestioneSegnalazioniDiscussione.php");
        }

        if(isset($_POST['elimina'])){
            //qui elimino proprio fisicamente dal file xml la discussione
            eliminaDiscussione($_POST['codDiscussione']);
            $_POST['cerca'] = true;
           popUp1('Operazione Riuscita!')  ;     
        }

        if(isset($_POST['sospendi'])){
            operaSuDiscussione(1,$_POST['codDiscussione']);
            popUp1('Operazione Riuscita!')  ; 
            $_POST['cerca'] = true;
        }

        if(isset($_POST['attiva'])){
            operaSuDiscussione(0,$_POST['codDiscussione']);
            popUp1('Operazione Riuscita!')  ; 
            $_POST['cerca'] = true;
        }






            if(isset($_SESSION['Media'])) $_POST['cerca']=true;
            
            echo "<img src='$path' class='immagineCornice' alt='$avatar'/>";
            ?>
        </div>
        <div class="container">
        <?php
        /*echo'<p style="color:green;"> Username: '.$username.'</p><br>';
        echo'<p style="color:green;"> Email: '.$email_user.'  '.'</p>';
        echo'<p style="color:green;">'.'  '.' Punti Reputazione: '.$livelloReputazione.'  -->  '.' Stato Reputazione:'.statoReputazione($livelloReputazione) .'</p>';
       // echo "<img src='$path' class='immagineCornice'/>";*/

       echo '<table><thead>';
       echo '<tr><th>Nome Utente</th><th>Email</th><th>Punti </th></tr></thead>';
       echo '<tbody>';
       echo '<tr>';
       echo '<td>'.$username.'</td>';
       echo '<td >'.$email_user.'</td>';
       echo '<td>Sovrintendente</td>'; //lo mettiamo cosi hard-coded
      // echo '<td>'.statoReputazione($livelloReputazione).'</td>';
       echo '</tr>';
       echo '</tbody>';
       echo '</table>'
    
        ?>

        <button class="button2" onclick="window.location='cambiaDati.php'">Cambia i tuoi dati</button>
       
        
    </div>
    <!-- Qui faccio vedere le discussioni per dare la possibilità all'admin di eliminarle, viene fatta una divisione 
     solo per media -->
     <div class="centrato">
     <?php if(isset($_POST['Media'])) $_SESSION['Media']=$_POST['Media']?>
        
        
     <form action = "Admin.php" method = "post">
            <div>
            <select class="selectCustom"  name="Media">
                 <?php  ?>

<option value="Fallout1" <?php if((isset($_POST['Media']) && $_POST['Media'] == "Fallout1")  || (isset($_SESSION['Media']) && $_SESSION['Media']=='Fallout1')){echo 'selected="selected"'; } ?>>Fallout 1</option>
<option value="Fallout2" <?php if((isset($_POST['Media']) && $_POST['Media'] == "Fallout2") || (isset($_SESSION['Media']) && $_SESSION['Media']=='Fallout2')) echo 'selected="selected"';?>>Fallout 2</option>
<option value="Fallout3" <?php if((isset($_POST['Media']) && $_POST['Media'] == "Fallout3") || (isset($_SESSION['Media']) && $_SESSION['Media']=='Fallout3')) echo 'selected="selected"';?>>Fallout 3</option>
<option value="Fallout4"<?php if((isset($_POST['Media']) && $_POST['Media'] == "Fallout4") || (isset($_SESSION['Media']) && $_SESSION['Media']=='Fallout4')) echo 'selected="selected"';?>>Fallout 4</option>
<option value="FalloutBOS"<?php if((isset($_POST['Media']) && $_POST['Media'] == "FalloutBOS") || (isset($_SESSION['Media']) && $_SESSION['Media']=='FalloutBOS')) echo 'selected="selected"';?>>Fallout BOS</option>
<option value="FalloutTactics"<?php if((isset($_POST['Media']) && $_POST['Media'] == "FalloutTactics") || (isset($_SESSION['Media']) && $_SESSION['Media']=='FalloutTactics')) echo 'selected="selected"';?>>Fallout Tactics</option>
<option value="FalloutNewVegas" <?php if((isset($_POST['Media']) && $_POST['Media'] == "FalloutNewVegas") || (isset($_SESSION['Media']) && $_SESSION['Media']=='FalloutNewVegas')) echo 'selected="selected"';?>>Fallout New Vegas</option>
<option value="FalloutSerieTv"<?php if((isset($_POST['Media']) && $_POST['Media'] == "FalloutSerieTv") || (isset($_SESSION['Media']) && $_SESSION['Media']=='FalloutSerieTv')) echo 'selected="selected"';?>>Fallout Serie Tv</option>
<option value="ricategorizzare"<?php if((isset($_POST['Media']) && $_POST['Media'] == "ricategorizzare") || (isset($_SESSION['Media']) && $_SESSION['Media']=='ricategorizzare')) echo 'selected="selected"';?>>Da ricategorizzare</option>
</select>


<input type = "submit" class="button" name ="cerca" value = "cerca">
            </div>
        </form>
     </div>
     <?php  if(isset($_POST['media'])){
  /*  $_SESSION['codDiscussione'] = $_POST['codDiscussione']; $_SESSION['cerca'] =$_POST['cerca'];*/
   //if(isset($_POST['Media'])) $_SESSION['Media'] = $_POST['Media'];
   $_SESSION['codice'] = $_POST['codDiscussione'];
            echo '<div id="overlay"></div>';
    echo '<div id="popup">';
    echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
    echo '<h3>Nuovo Media </h3>';
    echo '<p class="testoGenerico">Attuale: '.ritornaMedia($_POST['codDiscussione'])."</p>";
    echo '<form id="popupForm" action="nuovoMedia.php" method="POST" >';
    echo '<label for="selectCustom">Nuovo:</label>';
    echo ' <select class="selectCustom"  name="MediaNew"><option value="Fallout1" >Fallout 1</option><option value="Fallout2">Fallout 2</option><option value="Fallout3" >Fallout 3</option><option value="Fallout4">Fallout 4</option><option value="FalloutBOS">Fallout BOS</option><option value="FalloutTactics">Fallout Tactics</option><option value="FalloutNewVegas" >Fallout New Vegas</option><option value="FalloutSerieTv">Fallout Serie Tv</option></select><input type = "submit" class="button" name ="inviaNM" value = "Invia">';

    echo '</form>';
    echo '</div>'; $_POST['cerca'] = true;
        }

        if(isset($_POST['spI'])){
            $_SESSION['codice'] = $_POST['codDiscussione']; 
            echo '<div id="overlay"></div>';
            echo '<div id="popup">';
            echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
            echo '<h3>Nuovo spoiler </h3>';
            echo '<form id="popupForm" action="nuovoSpoiler.php" method="POST" onsubmit="preventSI(event)" >';
            echo '<p class="testoGenerico">Nuovo:</p>';
            $doc=caricaXML("CategorieSpoiler.xml","");
            $categorieSpoiler = $doc->getElementsByTagName('CategoriaSpoiler');
            echo '<select id = "select2" name = "categorieSpoiler" class="selectCustom" onchange = "onchangeSpoilerCustom1()">';
            foreach($categorieSpoiler as $categoria){
                $value = $categoria->getElementsByTagName('nome')->item(0)->nodeValue;
                echo "<option value='$value'>".$value."</option>";
                
            }
            echo "<option value='altroS'>Altro</option>";
          // echo '<div id="catSpoilerCustom" style="visibility:hidden" ><p class="testoGenerico">Nome della categoria: </p><input type ="text"  name ="categoriaSpoilerCustom" />';
            echo '</select>';
            echo '<p class="testoGenerico">Livello spoiler: </p>' ;
            echo ' <select name="livelloSpoiler" class="selectCustom">';
            echo ' <option value="1" >&#9733;&#9734;&#9734;&#9734;&#9734;</option>';
            echo ' <option value="2" >&#9733;&#9733;&#9734;&#9734;&#9734;</option>';
            echo ' <option value="3" >&#9733;&#9733;&#9733;&#9734;&#9734;</option>';
            echo'  <option value="4" >&#9733;&#9733;&#9733;&#9733;&#9734;</option>';
            echo ' <option value="5" >&#9733;&#9733;&#9733;&#9733;&#9733;</option>';
             echo '</select>';
            echo '<div id = "catSpoilerCustom" style="visibility:hidden;">';
            echo '<p class="testoGenerico">Nome categoria: </p>';
            echo '<input id = "text2" type = "text" name = "csc" />';
            echo '</div>';
            echo '<input id = "myButton2" type = "submit"  value ="invia" />';
        
            echo '</form>';
            echo '</div>'; $_POST['cerca'] = true;
                }//end spI

                if(isset($_POST['spM'])){
                    $_SESSION['cS'] = $_POST['cS'];  $_SESSION['codice'] = $_POST['codDiscussione'];
                    echo '<div id="overlay"></div>';
                    echo '<div id="popup">';
                    echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
                    echo '<h3>Nuovo  spoiler </h3>';
                    echo '<form id="popupForm" action="nuovoSpoilerM.php" method="POST" onsubmit="preventMS(event)" >';
                    echo '<p class="testoGenerico">Nuovo:</p>';
                    $doc=caricaXML("CategorieSpoiler.xml","");
                    $categorieSpoiler = $doc->getElementsByTagName('CategoriaSpoiler');
                    echo '<select id = "select1" name = "categorieSpoiler" class="selectCustom" onchange = "onchangeSpoilerCustom1()">';
                    foreach($categorieSpoiler as $categoria){
                        $value = $categoria->getElementsByTagName('nome')->item(0)->nodeValue;
                        echo "<option value='$value'>".$value."</option>";
                        
                    }
                    echo "<option value='altroS'>Altro</option>";
                  // echo '<div id="catSpoilerCustom" style="visibility:hidden" ><p class="testoGenerico">Nome della categoria: </p><input type ="text"  name ="categoriaSpoilerCustom" />';
                    echo '</select>';
                    echo '<p class="testoGenerico">Livello spoiler: </p>' ;
                    echo ' <select name="livelloSpoiler" class="selectCustom">';
                    echo ' <option value="1" >&#9733;&#9734;&#9734;&#9734;&#9734;</option>';
                    echo ' <option value="2" >&#9733;&#9733;&#9734;&#9734;&#9734;</option>';
                    echo ' <option value="3" >&#9733;&#9733;&#9733;&#9734;&#9734;</option>';
                    echo'  <option value="4" >&#9733;&#9733;&#9733;&#9733;&#9734;</option>';
                    echo ' <option value="5" >&#9733;&#9733;&#9733;&#9733;&#9733;</option>';
                     echo '</select>';
                    echo '<div id = "catSpoilerCustom" style="visibility:hidden;">';
                    echo '<p class="testoGenerico">Nome categoria: </p>';
                    echo '<input id ="text1" type = "text" name = "csc" />';
                    echo '</div>';
                    
                    echo '<p class="testoGenerico">Elimina categoria precedente: </p>' ;
                    echo '<select name = "categoriaPrecedente">';
                    echo '<option value="no">No</option>';
                    echo '<option value="si">Si</option>';
                    echo '</select>';
                    echo '<input id="myButton1" type = "submit"  value = "invia" />';
                    echo '</form>';
                    echo '</div>'; $_POST['cerca'] = true;


                }//end isset spM


                //gestione modifica categorie/sottocategorie
                if(isset($_POST['categoriaSott'])){
                    $_SESSION['cat'] = $_POST['cat'];  $_SESSION['codice'] = $_POST['codDiscussione'];
                    $_SESSION['sottoC'] = $_POST['sottoC'];
                    echo '<div id="overlay"></div>';
                    echo '<div id="popup">';
                    echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
                    echo '<h3>Categoria/sottocategoria </h3>';
                    echo '<form id="popupForm" action="cat.php" method="POST" onsubmit="preventSott(event)" >';
                    echo '<p class="testoGenerico">Nuova:</p>';
                    $doc=caricaXML("sottocategorie.xml","");
                    $sottocategorie = $doc->getElementsByTagName('Sottocategoria');
                    echo '<select id = "select3" name = "categoriaSottoCategoria" class="selectCustom" onchange = "onchangeCategoria()">';
                    foreach($sottocategorie as $sottocategoria){
                        $nome = $sottocategoria->getElementsByTagName('nome')->item(0)->nodeValue;
                        $rif = $sottocategoria->getElementsByTagName('categoriaDiRif')->item(0)->nodeValue;
                        $value = $nome.":".$rif;
                        echo "<option value='$value'> ".$rif." : ".$nome."</option>";
                    }
                    echo "<option value='altroC'>Altro</option>";
                  // echo '<div id="catSpoilerCustom" style="visibility:hidden" ><p class="testoGenerico">Nome della categoria: </p><input type ="text"  name ="categoriaSpoilerCustom" />';
                    echo '</select>';
                    
                    echo '<div id = "catCustom" style="visibility:hidden;">';
                    echo '<p class="testoGenerico">Categoria di riferimento: </p>';
                    echo '<select class="selectCustom" name="categoria1">';
               echo ' <option value="Personaggi e Luoghi">Personaggi e Luoghi</option>';
               echo ' <option value="Mods" >Mods</option>';
                echo '<option value="Problemi Tecnici e Bugs" >Problemi Tecnici e Bugs</option>';
                echo '<option value="Guide e Soluzioni">Guide e Soluzioni</option>';
               
        echo '</select>';
        echo '<p class="testoGenerico">Sottocategoria: </p>';
                    echo '<input id ="text3" type = "text" name = "stc" />';
                    echo '</div>';
                    
                    echo '<p class="testoGenerico">Elimina categoria precedente: </p>' ;
                    echo '<select name = "categoriaPrecedenteEl">';
                    echo '<option value="no">No</option>';
                    echo '<option value="si">Si</option>';
                    echo '</select>';
                    echo '<input id="myButton3" type = "submit"  value = "invia" />';
                    echo '</form>';
                    echo '</div>'; $_POST['cerca'] = true;

                }//end if isset
        





         ?>
    
    <div class="colonnaGrandeScroll">
       
        <?php
        if(isset($_POST['cerca']) || isset($_SESSION['cerca'])){
           if(isset($_POST['Media'])) $_SESSION['Media'] = $_POST['Media'];
          
        $conta = 0;
         $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
         $discussioni = $doc->getElementsByTagName('discussione'); //prendo tutte le discussioni
         foreach($discussioni as $discussione){
            $spoiler = false;
            $categoriaRif = $discussione->getElementsByTagName('Categoria')->item(0)->nodeValue;
            $sottocategoria = $discussione->getElementsByTagName('Sottocategoria')->item(0)->nodeValue;
            if($discussione->getElementsByTagName('CategoriaSpoiler')->count()>0)
            if($discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue != null){
                $categoriaSpoiler = $discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue;
                $livelloSpoiler = $discussione->getElementsByTagName('SpoilerLevel')->item(0)->nodeValue;
                $spoiler=true;
            }else $spoiler = false ;//$spoiler è un flag che mi servirà dopo per la stampa 

            //filtro per vedere le discussioni
            if(isset($_POST['Media']) ){ 
                if($_POST['Media']=='ricategorizzare'){
                    if($spoiler){
                        if( $categoriaSpoiler!='ricategorizzare' && $categoriaRif !='ricategorizzare' && $sottocategoria!='ricategorizzare'){
                            continue;
                        }
                    }else{
                        if(  $categoriaRif !='ricategorizzare' && $sottocategoria!='ricategorizzare'){
                            continue;
                        }
                    }

                }else{if(   $discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->nodeValue != $_POST["Media"]) continue; }
                
            }else{
                if($_SESSION['Media']=='ricategorizzare'){
                    if($spoiler){
                        if( $categoriaSpoiler!='ricategorizzare' && $categoriaRif !='ricategorizzare' && $sottocategoria!='ricategorizzare'){
                            continue;
                        }
                    }else{
                        if(  $categoriaRif !='ricategorizzare' && $sottocategoria!='ricategorizzare'){
                            continue;
                        }
                    }
                }else{if(  $discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->nodeValue != $_SESSION["Media"])continue; }
                
            }
            
            
           /* if($discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->nodeValue != $_POST["Media"]) continue; 
            }else{
                if($discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->nodeValue != $_SESSION["Media"]) continue; 
            }*/
            //mostro solo i dati essenziali per l'admin
            $conta++;
            $stato = $discussione->getElementsByTagName('statoDiscussione')->item(0)->nodeValue;
            $dataCreazione = $discussione->getElementsByTagName('dataCreazioneD')->item(0)->nodeValue;
            $tipoDiscussione = $discussione->getElementsByTagName('tipoDiscussione')->item(0)->nodeValue;
            $titolo =$discussione->firstChild->nextSibling->textContent;
            $numeroPost = $discussione->getElementsByTagName('listaPost')->item(0)->childNodes->count(); //numero di post
            $creatoreDiscussione = $discussione->getElementsByTagName('nomeUtenteCreatoreDiscussione')->item(0)->nodeValue;
            $descrizioneDiscussione = $discussione->getElementsByTagName('Descrizione')->item(0)->nodeValue;
            $media = $discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->nodeValue;
            
            
           
           
            

         /*   if($spoiler==true){
                if($_POST['Media']=='ricategorizzare' && $categoriaSpoiler!='ricategorizzare' && $categoriaRif !='ricategorizzare' && $sottocategoria!='ricategorizzare'){
                    continue;
                }

            }else{
                if($_POST['Media']=='ricategorizzare'  && $categoriaRif !='ricategorizzare' && $sottocategoria!='ricategorizzare'){
                    continue;
                }

            }*/
            
           

       /* if($bandiera==false){
            if($discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->nodeValue != $_POST["Media"]){
                continue;
            }else{
                if($discussione->getElementsByTagName('MediaDiRiferimento')->item(0)->nodeValue != $_SESSION["Media"]){continue;} 
            }
        }*/
    


            
            //ora stampo i dati 
            echo '<p class="testoGenerico">Titolo: '.$titolo.'</p>';
            echo '<p class="testoGenerico">Stato: '.$stato.'</p>';
            echo '<p class="testoGenerico">Tipo: '.$tipoDiscussione.'</p>';
            echo '<p class="testoGenerico">Creata da: '.$creatoreDiscussione.'</p>';
            echo '<p class="testoGenerico">Data creazione: '.$dataCreazione.'</p>';
            echo '<p class="testoGenerico">Numero di post: '.$numeroPost.'</p>';
            echo '<p class="testoGenerico">Media: '.$media.'</p>';
            echo '<p class="testoGenerico">Categoria: '.$categoriaRif.'</p>';
            echo '<p class="testoGenerico">Sottocategoria: '.$sottocategoria.'</p>';
            echo '<p class="testoGenerico">Descrizione: '.$descrizioneDiscussione.'</p>';
            if($spoiler){
                echo '<p class="testoGenerico">Tipo spoiler: '.$categoriaSpoiler.'</p>';
                $val = $discussione->getElementsByTagName('SpoilerLevel')->item(0)->nodeValue;
                        echo "<p>Livello Spoiler:";
                        for($i=0; $i<$val; $i++)
                            echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                        for($i=0; $i<(5-$val); $i++)
                            echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                        echo "</p>";
            }else echo '<p class="testoGenerico">Spoiler non presente</p>';
           //echo '<div class="sinistra">';
            //se ha valutazioni le stampo
            if($discussione->getElementsByTagName('valutazioniDiscussioneSpoiler')->item(0)->childNodes->count()){
                $codice = $discussione->firstChild->nodeValue;
                $media = mediaValutazioni($codice,'valutazioniDiscussioneSpoiler');
                 
               // echo "<h3>Ecco cosa ne pensano gli utenti: </h3>";
                if($media!=0){
                echo "<p class='testoGenerico'>Media Valutazioni Spoiler:";
                for($i=0; $i<$media; $i++)
                    echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                for($i=0; $i<(5-$media); $i++)
                    echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                echo "</p>";}
            }//end if valutazioni discussione 

            if($discussione->getElementsByTagName('valutazioniDiscussioneAccordanza')->item(0)->childNodes->count()){
                $codice = $discussione->firstChild->nodeValue;
                $media = mediaValutazioni($codice,'valutazioniDiscussioneAccordanza');
                 
               // echo "<h3>Ecco cosa ne pensano gli utenti: </h3>";
                if($media!=0){
                echo "<p class='testoGenerico'>Media Valutazioni Accordanza:";
                for($i=0; $i<$media; $i++)
                    echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                for($i=0; $i<(5-$media); $i++)
                    echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                echo "</p>";}
            }//end if valutazioni discussione 

            if($discussione->getElementsByTagName('valutazioniDiscussioneUtilità')->item(0)->childNodes->count()){
                $codice = $discussione->firstChild->nodeValue;
                $media = mediaValutazioni($codice,'valutazioniDiscussioneUtilità');
                 
               // echo "<h3>Ecco cosa ne pensano gli utenti: </h3>";
                if($media!=0){
                echo "<p class='testoGenerico'>Media Valutazioni Utilità:";
                for($i=0; $i<$media; $i++)
                    echo "<span>&#9733;</span>";            //&#9733; è il codice per la stella piena
                for($i=0; $i<(5-$media); $i++)
                    echo "<span>&#9734;</span>";            //&#9734; è il codice per la stella vuota
                echo "</p>";}
            }//end if valutazioni discussione 
           // echo '</div>';

            //ora creaiamo una solta di pulsantiera per gestire i dati della discussione, ad esempio categoria ecc...
            
            echo '<form action = "Admin.php" method = "post">';
            echo '<div>';
            echo '<input class="button1" type="submit" name = "discussione" value="Vai alla discussione" />';
            echo '<input class="button1" type="submit" name = "sgn" value="Segnalazioni discussione" />';
            echo '<input class="button1" type="submit" name = "media" value="cambiaMedia" />';
            echo '<input class="button1" type="submit" name = "categoriaSott" value="Categoria/sottocategoria" />';
            if($stato == 'attiva')
            echo '<input class="button1" type="submit" name = "sospendi" value="Sospendi discussione" />';
            else
            echo '<input class="button1" type="submit" name = "attiva" value="Attiva discussione" />';
            echo '<input class="button1" type="submit" name = "elimina" value="Elimina discussione" />';
            if($discussione->getElementsByTagName('CategoriaSpoiler')->count()==0){
            echo '<input class="button1" type="submit" name = "spI" value="Inserisci spoiler" />';}
        else {echo '<input class="button1" type="submit" name = "spM" value="Modifica Spoiler" />';
            echo "<input type='hidden' name='cS' value='".$discussione->getElementsByTagName('CategoriaSpoiler')->item(0)->nodeValue."'/>";
        }
        echo "<input type='hidden' name='sottoC' value='".$discussione->getElementsByTagName('Sottocategoria')->item(0)->nodeValue."'/>";
        echo "<input type='hidden' name='cat' value='".$discussione->getElementsByTagName('Categoria')->item(0)->nodeValue."'/>";
        echo "<input type='hidden' name='codDiscussione' value='".$discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue."'/>";
            echo '</div>';
            echo '</form>';
           
            echo '<hr />';

            
         }//end foreach
         if($conta == 0) echo '<h1>Non ci sono discussioni inerenti a  questo media </h1>';
       
        
        }//end if isset cerca 

        

        

       

       

       
    
        ?>

    </div>

    

</html>