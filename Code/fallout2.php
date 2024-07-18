<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Fallout 2</title> 
    <link rel ="stylesheet" href="CSS/stilePagLore.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <link href='https://fonts.googleapis.com/css?family=Share Tech Mono' rel='stylesheet'/> <!--font di usato nei terminali presenti in Fallout-->
    <style type="text/css">
        body {
            font-family: 'Share Tech Mono';font-size: 22px;
            background-color: black;
        }
    </style>
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno
    quando si entra nella pagina di un media, la voce relativa a quel media viene sostituita
    con una voce per tornare alla pagina principale-->
    <?php if(isset($_SESSION['username'])){
     $User=$_SESSION['username'];
     echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='#'>Forum</a><a href='fallout1.php'>Fallout 1</a><a href='homepage.php'>Home Page</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='#'>$User</a></div>";

      }else{

      echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='#'>Forum</a><a href='fallout1.php'>Fallout 1</a><a href='homepage.php'>Home Page</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a></div>";


    }//end else
    
    
    ?>
    
    
    <!--L'idea è la seguente: ogni pagina di questo tipo avrà una sezione con la lore del media in questione
    e di fianco uno slider costruito attraverso css che mostrerà immagini riguardanti quel media, sempre cercando di mantenere lo
    stile da terminale
    -->
    <div class="colonnaGrandeScroll">
        <p class="simpleText"><strong>Trama</strong><br />
        Nel corso del 2241 il villaggio tribale di Arroyo affrontò la peggiore siccità della sua storia. 
        Vedendo le scorte del villaggio esaurirsi rapidamente, l'anziana del villaggio chiese aiuto al "prescelto" ("The Chosen One"), il diretto discendente del Vault Dweller (il protagonista del primo Fallout, nonché fondatore del villaggio), per cercare e recuperare un dispositivo chiamato Garden of Eden Creation Kit (G.E.C.K.). Il G.E.C.K. era un congegno prebellico studiato appositamente per permettere agli occupanti di un Vault di ricostruire e sanare le desolate terre che avrebbero affrontato in caso di un eventuale conflitto nucleare.
       Il prescelto lasciò il villaggio partendo alla volta di Klamath per cercare notizie su un mercante che 
        aveva venduto una borraccia del Vault 13 al suo insediamento. Il prescelto scoprì che il suo nome è Vic e che i suoi ultimi 
        avvistamenti risalivano a una cittadina conosciuta come Den; giunto nel villaggio il prescelto avrebbe dovuto liberare il venditore ambulante dagli schiavisti. Successivamente le notizie sul G.E.C.K. condussero il prescelto a Vault City, una città costruita intorno a un Vault, il cui splendore era dovuto all'uso dello strumento. Indagando nella città il prescelto scoprì l'ubicazione del G.E.C.K.: il vecchio e abbandonato 
       Vault 13; dopo un lungo viaggio arrivò alla struttura, che scoprì essere occupata da una colonia di
        deathclaw insolitamente pacifici e che gli permisero di recuperare l'oggetto.
       Al suo ritorno il prescelto trovò il paese deserto e in rovina e ad accoglierlo solo lo sciamano Hakunin, ormai in fin di vita. La tribù di Arroyo era stata catturata e portata via da misteriosi e tecnologici nemici piombati sull'insediamento grazie a macchine volanti provenienti dalla città di Navarro: questi uomini erano truppe dell'Enclave, i superstiti di quello che fu il governo degli Stati Uniti d'America. Seguendo le loro tracce il prescelto giunse a San Francisco, dove scoprì che l'organizzazione era solita terrorizzare gli abitanti della California con improvvisi e violenti attacchi, a partire dal loro quartier generale: una stazione petrolifera al largo della costa occidentale degli Stati Uniti.

A San Francisco il prescelto riuscì a salire a bordo di un'antica petroliera dotata di pilota automatico che gli permise di raggiungere la base centrale del misterioso esercito e scoprire la verità: gli abitanti umani e geneticamente puri del Vault 13 e gli abitanti contaminati di Arroyo erano stati rapiti per essere usati come cavie per la sperimentazione di una super tossina derivata dal FEV (Forced Evolutionary Virus), destinata ad aggredire e uccidere tutte le creature viventi con DNA mutato, dopo esser stato rilasciato nell'oceano Pacifico dai condotti di scarico della Poseidon Oil. Solo dopo il genocidio (che sarebbe durato anni a causa della lenta propagazione) l'Enclave sarebbe subentrata restaurando l'antica e potente America pura.
Con la distruzione dell'Enclave gli abitanti del Vault 13 e di Arroyo furono finalmente liberi di creare una nuova comunità destinata a prosperare grazie al G.E.C.K. 
    </p>
    <p class="simpleText">
        <strong>Ambientazione</strong><br />
        Ottant'anni dopo l'esilio dell'abitante del Vault un nuovo governo, noto come Repubblica della Nuova California, 
        ha unificato le città del sud della regione e ha cominciato la sua espansione pacifica nel nord. Una potente droga, 
        il Jet, si è diffusa come un cancro in molti piccoli borghi, mentre la schiavitù continua a essere una pratica comune 
        anche nelle città più ricche e fiorenti
         e i ghoul e mutanti continuano a essere discriminati ovunque. È su stridenti contrasti come questi che si basa la California del 2241. 
    </p>
    </div>
    

    
    
           <div class="colonnaGrande">
                <div class="slider_container">
                    <div class="slider">
                      <div class="slide one">
                        <img src="ImmaginiVideoSito/fallout2-1.jpg" alt="copertina del videogioco" />
                        <span class="caption"> Copertina </span>
                      </div>
                      <div class="slide two">
                        <img src="ImmaginiVideoSito/fallout2-2.png" alt="Bandiera Enclave" />
                        <span class="caption"> Bandiera Enclave </span>
                      </div>
                      <div class="slide three">
                        <img src="ImmaginiVideoSito/fallout2-3.jpg" alt="New Reno" />
                        <span class="caption"> New Reno </span>
                      </div>
                      <div class="slide four">
                        <img src="ImmaginiVideoSito/fallout2-4.jpg" alt="Casco T-51b" />
                        <span class="caption"> Casco T-51b </span>
                      </div>
                      <div class="slide five">
                        <img src="ImmaginiVideoSito/fallout2-5.jpg" alt="Frank Horrigan" />
                        <span class="caption"> Frank Horrigan </span>
                      </div>
                      
                    </div>
                </div>
            </div>


</body>


</html> 