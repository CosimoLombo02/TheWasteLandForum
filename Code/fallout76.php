<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Fallout 76</title> 
    <link rel ="stylesheet" href="CSS/stilePagLore.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
    
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno
    quando si entra nella pagina di un media, la voce relativa a quel media viene sostituita
    con una voce per tornare alla pagina principale-->
    <?php /* if(isset($_SESSION['username'])){
        $User=$_SESSION['username'];
        echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='homepage.php'>Home Page</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni</a><a href='Forum/bachecaPersonale.php'>$User</a></div>";

        }else{

        echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='Forum/discussioni.php'>Discussioni</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='homepage.php'>Home Page</a><a href='falloutS.php'>Fallout Serie TV</a></div>";


        }//end else
    */ require "mostraNavBar.php";
    
    ?>
    
    
    <!--L'idea è la seguente: ogni pagina di questo tipo avrà una sezione con la lore del media in questione
    e di fianco uno slider costruito attraverso css che mostrerà immagini riguardanti quel media, sempre cercando di mantenere lo
    stile da terminale
    -->
    <div class="colonnaGrandeScroll">
        <p class="simpleText"><strong>Trama</strong><br />
        Fallout 76 è un prequel dei precedenti giochi di Fallout. Esso è ambientato in una storia alternativa e si svolge nel 2102, venticinque anni dopo una guerra nucleare che ha devastato la Terra. Il personaggio del giocatore è un residente del Vault 76, un rifugio antiatomico costruito nel West Virginia per ospitare le migliori e più brillanti menti americane. Il personaggio del giocatore esce, per ultimo, dal Vault, durante il "Reclamation Day", per partecipare alla ricolonizzazione della Wasteland.

