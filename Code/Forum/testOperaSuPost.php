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
echo contaSegnalazioni(1,1);

