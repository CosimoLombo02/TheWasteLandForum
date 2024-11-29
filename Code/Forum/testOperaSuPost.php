<?php
session_start();
require "funzioniUtili.php";

//cambiaRisalto(1,1);
//eliminaCategoriaSpoiler('test');
//cambiaCategoriaSpoiler('eccolffa,',1,'2');
//rimuoviSottoCategoria('testEliminazione','Personaggi e Luoghi');
//cambiaCatSottoCat('ricategorizzare','ricategorizzare',3);
//rimuoviSottoCategoria('test','test');
//inserisciSottocategoria('testg','g','admin',date('Y-m-d'));
//inserisciCategoriaSpoiler('ciao','ciao',date('Y-m-d'));
//eliminaCategoriaSpoiler('');
/*if(giaInseritaCat('h','Mods')==false)echo "ciao";
else echo "we";*/
$doc = caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
$segnalazioni = $doc->getElementsByTagName('segnalazione');
$i = 0;
foreach($segnalazioni as $segnalazione){
    if($segnalazione->getElementsByTagName('stato')->item(0)->nodeValue!='in lavorazione' && $segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue==3){
        $i++;

    }

}

echo $i;