Il gioco inizia con il personaggio del giocatore che è fra gli ultimi a risvegliarsi al "Reclamation Day", dopo esser uscito dal Vault viene a contatto con un Mr. Handy che consegna al giocatore un olonastro del Sovrintendente, la quale rivela la sua missione: assicurare alla Vault Tec i tre silos missilistici dell'Appalachia. Il giocatore scopre quindi che tutte le persone del West Virginia sono state uccise o tramutate in "ardenti" esseri senza ragione che attaccano qualunque cosa percepiscano come minaccia e 
che sembrano essere stati infettati da una malattia, la piaga ardente, portata da enormi creature alate chiamate "bestie ardenti". Il giocatore viene quindi a conoscenza degli studi fatti dai Soccorritori, insieme di poliziotti, medici e pompieri che dopo la guerra soccorsero la popolazione locale, aiutarono il governo d'emergenza e cercarono una cura alla piaga ardente, il giocatore scopre quindi che questa fazione riuscì a trovare un vaccino per tale malattia, ma che non venne mai prodotto perché i predoni distrussero Charleston, sede del governo d'emergenza, nel 2096 con il crollo di altre fazioni i Soccorritori tentarono una piccola difesa, che fallì, dove vennero sterminati gli ultimi umani della regione. Il giocatore riesce quindi a completare la cura ed a vaccinarsi, diventando immune a questa malattia.
Proseguendo il suo viaggio il giocatore viene a conoscenza delle varie fazioni che abitavano il West Virginia prima dell'estinzione di massa, viene quindi a contatto con Rose, una Miss Nanny convertita dai predoni locali, ovvero gli ex clienti dei vari lussuosi centri sciistici della regione che dopo la Guerra diventarono un gruppo di predoni, il giocatore dovrà quindi completare alcune richieste di Rose per poter ottenere l'accesso a un'avanzata tecnologia degli Stati Liberi. Da qui il giocatore trova i resti degli Stati Liberi, gruppo di secessionisti che dopo la guerra cercarono un modo per poter rintracciare le bestie ardenti, sistema che si rivelerà non funzionante, il giocatore scopre così l'esistenza di un'altra fazione, il Tuono di Taggerdy o Confraternita d'Acciaio Apalacchiana, questo era un gruppo di soldati che dopo la guerra venne a contatto con Roger Maxson, fondatore della Confraternita d'Acciaio sulla Costa Occidentale, il quale cominciò a contattare superstiti grazie ad un satellite. Questa sezione della Confraternita d'Acciaio decise di combattere i supermutanti, le bestie ardenti ed i predoni. Dopo la caduta del satellite la Confraternita rimase isolata e non riuscì più a contattare i loro compagni in California, non prima però di aver scoperto che la minaccia degli ardenti rischia di annientare l'umanità nel Nord America e che le bestie ardenti per potersi riprodurre hanno bisogno di una regina, poi quando il loro numero aumenta queste creature sfruttando il sistema di grotte e miniere sotto il West Virginia esce in superficie, infettando ed uccidendo le creature che incontrano.
La Confraternita dopo questo evento incrinò i rapporti con le altre fazioni, isolandosi e tentando, senza riuscirci, di sconfiggere le bestie ardenti. Quando il numero di soldati divenne troppo piccolo per poter continuare a lottare, decisero di fare una missione suicida per tentare di fermare temporaneamente questa minaccia, il giocatore seguendo gli ultimi passi della missione scopre che le bestie ardenti sono state create in laboratorio da qualcuno. Il giocatore riesce quindi a scoprire che per risvegliare ed uccidere la regina delle bestie ardenti deve lanciare un missile nucleare sulla fenditura dove vive la creatura, opzione che la Confraternita decise di scartare per opposizione ideologica.
Il giocatore riesce quindi a rintracciare un bunker dove riesce ad arrivare ad una base dell'Enclave, il bunker del Whitespring, qui scopre che il Segretario dell'Agricoltura, Thomas Eckart, per poter continuare la guerra contro la Cina aveva fatto un colpo di stato all'interno della struttura, i problemi arrivarono quando il sistema automatico DEFCON cominciò ad abbassarsi, mentre per poter accedere ai silos nucleari serviva un livello DEFCON 1, dopo aver scoperto ciò decise di liberare sul territorio supermutanti e robot, situazione che non fece aumentare il livello di sicurezza, quindi dopo che gli scienziati dell'Enclave crearono per errore le bestie ardenti, Eckart decise di liberarle sul territorio, ciò causò una ribellione che portò alla morte di tutti i membri originali della struttura. Il giocatore entra in contatto con il supercomputer MODUS, intelligenza artificiale che decide di aiutare il giocatore, aiutandolo a decriptare i codici di lancio per i silos nucleari. Al termine della preparazione il giocatore sconfigge i sistemi automatici di difesa della base e lancia un missile nucleare sulla fenditura prima, risvegliando la regina delle bestie ardenti, dopo l'uccisione della regina la mente ad alveare degli ardenti viene spezzata, fermando per sempre la profilazione delle creature e salvando l'umanità da questa minaccia. 
Nel 2103 le persone che scapparono dalla minaccia delle bestie ardenti ritorneranno in Appalachia alla ricerca di un tesoro segreto nascosto nelle montagne, oltre ai normali coloni e saccheggiatori saranno presenti 4 gruppi principali: i coloni di foundation che provengono dalla Capitale e dalla Pennsylvania, i predoni di crater che provengono dalle vecchie bande apalacchiane, le aquile sanguinarie ovvero un insieme di predoni più violenti e meno ragionevoli rispetto a quelli di crater e il culto dell'uomo falena, seguaci di una religione che vede nell'Appalachia il territorio sacro del leggendario uomo falena.
L'abitante del Vault incontrerà la sovrintendente, che darà una missione all'abitante: stabilire rapporti con crater e foundation per poter vaccinare gli abitanti contro la piaga ardente, l'abitante riesce quindi a stabilire rapporti con entrambi i gruppi ed a produrre un vaccino con l'aiuto della sovrintendente.
L'Abitante del Vault potrà quindi aiutare entrambe le fazioni: per i coloni potrà convincere un gruppo di militari a difendere Foundation, aiuterà la Dottoressa Hornwright nel riparare la trivella madre Dopo questo compiti la sovrintendente darà una nuova missione, trovare il tesoro per poter rifondare la civiltà, questo perché il tesoro nascosto è un Vault dove all'interno c'è la riserva d'oro degli stati uniti d'America, spostata da Fort Knox per poter rifondare una valuta dopo la guerra.
L'abitante del Vault dopo aver deciso quale fazione scegliere per entrare nel Vault scoprirà che al suo interno sono presenti i membri del servizio segreto degli stati uniti d'America, membri che dopo una ribellione e un guasto al reattore erano sul punto di finire le scorte, per ripagare l'aiuto dato dall'abitante i membri permetteranno di introdurre parte dell'oro come valuta in Apalacchia, non avendone più l'esclusiva. L'abitante dovrà quindi scegliere come dividere l'oro: dare il 50% a una delle due fazioni, tenere tutto l'oro per sé o tenere il 50% per se e dividere il restante 50% con entrambe le fazioni, evitando quindi dispute fra i due gruppi per ottenere l'oro. 
Dopo mesi di viaggio il Primo corpo di Spedizione della Confraternita d'Acciaio arriva in Apalacchia dalla California, la missione formata inizialmente dal Paladino Leila Rahmani, il Cavaliere Daniel Shin e la Scriba Odessa Valdez, ha raccolto diversi Iniziati sulla sua strada per la California, con la missione di stabilirsi nell'Osservatorio Astronomico Atlas per valutare la situazione della regione e per cercare di riparare una macchina del controllo climatico presente ad Atlas.
L'Abitante del Vault dopo aver ascoltato un messaggio radio trasmesso da Fort Atlas si reca alla struttura per arruolarsi, l'Abitante viene quindi accolto dal diffidente Cavaliere Shin che gli dà come "missione" l'ascolto delle richieste di alcune persone che chiedono aiuto alla Confraternita. Dopo aver fatto ciò l'Abitante aiuta la Scriba Valdez nell'ispezione al dispositivo di controllo climatico Atlas, l'osservatorio era infatti una copertura del governo per un macchinario capace di alterare il clima in qualunque parte del mondo, progetto che venne interrotto poco prima della guerra per le enormi spese, la Confraternita intende utilizzarlo ma durante l'ispezione risulta chiaro che il dispositivo è inutilizzabile ma i due scoprono una cella ad ultracite, la quale nonostante le dimensioni ridotte è capace di alimentare l'intero meccanismo.
L'Abitante riceve quindi diverse missioni dal Paladino Rahmani: eliminare un'orda di ghoul che infesta la parte sud-occidentale della foresta, eliminerà un gruppo di Aquile Sanguinarie che minaccia un gruppo nella palude boscosa noto come "Il Ritiro", in quest'ultima missione l'Abitante scopre che durante il viaggio in Appalachia la Confraternita trovò e perse delle armi governative, le quali ora sono in mano a diversi gruppi.
Dopo aver fatto ciò la Confraternita manda l'Iniziato dai Coloni e dai Predoni per recuperare le armi e stabilire rapporti pacifici: in questo caso l'Abitante avrà libertà di scelta e potrà avere un approccio diplomatico o imporsi con la forza: l'Abitante ed il Cavaliere Shin andranno in un deposito dei predoni per recuperare le armi e qui l'Abitante verrà a conoscenza dei preparativi ad una guerra contro la Confraternita, a Crater riceverà la possibilità di tradire la Confraternita copiando dati di tutti i terminali del Forte rendendo la Confraternita molto più vulnerabile, altrimenti potrà semplicemente copiare dei dati falsi e consegnarli ai predoni, al termine della missione l'Abitante scopre che le armi furono comprate dai predoni di Crater da una banda che attaccò la spedizione e rubò le armi dopo aver ucciso un Cavaliere, per i Coloni invece dovrà garantire un trattato di scambio, sequestrare le armi o lasciarle a Foundation.
Al termine della missione Valdez dice all'Abitante che durante il viaggio per l'Appalachia la Confraternita trovò delle armi in un bunker governativo e durante il viaggio trovarono un villaggio minacciato dai predoni, Rahmani decise di dare al villaggio parte delle armi per poter facilitare la difesa, vista però l'impreparazione dei cittadini il villaggio venne distrutto dai predoni, gli abitanti furono uccisi e le armi rubate, anche la Confraternita nonostante la superiorità subì perdite: il Cavaliere Connor, del villaggio sopravvissero solo un bambino e sua sorella maggiore.
Dopo esser tornato a Fort Atlas l'Abitante riceve una nuova importante missione: trovare un trasmettitore capace di poter entrare in comunicazione con Lost Hills, il giocatore trova il trasmettitore in una base dell'Enclave, un laboratorio dove venivano studiate le mutazioni che affliggono flora e fauna locale, il tutto finché SODUS, l'IA della struttura, impazzì e rilasciò la piaga ardente nella ventilazione, rendendo ardenti tutto il personale. Una volta trovato il trasmettitore Rahmani e Shin arrivano nella base, qui Rahmani può spiegare all'Abitante il suo piano: distruggere il trasmettitore per evitare di rientrare in contatto con gli Anziani della California, in modo tale da poter evitare che la Confraternita faccia gli stessi errori del capitolo Californiano, creando quindi una Confraternita nuova e più attenta alle persone che non solo sulla tecnologia, contemporaneamente anche Shin può dire la sua opinione su quanto tema Rahmani, alla fine Rahmani decide di distruggere il trasmettitore, isolando la Confraternita. I due hanno una discussione ma viene interrotta da un segnale d'emergenza: Fort Atlas è sotto attacco da parte dei supermutanti, i quali dimostrano di avere un piano organizzato visto che attaccano ad ondate, logorando le difese, Rahmani, Shin e l'Abitante entrano quindi nei condotti e fanno esplodere le gallerie da cui vengono i supermutanti, alla fine della missione Shin accetta di restare fedele a Rahmani finché la minaccia dei supermutanti non verrà sventata. 
Dopo un aumento delle tensione tra il Rahmani e Shin l'Abitante dovrà affrontare un nuovo ordine di mercenari chiamati Hellcat.
Al completamento dell'espansione al giocatore verrà conferito il titolo di Cavaliere Errante della Confraternita d'Acciaio e otterrà una speciale Armatura Atomica Hellcat. L'armatura si può ottenere solo tramite il completamento di Steel Reign 
</p>
    <p class="simpleText">
        <strong>Ambientazione</strong><br />
        Il gioco è ambientato in un open world quattro volte più grande di quello di Fallout 4; in questo mondo, chiamato "Appalachia", vi sono rappresentazioni di luoghi reali della Virginia Occidentale, come il Campidoglio, il "The Greenbrier" (un luxury-resort situato vicino agli Allegani), il Woodburn Circle (un campus universitario), il New River Gorge Bridge (un ponte) e il Camden Park (un parco di divertimento).
        Nel gioco sono inoltre presenti nuovi e numerosi mostri mutanti, molti dei quali ispirati al folclore della Virginia Occidentale, come l'Uomo falena, il Mostro di Flatwoods, il Wendigo, lo Snallygaster e il Mostro di Grafton.
    </p>
    </div>
    

    
    
           <div class="colonnaGrande">
                <div class="slider_container">
                    <div class="slider">
                      <div class="slide one">
                        <img src="ImmaginiVideoSito/fallout76-1.jpg" alt="copertina del videogioco" />
                        <span class="caption"> Copertina </span>
                      </div>
                      <div class="slide two">
                        <img src="ImmaginiVideoSito/fallout76-2.jpg" alt="Mappa" />
                        <span class="caption"> Mappa </span>
                      </div>
                      <div class="slide three">
                        <img src="ImmaginiVideoSito/fallout76-3.jpg" alt="Incontro con sopravissuti" />
                        <span class="caption"> Incontro con sopravvissuti </span>
                      </div>
                      <div class="slide four">
                        <img src="ImmaginiVideoSito/fallout76-6.jpg" alt="Bestia Ardente" />
                        <span class="caption"> Bestia Ardente </span>
                      </div>
                      <div class="slide five">
                        <img src="ImmaginiVideoSito/fallout76-5.jpg" alt="Charleston" />
                        <span class="caption"> Charleston </span>
                      </div>
                      
                    </div>
                </div>
            </div>


</body>


</html> 