<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Fallout 3</title> 
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
       echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='#'>Forum</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='homepage.php'>Home Page</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='#'>$User</a></div>";

        }else{

        echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='#'>Forum</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='homepage.php'>Home Page</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a></div>";


    }//end else
    
    ?>
    
    
    <!--L'idea è la seguente: ogni pagina di questo tipo avrà una sezione con la lore del media in questione
    e di fianco uno slider costruito attraverso css che mostrerà immagini riguardanti quel media, sempre cercando di mantenere lo
    stile da terminale
    -->
    <div class="colonnaGrandeScroll">
        <p class="simpleText"><strong>Trama</strong><br />
        Il gioco si svolge nel 2277 negli Stati Uniti d'America a Washington, circa duecento anni dopo una guerra nucleare che ha trasformato quasi tutta la Terra in una distesa arida e irradiata. Alcuni cittadini trovarono la salvezza in bunker sotterranei chiamati Vault: il personaggio giocante vive nel Vault 101. Inizialmente la trama prende parte nei primi diciannove anni di vita del protagonista con quattro brevi prologhi nel momento della nascita e all'età di uno, dieci e sedici anni; poi il protagonista lascia il Vault 101 alla ricerca del padre, James, uno degli scienziati più rispettati della comunità che è scappato verso il mondo esterno e uscito dal bunker scopre che i livelli di radiazioni ionizzanti sono drasticamente diminuiti, 
        permettendo così la vita ad alcune comunità di esseri umani.
        Una di queste comunità di esseri umani è Megaton, insediamento umano costruito nel cratere lasciato da un bombardiere precipitato. La bomba atomica 
        che trasportava è rimasta inesplosa al centro del cratere, diventata col tempo parte della città e da alcuni anche oggetto di culto religioso. In questa città il protagonista scopre che il padre si è diretto alla sede di Galaxy News Radio, una delle uniche due emittenti radiofoniche ancora esistenti. Il suo capo è un disc jockey chiamato Tre Cani, che si pone come voce degli oppressi della Zona Contaminata della Capitale. A Megaton il protagonista apprende un retroscena sulle proprie origini: lui e suo padre non sono mai nati nel Vault, ma vi sono stati ammessi poco dopo la sua nascita.
        Nei pressi della destinazione il protagonista trova dei supermutanti, enormi creature umanoidi mutate e rese incredibilmente forti a causa di esperimenti genetici. Nei pressi di Galaxy News Radio il protagonista ha il suo primo incontro con la Confraternita d'Acciaio, una comunità di soldati che detengono tecnologia molto avanzata, in netto contrasto con il basso livello tecnologico del resto dell'ambientazione. La Confraternita d'Acciaio è in lotta con l'Enclave; un'organizzazione militare tecnologicamente avanzatissima, guidata da uomini che si considerano i discendenti del governo federale degli Stati Uniti d'America, in particolare da Eden, 
        autoproclamatosi presidente degli Stati Uniti d'America.
        Tre Cani informa il protagonista che James si è diretto a Rivet City, 
        una città costruita all'interno di una portaerei arenata sul fiume Potomac. 
        La direttrice dell'istituto di ricerca di Riven City, la dottoressa Madison Li, era una collega di James quando prima di entrare nel Vault 
        quest'ultimo lavorava al Progetto Purezza, una ricerca per trovare un modo di purificare le acque radioattive di Washington. La dottoressa Li informa il protagonista che James si è diretto al Jefferson Memorial, il vecchio laboratorio. Una volta lì il protagonista apprende da alcuni appunti del padre che l'elemento chiave per la purificazione delle acque è nelle mani del Dr. Stanislaus Braun, il ricercatore capo del Vault 112 e uno degli sviluppatori del K.R.E.G., ovvero il Kit Realizzazione Giardino dell'Eden.
        Nel Vault 112 il personaggio giocante viene proiettato in un sistema di realtà virtuale che ricostruisce un quartiere tipico del mondo prima della guerra, Tranquility Lane. Braun gestisce la simulazione e controlla gli abitanti del Vault all'interno, compreso James; il protagonista riesce nel liberare suo padre e tornati al Jefferson Memorial tentano di rimettere in sesto l'impianto, insieme alla dottoressa Li. Tuttavia alcuni soldati dell'Enclave, comandati dal colonnello Autumn, fanno irruzione nell'edificio e uccidono James, il quale fa però saltare in aria uno dei purificatori uccidendo così Autumn, ma sacrificando la propria vita. Inseguiti dall'Enclave la dottoressa Li, il protagonista e i superstiti dello staff scappano verso la roccaforte della Confraternita dell'Acciaio. La Confraternita d'Acciaio informa il personaggio giocante che il K.R.E.G. necessario per far funzionare il Progetto Purezza si trova nel Vault 87. Una volta entrato nel Vault il protagonista scopre che è questo il luogo d'origine dei supermutanti e recupera il K.R.E.G.
        L'Enclave tiene un agguato al protagonista con il colonnello Autumn che si rivela sopravvissuto  che viene catturato per poi risvegliarsi a Raven Rock, base dell'Enclave. Il K.R.E.G. è caduto nelle loro mani e lo stanno installando nel Progetto Purezza, ma per i propri scopi; tuttavia manca il codice per avviarlo e per questo tengono in ostaggio il protagonista. Una volta evaso dalla sua cella il personaggio giocante incontra il presidente Eden, che si rivela essere una intelligenza artificiale; Eden fa uscire dalla base il protagonista, ma ad una condizione: prendere una fiala di virus VEF modificato per inserirlo nel Progetto Purezza, così da uccidere tutti gli esseri mutati, dai supermutanti ai ghoul, fino ai comuni abitanti di Washington.
        Una volta fuggito da Raven Rock il personaggio giocante si appresta a sferrare un assalto all'Enclave insieme alla Confraternita d'Acciaio per riprendere il controllo del Jefferson Memorial e attivare il Progetto Purezza. Supportata da Liberty Prime, un robot militare utilizzato in Alaska nel 2077, la Confraternita riesce nel riprendere l'edificio. Tuttavia si presenta un ultimo problema: il purificatore, danneggiato dai combattimenti, rischia di esplodere e va attivato immediatamente; sfortunatamente per farlo bisogna accedere alla console circondata da una quantità mortale di radiazioni ionizzanti. A discrezione del giocatore la scelta sul sacrificare sé stesso, mandare la sentinella Lyons della Confraternita d'Acciaio oppure Fawkes e soprattutto se inserire o meno nel purificatore il virus VEF fornitogli dal presidente Eden. Queste ultime scelte, unite al livello di karma posseduto, determinano il contenuto del video finale. 
    </p>
    <p class="simpleText">
        <strong>Ambientazione</strong><br />
        A differenza dei suoi predecessori che sono ambientati negli Stati Uniti d'America occidentali, Fallout 3 
        si svolge sulla costa nord-orientale all'interno della vasta area di Washington dopo una guerra nucleare scoppiata nel 2077.
         Le ambientazioni si distinguono in luoghi all'aperto, che variano da pianure consumate dalla devastazione atomica fino alle rovine 
         cittadine e in luoghi chiusi come i Vault o gli interni di edifici diroccati. Sono stati trasposti molti elementi caratteristici di Washington,
          come il Jefferson Memorial, il Lincoln Memorial, il Monumento a Washington, il Campidoglio e la Casa Bianca, il Palazzo degli Archivi Nazionali degli Stati Uniti d'America e la Metro Center.
    </p>
    </div>
    

    
    
           <div class="colonnaGrande">
                <div class="slider_container">
                    <div class="slider">
                      <div class="slide one">
                        <img src="ImmaginiVideoSito/fallout3-1.jpeg" alt="copertina del videogioco" />
                        <span class="caption"> Copertina </span>
                      </div>
                      <div class="slide two">
                        <img src="ImmaginiVideoSito/fallout3-2.png" alt="Megaton" />
                        <span class="caption"> Bandiera Enclave </span>
                      </div>
                      <div class="slide three">
                        <img src="ImmaginiVideoSito/fallout3-3.jpeg" alt="BOS" />
                        <span class="caption"> BOS </span>
                      </div>
                      <div class="slide four">
                        <img src="ImmaginiVideoSito/fallout3-4.avif" alt="Uscita Vault 101" />
                        <span class="caption"> Uscita vault 101 </span>
                      </div>
                      <div class="slide five">
                        <img src="ImmaginiVideoSito/fallout3-5.jpeg" alt="Vault 112" />
                        <span class="caption"> Vault 112 </span>
                      </div>
                      
                    </div>
                </div>
            </div>


</body>


</html> 