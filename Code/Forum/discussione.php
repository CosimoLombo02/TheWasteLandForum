<!--Questa è la pagina scheletro di ogni discussione-->
<?php
require "funzioniUtili.php";
session_start();
echo $_SESSION['titolo']."  ".$_SESSION['codice'];

$doc=caricaXML('Discussioni.xml','schemaDiscussioni.xsd');
$discussioni=$doc->getElementsByTagName('discussione');
$i=0;

foreach($discussioni as $discussione){
    //echo "debug";
    
   // if($discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==$_SESSION['codice']){
   if($discussione->firstChild->nodeValue == $_SESSION['codice']){
        echo "sono qui";

        echo "Titolo preso da XML: ".$discussione->getElementsBytagName('Titolo')->item(0)->nodeValue;
        echo "testo del post preso da xml: ".nl2br($discussione->getElementsByTagName('listaPost')->item(0)->getElementsByTagName('post')->item(0)->getElementsByTagName('testoPost')->item(0)->nodeValue);
        //ora stampiamo i file(se presenti)
        if($discussione->getElementsByTagName('listaPost')->item(0)->firstChild->getElementsByTagName('fileSrc')->count()!=0){
            echo "/n ho dei file!/n"; 
            $sorgente = '../FilePostDiscussioni/';
            $maxFile = $discussione->getElementsByTagName('listaPost')->item(0)->firstChild->getElementsByTagName('fileSrc')->count();
            for($j = 0; $j <$maxFile; $j++ ){
                $nomeFile = $discussione->getElementsByTagName('listaPost')->item(0)->firstChild->getElementsByTagName('fileSrc')->item($j)->nodeValue;
                //ora controlliamo di che tipo è il file
                //per ora ci limitiamo a poche estensioni
                $path = $sorgente.$nomeFile;
                echo $path;
                if(str_contains($nomeFile,'.jpg') || str_contains($nomeFile,'.jpeg') || str_contains($nomeFile,'.png')){
                    //stampo l'immagine
                    
                    echo "<img src='$path'/>";

                }else{
                    //potremmo affinare meglio questo controllo ma per ora va bene cosi...
                    echo "<video width='320' height='240' controls>";
                    echo "<source src='$path' type='video/mp4'>";
                   
                  echo "</video> ";

                }

            }

        }else{
            echo "File non presente nel post";
        }




        break; //fermo il ciclo poichè ho trovato la discussione
    }
    $i++;
}


