<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Fallout 4</title> 
    <link rel ="stylesheet" href="CSS/stilePagLore.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
    
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno
    quando si entra nella pagina di un media, la voce relativa a quel media viene sostituita
    con una voce per tornare alla pagina principale-->
    <?php /*if(isset($_SESSION['username'])){
        $User=$_SESSION['username'];
        echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='homepage.php'>Home Page</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni</a><a href='Forum/bachecaPersonale.php'>$User</a></div>";

        }else{

        echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='Forum/discussioni.php'>Discussioni</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='homepage.php'>Home Page</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a></div>";


    }  //end else
    */require "mostraNavBar.php";
    
    ?>
    
    
    <!--L'idea è la seguente: ogni pagina di questo tipo avrà una sezione con la lore del media in questione
    e di fianco uno slider costruito attraverso css che mostrerà immagini riguardanti quel media, sempre cercando di mantenere lo
    stile da terminale
    -->
    <div class="colonnaGrandeScroll">
        <p class="simpleText"><strong>Trama</strong><br />
        Il gioco è ambientato nell'anno 2287, dieci anni dopo gli eventi di Fallout 3 e duecentodieci anni dopo una guerra sulle risorse naturali 
        che si è conclusa in un olocausto nucleare nel 2077. L'ambientazione è sia retro-futuristica sia post-apocalittica e copre una regione che 
        include Boston e altre parti della Nuova Inghilterra, meglio noto come il Commonwealth. A differenza dei titoli precedenti la storia di 
        Fallout 4 inizia il giorno del lancio di una bomba atomica: il 23 ottobre 2077. Il personaggio
         controllato dal giocatore si rifugia nel Vault 111, emergendo al di fuori di esso esattamente 210 anni dopo, il 23 ottobre 2287.
         Il gioco si svolge in una versione alternativa della storia che vede l'estetica, la progettazione e la tecnologia degli anni quaranta e 
         cinquanta del XX secolo nelle direzioni immaginate al momento. L'universo risultante è quindi retro-futuristico, dove la tecnologia si è 
         evoluta abbastanza per produrre armi laser, manipolare geni e creare un'intelligenza artificiale quasi autonoma, ma tutti all'interno dei 
         confini di soluzioni degli anni cinquanta come l'uso diffuso di energia nucleare e valvola termoionica, oltre ad avere il circuito integrato 
         dell'era dell'informazione. Gli stili di architettura, delle pubblicità e della vita in generale sono anche raffigurati sostanzialmente 
         invariati dagli anni cinquanta, mentre sono compresi prodotti contemporanei come un cavallo 
         a dondolo robotico per bambini in una pubblicità o un poster per i Vault sotterranei che svolgono un ruolo centrale nella trama del gioco. 
        </p>
    <p class="simpleText">
        <strong>Ambientazione</strong><br />
        La storia inizia la mattina del 23 ottobre 2077 a Sanctuary Hills, con il personaggio del giocatore, il coniuge (Nate/Nora), il loro figlio Shaun e il loro maggiordomo robotico Codsworth. Mentre il personaggio del giocatore si sta preparando per un evento all'Auditorio dei Veterani a Cambridge, un rappresentante della Vault-Tec viene a informarli che la loro famiglia è stata ammessa nel Vault 111, il rifugio antiatomico locale. Dopo le crescenti tensioni con la Cina Comunista, la sospensione della diplomazia e lo scioglimento delle Nazioni Unite, un notiziario avverte di esplosioni nucleari confermate in New York e in Pennsylvania e questo costringe la famiglia a 
        rifugiarsi in fretta nel Vault, dove vengono temporaneamente intrappolati fuori quando una bomba nucleare viene fatta esplodere nei paraggi. La piattaforma poi li abbassa appena in tempo prima che l'onda d'urto della esplosione nucleare arrivi, salvando la famiglia e gli altri residenti di Sanctuary Hills che ce l'hanno fatta a salire sulla piattaforma. Una volta entrati nel Vault il personaggio del giocatore e la sua famiglia sono indotti a entrare in capsule criogeniche, fatte passare per camere di decontaminazione, dal personale Vault-Tec per essere ibernati. Dopo un periodo di tempo indeterminato il personaggio del giocatore e il suo coniuge sono risvegliati da due individui sconosciuti che aprono la capsula del coniuge con l'intento di prendere il bambino del giocatore, Shaun. Quando il coniuge cerca di impedire il rapimento viene ucciso/a da uno degli sconosciuti, che prende Shaun e riattiva il tubo del personaggio del giocatore. Il protagonista riesce a liberarsi dalla criogenia in un momento successivo e scopre di essere l'unico sopravvissuto del Vault 111, divenendo quindi noto come il Sole Survivor («l'Unico Sopravvissuto»). Una volta uscito dal Vault l'Unico Sopravvissuto giura di vendicare la 
        morte del coniuge e di trovare Shaun, trovando però davanti a sé soltanto una landa desolata devastata dalle bombe.
        Il personaggio del giocatore
        si dirige verso la propria casa. Qui incontra Codsworth, che rivela all'unico sopravvissuto che sono passati oltre 210 anni da quando è stato congelato nel Vault. Codsworth consiglia al giocatore di andare a Concord per chiedere aiuto. Sulla strada per Concord incontra un cane randagio, che viene poi rinominato Dogmeat. L'unico sopravvissuto poi incontra nel Museo della Libertà locale Preston Garvey – uno degli ultimi Minutemen, miliziani dediti a difendere il Commonwealth e i suoi abitanti, ormai allo sbando e da molto tempo senza nessun governo – e lo assiste nel proteggere i coloni da un gruppo di predoni, per poi recuperare un'armatura atomica e eliminare un deathclaw. Dopo aver assistito Garvey e il suo gruppo il giocatore va a Diamond City, un insediamento con sede a Fenway Park costruito su modello di una vecchia cittadina prebellica, dove incontra Piper, giornalista della città, che consiglia al protagonista, per ritrovare Shaun, di cercare il detective Nick Valentine, che è scomparso due settimane prima dell'arrivo dell'Unico Sopravvissuto a Diamond City. Dopo aver trovato Valentine, che si rivela essere un sintetico (un essere umano artificiale) di seconda generazione, viene rivelata l'identità dell'assassino del coniuge, un mercenario di nome Conrad Kellogg che lavora per l'Istituto, una misteriosa organizzazione nascosta tra le rovine del Commonwealth Institute of Technology che terrorizza il Commonwealth rimpiazzando persone qualsiasi con un sintetico, la loro meglio riuscita creazione, dalle fattezze identiche, il tutto per motivi sconosciuti ai più. Con l'aiuto di Dogmeat l'unico sopravvissuto trova Kellogg a Fort Hagen. Dopo essere entrati nel forte e aver combattuto contro i sintetici dell'Istituto, il giocatore riesce a raggiungere Kellogg, il quale rivela che Shaun si trova nell'Istituto. Dopo aver ucciso Kellogg e recuperato un impianto cibernetico dal suo cervello, previa consultazione con Nick e Piper, l'Unico Sopravvissuto si dirige verso la malfamata cittadina di Goodneighbor per ottenere l'aiuto della Dottoressa Amari, una scienziata esperta in neuroscienze che può aiutare l'Unico Sopravvissuto a vedere i ricordi del mercenario morto. Durante la caccia a Kellogg il protagonista è testimone dell'arrivo della Confraternita d'Acciaio 
        al gran completo a bordo del Prydwen, il loro dirigibile e quartier generale mobile, con cui si stabiliscono all'aeroporto di Boston.
        Dopo aver visto i ricordi di Kellogg l'Unico Sopravvissuto è poi incaricato di andare nel Mare Splendente, il luogo dove è esplosa la bomba nucleare vista nel prologo, che ha trasformato l'area circostante in un'arida distesa radioattiva, per trovare Brian Virgil, uno scienziato ex membro dell'Istituto, tramutatosi volontariamente in supermutante attraverso il VEF (Virus a Evoluzione Forzata) per poter sfuggire ai sintetici dell'Istituto, che vogliono eliminarlo per aver interrotto gli studi sul VEF dell'Istituto (si scoprirà infatti che i supermutanti del Commonwealth sono stati creati dall'Istituto per studiare e migliorare la genetica dei sintetici usando le persone rapite e sostituite da sintetici come cavie) e che ora vuole tornare umano. Lui solo può aiutare l'Unico Sopravvissuto a infiltrarsi nell'organizzazione. Virgil consiglia al giocatore di uccidere un predatore dell'Istituto – un sintetico dedito al recupero dei sintetici fuggiti in superficie – e ottenere il suo chip, in quanto l'Istituto è sottoterra e l'unico metodo per arrivarci è il teletrasporto. Successivamente il personaggio del giocatore rintraccia i Railroad (che prendono il nome dalla storica ferrovia sotterranea), un'organizzazione segreta che agisce nell'ombra per salvare i sintetici di terza generazione in fuga dall'Istituto dando loro una nuova identità e nuovi ricordi con l'aiuto della Dottoressa Amari. Qui il protagonista chiede a Tom Tuttofare di decodificare il chip e ottenere il codice di frequenza per il teletrasporto. L'Unico Sopravvissuto torna da Virgil, che dà al personaggio del giocatore un progetto di un dispositivo che dirotta la frequenza molecolare dell'Istituto. Dopo aver recuperato i progetti il giocatore cerca assistenza da una delle tre fazioni: i Minutemen, i Railroad o la Confraternita d'Acciaio. Una volta che il dispositivo è costruito il giocatore si infiltra nell'Istituto per trovare suo figlio. Dopo aver trovato un bambino sintetico con le fattezze di Shaun a dieci anni, si scopre che il vero Shaun è stato rapito nel 2227, sessanta anni prima che l'Unico Sopravvissuto si risvegliasse dal sonno criogenico e ora è un anziano, soprannominato «Padre» e capo dell'Istituto. Shaun rivela anche di essere stato rapito a causa della necessità dell'Istituto di trovare un DNA che non fosse alterato dalle radiazioni portate dalle bombe nucleari in modo da creare i sintetici perfetti: i sintetici di terza generazione, completamente auto-consapevoli, dando così a Shaun il soprannome di «Padre». Viene poi rivelato che nella ricerca da parte dell'Istituto per trovare il DNA inalterato hanno trovato una registrazione proveniente dal Vault 111 che mostrava la famiglia dell'Unico Sopravvissuto venire criogenicamente congelata. Shaun rivela anche che sta morendo a causa di un cancro 
        e ha perciò intenzione di rendere l'Unico Sopravvissuto il prossimo direttore dell'Istituto.
        Il giocatore deve poi fare una scelta determinante il futuro del Commonwealth. Schierarsi con Shaun a favore dell'Istituto o andare contro di lui:
        Istituto; se si sceglie di schierarsi a favore dell'Istituto, il personaggio del giocatore avvia una purga nel Commonwealth annientando i Railroad e la Confraternita d'Acciaio (i Minutemen vengono risparmiati dopo aver superato alcuni controlli vocali). Successivamente il giocatore deve gestire i problemi interni dell'Istituto a causa dell'annuncio di Padre a rendere l'Unico Sopravvissuto il prossimo direttore dell'organizzazione.
        Confraternita d'Acciaio; se si sceglie di schierarsi con la Confraternita d'Acciaio, l'Unico Sopravvissuto va a ricostruire Liberty Prime, un enorme robot prebellico già apparso in Fallout 3 guidato dal Censore Ingram da utilizzare come arma per distruggere l'Istituto. Il primo compito del giocatore è quello di reclutare la Dottoressa Madison Li, che dopo gli eventi di Fallout 3 si è unita all'Istituto, per lavorare al progetto. Successivamente il personaggio del giocatore deve andare nella base militare Sentinel Site Prescott situata nel Mare Splendente (e possibile bersaglio della bomba atomica del 2077) per recuperare un carico utile di bombe nucleari compresse. Infine il giocatore deve recuperare un nucleo di fusione avanzato dall'edificio Mass Fusion. All'Unico Sopravvissuto viene poi ordinato di dirigersi verso il quartier generale dei Railroad e di annientarli perché presentano una minaccia tattica alla Confraternita: i Railroad operano per salvare i sintetici, mentre la Confraternita vuole annientare l'Istituto e tutti i sintetici esistenti. Dopo la riattivazione di Liberty Prime la Confraternita d'Acciaio lancia una carica contro l'Istituto.
        Railroad; se si sceglie di schierarsi dalla parte dei Railroad, l'Unico Sopravvissuto va sotto copertura nell'Istituto per incontrare un uomo dal nome in codice Patriot, in modo da inventare un programma per liberare tutti i sintetici e distruggere l'Istituto. I Railroad ritengono anche la Confraternita d'Acciaio una minaccia per i sintetici liberati ed escogita un piano dal nome in codice Red Rockets Glare, un piano per far cadere il Prydwen e distruggere la Confraternita d'Acciaio nel Commonwealth.
        Minutemen; se si sceglie si schierarsi a favore dei Minutemen, Il giocatore viene prima nominato da Preston Garvey nuovo generale dei Minutemen e gli viene detto riprendere il Castello, l'ex sede dei Minutemen, infestato da Mirelurk, affinché il Commonwealth sappia che i Minutemen sono tornati (da notare che questa missione può essere fatta anche prima di aver scoperto l'Istituto). In seguito la veterana Minuteman Ronnie Shaw chiede aiuto al personaggio del giocatore per recuperare i piani per le unità di artiglieria che aiuteranno i Minutemen a mantenere l'ordine contro le grandi minacce nel Commonwealth. Una volta che i Minutemen si sono riformati, è quindi compito dell'Unico Sopravvissuto di affrontare l'Istituto (e la Confraternita d'Acciaio, se sono ostili) al fine di proteggere il Commonwealth.
        Alla fine il figlio sintetico Shaun si rivela al suo «genitore» e chiede se può andare a vivere con lui/lei in qualsiasi parte del Commonwealth per essere una famiglia. Il bambino sintetico dà poi al personaggio del giocatore un olonastro registrato dal reale Shaun con un messaggio che varia a seconda delle scelte compiute dal giocatore, come l'essersi schierato dalla parte dell'Istituto o meno, e in cui esprime il desiderio di dare al bambino sintetico la possibilità di vivere come una famiglia, in quanto lo stesso Shaun non ha mai avuto la possibilità di farlo con l'Unico Sopravvissuto, il quale poi contempla gli eventi accaduti dicendo che «questo non era il mondo che volevo, ma è quello in cui mi sono trovato» perché sa che «la guerra... la guerra non cambia mai». 
    </p>
    </div>
    

    
    
           <div class="colonnaGrande">
                <div class="slider_container">
                    <div class="slider">
                      <div class="slide one">
                        <img src="ImmaginiVideoSito/fallout4-1.jpg" alt="copertina del videogioco" />
                        <span class="caption"> Copertina </span>
                      </div>
                      <div class="slide two">
                        <img src="ImmaginiVideoSito/fallout4-2.jpg" alt="Sanctuary Hills" />
                        <span class="caption"> Sanctuary Hills </span>
                      </div>
                      <div class="slide three">
                        <img src="ImmaginiVideoSito/fallout4-3.jpg" alt="Diamond City" />
                        <span class="caption"> Diamond City </span>
                      </div>
                      <div class="slide four">
                        <img src="ImmaginiVideoSito/fallout4-4.jpg" alt="Bandiera Minutemen" />
                        <span class="caption"> Bandiera Minutemen </span>
                      </div>
                      <div class="slide five">
                        <img src="ImmaginiVideoSito/fallout4-5.jpg" alt="Dogmeat e Sole Survivor" />
                        <span class="caption"> Dogmeat e Sole Survivor </span>
                      </div>
                      
                    </div>
                </div>
            </div>


</body>


</html> 