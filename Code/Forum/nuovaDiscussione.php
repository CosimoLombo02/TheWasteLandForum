<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Nuova Discussione</title> 
    <!--<link rel="stylesheet" href="foglioDiStile.css " type="text/css" /></head>-->
    <link rel ="stylesheet" href="../CSS/discussioni.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <script type="text/javascript" src="../JS/sottoCategoriaCustom.js"></script> <!--piccolo script che serve per far comparire dei div-->
    <script type="text/javascript" src="../JS/sparisci.js"></script>
</head>
<body>
    
    <?php
    session_start();
     //if(!isset($_SESSION['username'])){
         //qui non ci posso accedere se non ho fatto il login
         //session_destroy(); //distruggo la sessione e reindirizzo alla pagina di login
        // header("Location: ../reservedArea.php");
     //}//end 
     require "funzioniUtili.php";
     ?>
     <div class="container"><h1>Inserimento di una nuova discussione</h1></div>
<div class="containerP">
     <div class="colonnaGrandeC"><!--div1-->
        
        <form action = "nuovaDiscussione.php" method="post">
            <p>Titolo della discussione: </p>
            <input type="text" width="100" name="titolo" />
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
            <optgroup label="Personaggi e Luoghi"onclick="sparisci('sottoCategoriaCustom')">
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
            <option name="altro" value="altro" onclick="visibile('sottoCategoriaCustom')">Altro</option>
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
            
            
        </form>
     </div><!--chiusura div1-->
     <div class="colonnaGrandeCR">
        <p>Caoiaiaai</p>
     </div>
     </div><!--chiusura div wrapper-->
    
    

    


</body>


</html> 