<?php require "funzioniUtili.php";
$doc=caricaXML("sottocategorie.xml","");
                //$root = $doc->documentElement; //prendo gli elementi di doc
                //$sottocategorie = $root->childNodes; //prendo le sottocategorie
                $sottoCategorie = $doc->getElementsByTagName('Sottocategoria');
                foreach ($sottoCategorie as $sottoCategoria) {
                    if($sottoCategoria->firstChild->nextSibling->textContent == "Personaggi e Luoghi"){
                        $nomeSottoCategoria = $sottoCategoria->firstChild->textContent;
                        //if(isset($_POST['sottocategorie']) && $_POST['sottocategorie'] == $nomeSottoCategoria){
                          //  echo "<option value='$nomeSottoCategoria' selected='selected'>".$nomeSottoCategoria."</option>";
                       // }else{
                            echo "<h1>".$nomeSottoCategoria."</h1>'";
                        //}//end else sottocategorie
    
                        
                   
                    }
                }//end foreach