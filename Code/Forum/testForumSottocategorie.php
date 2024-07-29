<?php
                $doc=caricaXML("sottocategorie.xml","");
                $sottoCategorie = $doc->getElementsByTagName('Sottocategoria');
                foreach ($sottoCategorie as $sottoCategoria) {
                    if($sottoCategoria->firstChild->nextSibling->textContent == "Personaggi e Luoghi"){
                        $nomeSottoCategoria = $sottoCategoria->firstChild->textContent;
                        $value=$nomeSottoCategoria.","."Personaggi e Luoghi";
                        //if(isset($_POST['sottocategorie']) && $_POST['sottocategorie'] == $value){
                            echo "<option value='$value' selected='selected'>"."Personaggi e Luoghi: ".$nomeSottoCategoria."</option>";
                       // }else{
                            echo "<option value='$value'>"."Personaggi e Luoghi: ".$nomeSottoCategoria."</option>";
                       // }//end else sottocategorie
                    }
                }//end foreach
                ?>