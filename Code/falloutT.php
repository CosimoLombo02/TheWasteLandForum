<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Fallout Tactics: Brotherhood Of Steel</title> 
    <link rel ="stylesheet" href="CSS/stilePagLore.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
    
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno
    quando si entra nella pagina di un media, la voce relativa a quel media viene sostituita
    con una voce per tornare alla pagina principale-->
    <?php if(isset($_SESSION['username'])){
      $User=$_SESSION['username'];
    echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='homepage.php'>Home Page</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni</a><a href='Forum/bachecaPersonale.php'>$User</a></div>";

    }else{

    echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='Forum/discussioni.php'>Discussioni</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='homepage.php'>Home Page</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a></div>";


    }//end else//
    
    
    ?>
    
    
    <!--L'idea è la seguente: ogni pagina di questo tipo avrà una sezione con la lore del media in questione
    e di fianco uno slider costruito attraverso css che mostrerà immagini riguardanti quel media, sempre cercando di mantenere lo
    stile da terminale
    -->
    <div class="colonnaGrandeScroll">
        <p class="simpleText"><strong>Trama</strong><br />
        La Confraternita d'Acciaio è stata per decenni una delle organizzazioni più potenti della costa occidentale, ma negli ultimi mesi si è creata
         una frattura nei suoi ranghi: 
        un gruppo di affiliati sosteneva la necessità di trovare nuove reclute, per evitare l'indebolimento della confraternita, facendo aderire gli 
        uomini delle tribù della California alla confraternita, mentre i membri più anziani, ostili ad ogni apertura esterna, 
        volevano invece preservarne la linea di sangue e la purezza dei membri. Alla fine, la maggioranza degli uomini dell'organizzazione
        ha scelto di sostenere la linea conservatrice degli anziani, e la minoranza è stata mandata in missione su dei dirigibili 
        con il compito di dare la caccia e distruggere i resti dell'antico esercito del Master.
        Durante il viaggio, i convogli sono stati però colpiti da una catastrofica tempesta, perdendo molte 
        aeronavi con i loro passeggeri. I sopravvissuti sono stati costretti a trovare rifugio nelle rovine di Chicago, i
        ncapaci di chiedere soccorso al quartier generale, ma nonostante la situazione decisamente negativa, essi, non perdendosi d'animo, 
        fondano una loro roccaforte stabilendo proficui rapporti di amicizia con gli insediamenti locali. Ora liberi dall'ideologia restrittiva
        dell'organizzazione madre, i sopravvissuti accolgono degli estranei nelle loro forze e creano una nuova confraternita che rispecchiasse
        gli ideali per cui avevano a lungo lottato. 
        Cercando di rivendicare il territorio circostante a Chicago, la Confraternita stringe un patto con i villaggi tribali,
        che forniranno reclute alla nuova confraternita in cambio di protezione e aiuto. Il giocatore è una nuova recluta della Confraternita,
        il cui compito è quello di distruggere le bande di Predatori che infestano le zone circostanti a Chicago
        e che sfidano continuamente l'autorità dell'organizzazione.
        Dopo la vittoriosa campagna contro i predoni, il protagonista viene promosso e accettato da tutti i membri dell'ordine, e apprende 
        l'obiettivo che sta perseguendo: presto una grande spedizione partirà a ovest attraverso le Grandi Pianure, verso le Montagne Rocciose, 
        in cerca della sofisticata tecnologia conservata nel Vault Zero, il centro di comando pre-bellico della rete dei Vault, dove molte delle 
        più alte cariche del governo, dell'esercito e della comunità scientifica sono state alloggiate per scampare all'olocausto nucleare. 
        Durante l'attraversamento dell'Illinois post-bellica, il corpo di spedizione della Confraternita, 
        comandato dal generale Barnaky, si imbatte nei Signori delle bestie, esseri umani mutanti che sono in grado di controllare 
        gli animali della zona contaminata, e che usano i Deathclaws come schiavi. 
        Nelle grotte di Mardin, gli uomini della Confraternita ottengono una decisiva vittoria sul gruppo di mutanti. 
        La spedizione della Confraternita incontra un nuovo nemico che ostacola l'esplorazione del Missouri post-bellico e il loro viaggio verso ovest: i resti dell'esercito supermutante hanno il controllo di gran parte della regione, e gli uomini della fratellanza devono combattere per procedere. Nei pressi di St. Louis si svolge una grande battaglia in cui le forze della confraternita vengono sopraffatte e
         costrette alla ritirata, e il generale Barnaky viene catturato dal leader nemico Toccomata.
        Il protagonista e la sua squadra vengono spediti a distruggere una fabbrica di munizioni dei supermutanti, ma si trovano invece davanti a un laboratorio scientifico, intento a cercare una cura per la sterilità dei mutanti. Pochi giorni dopo, presso la città ghoul di Gravestone, nelle rovine di Kansas City, gli scout della confraternita trovano una bomba nucleare intatta: l'organizzazione si pone immediatamente a difesa dell'insediamento e impedisce ai contingenti supermutanti di catturare l'ordigno, 
        che invece viene rimosso e messo in sicurezza in un bunker della Confraternita stessa.
        Finalmente gli esploratori identificano la posizione del quartier generale del nemico: si trova ad Osceolla, 
        vicino alla carcassa di uno zeppelin della confraternita. Una squadra si fa strada nella base dei supermutanti e all'interno 
        trovano Toccomata morente: egli rivela che il generale Barnaky era vivo e vegeto ma è stato catturato da misteriose creature dell'ovest 
        che hanno attaccato la base. La squadra entra nella stanza successiva dove il leader supremo dei mutanti era nascosto, ma si trovano davanti 
        il Paladino Latham, uno dei leader della Confraternita disperso durante il naufragio degli zeppelin. La squadra scopre così che ha combattuto 
        e sconfitto Gammorin per la leadership dei supermutanti, ma ha perso la memoria per via di un trauma cranico: per sopperire al vuoto così
        creato ha assunto l'identità di Gamorin, e ha portato il suo nuovo esercito contro i suoi vecchi alleati. 
        Avendo Latham messo fin troppo in pericolo la Confraternita e la sua missione, la squadra è costretta ad affrontarlo e a eliminarlo. 
        Nel Kansas post-bellico, la Confraternita identifica l'esercito che ha sterminato i supermutanti di Osceolla: si tratta 
        di un'armata di robot che ha intenzione di invadere e conquistare tutti il Midwest americano. I Reavers, un culto dedicato 
        alla tecnologia e padroni della regione, tentarono di affrontare l'armata, ma tutti i loro principali avamposti furono annientati 
        sistematicamente; i sopravvissuti chiedono ora protezione alla Confraternita. Dopo che questi salvano importanti luogotenenti dell'ordine a 
        Newton 4, i membri della nuova Confraternita ricevono 
        come premio un prototipo di un'arma ad impulsi elettromagnetici, che forse può danneggiare seriamente le forze dei droidi. 
        Nella sua avanzata verso il Vault 0, il corpo di spedizione affronta nel Colorado post-bellico l'esercito robot: 
        a Canyon City distruggono una stazione di riparazione nemica e nelle rovine dell'insediamento di Buena Vista sabotano e 
        rendono innocua una centrale nucleare che alimentava una grande industria di droidi. La cattura di Bartholemew Kerr, 
        il commerciante preferito dalla Confraternita, da parte dei robot, rimette in discussione ogni cosa: da lui i droidi
        potrebbero ottenere delle informazioni che metterebbero l'organizzazione in seria difficoltà; viene così inviata una squadra 
        nella prigione di Scott city per salvare il mercante. All'interno della struttura i cavalieri della Confraternita scoprono la vera
        natura del leader dell'armata nemica: 
        si tratta di un supercomputer la cui IA è stata fusa con un cervello umano rendendolo molto pericoloso. 
        La spedizione della Confraternita giunge alle falde del Cheyenne Mountain; 
        sulla sommità del monte c'è l'entrata del Vault 0 e le forze della nuova Confraternita sperano di aprire un varco nel bunker 
        utilizzando la testata nucleare ottenuta a Grovestone. Dopo una dura lotta contro i droidi, una squadra della confraternita posiziona 
        la testata e l'esplosione fa il suo lavoro, permettendo a due squadre di soldati di penetrare all'interno: in primo luogo essi sabotano 
        gli altiforni che producono i robot, poi si occupano di riattivare gli ascensori per arrivare ai livelli più bassi del Vault. 
        Qui, i cavalieri affrontano un ultimo contingente di robot guidati dal generale Barnaky (trasformato in un cyborg) posto a difesa 
        del loro padrone. 
        Il generale torna però in sé quando ricorda la promessa fatta all'adorata moglie Maria e scorta la squadra al supercomputer. 
        Per completare il gioco si hanno diverse alternative:
    Se il protagonista imposta l'auto distruzione del supercomputer, la Confraternita cattura il Vault 0 e lo utilizza come quartier generale. Ma poiché la macchina, con le sue banche dati e le sue informazioni, era l'unico tesoro del bunker, la sua distruzione ha cancellato per sempre tutto quanto. Dal Vault 0, la Confraternita stabilisce rapporti con gli insediamenti del Midwest, ottenendo reclute e risorse, e porta un po' d'ordine, contrastando mutanti, schiavisti e predatori nella Zona Contaminata. Il suo obiettivo primario di riunirsi con i fratelli di Lost Hills è tuttavia sospeso a tempo indeterminato.
    Se il protagonista fonde il proprio cervello con il supercomputer, la Confraternita ottiene tutte le risorse e i segreti custoditi nel Vault, aumentando in modo esponenziale il suo potere, e il Midwest è riportato al suo antico splendore in pochi decenni. È tuttavia l'etica del protagonista nel corso del gioco a guidare le azioni del calcolatore:
        Se il giocatore si è comportato da malvagio, le specie mutanti (come i ghoul e deathclaws) vengono discriminate ed emarginate; gli Anziani della Confraternita vengono tranquillamente giustiziati e il calcolatore prende il controllo assoluto dell'organizzazione. Un destino simile spetterà anche alla Confraternita della California, se mai verrà trovata.
        Se il giocatore è stato nobile e di animo buono, il Midwest e la Confraternita Orientale prosperano in un regno di giustizia e pace; gli Anziani e lo stesso calcolatore si chiedono però come andranno a finire le cose se e quando ci si riunirà alla dogmatica Fratellanza occidentale.
    Se il protagonista permette a Barnaky di unirsi al supercomputer, il nuovo calcolatore inizierà una campagna di genocidio contro tutti gli "impuri" (ovvero mutanti, deathclaw e ghoul), e distruggerà tutti gli umani che gli si oppongono, guidando nel frattempo la riunificazione delle Confraternite allo scopo di riportare l'umanità verso un futuro luminoso e civile
        </p>
    <p class="simpleText">
        <strong>Ambientazione</strong><br />
        La spedizione della Confraternita d'Acciaio attraversa gran parte del Midwest post-apocalittico. Di seguito c'è un elenco dei principali luoghi esplorabili nel gioco:

    Bramin Wood: è un villaggio tribale situato nei dintorni di Chicago. Nel 2197 fu invaso dai predatori di Horus e molti abitanti furono uccisi e ridotti in schiavitù. Dopo l'intervento della Confraternita d'Acciaio l'insediamento è entrato nella sfera di protezione garantito dall'organizzazione in cambio di uomini e risorse.
    Rock Falls: rovine di una città pre-bellica situate a ovest di Chicago. Qui è sorto un grande accampamento di predatori decimato da un attacco della Confraternita d'Acciaio.
    Quincy: nelle rovine di questa città si è formato un insediamento di uomini e ghoul che nel 2197 venne attaccato dai Signori delle bestie che presero in ostaggio molti abitanti; la Confraternita si scontra qui, per la prima volta, con questo gruppo di mutanti.
    Mardin: dedalo sotterraneo di grotte e tunnel a nord ovest di St. Louis. È il covo dei Signori delle Bestie, che verranno poi eliminati dalla confraternita.
    Springfield: città dell'Illinois dove la Confraternita stabilisce un proprio avamposto. Nell'insediamento locale, guidato dal sindaco Chris Avellone, esistevano tensioni tra uomini e ghoul; normalmente la Confraternita non si intromette nelle dispute degli autoctoni, ma un complotto ordito contro il sindaco darà loro l'opportunità di controllare quella zona ricca di risorse.
    St. Louis: è una grande città che è stata in gran parte distrutta durante la Grande Guerra. Qui si è verificata una grande battaglia tra la Confraternita e l'esercito dei supermutanti dove la confraternita perde 6 squadre di soldati e il generale Barnaky viene catturato.
    Gravestone: prima della Grande Guerra, Kansas City ospitava un grande sito missilistico nucleare. Quando le bombe nemiche colpirono e distrussero la città, il personale della base riuscì in gran parte a sopravvivere, trasformandosi però in ghoul. Furono loro a creare l'insediamento nelle rovine fumanti della metropoli. Nel 2197 Gravestone è vittima di un attacco dei supermutanti prontamente respinto dalla Confraternita d'Acciaio.
    Osceolla: è stata la base principale di tutte le operazioni militari dell'esercito supermutante, costruita nei pressi di uno zeppelin schiantato della Confraternita d'acciaio.
    Great Bend: prima della Grande Guerra, Gran Bend era stata una grande città industriale. Nel 2197 un'armata di robot sterminò la popolazione locale e costruì un grande impianto di produzione. La Confraternita d'acciaio lo scoprirà e deciderà di distruggerlo.
    Newton: prima dell'apocalisse del 2077, la città ospitava una delle fabbriche più grandi di Nuka-cola, ma nel 2197 le rovine della città hanno l'onore di accogliere il quartier generale dei Reavers. Messi alle strette dall'esercito droide, i Reavers saranno costretti a chiedere soccorso alla Confraternita, ottenuto in cambio del loro prototipo di cannone EMP.
    Vault 0: uno dei primi Vault costruiti prima della Guerra. Questo Vault rappresentava il quartiere generale e il Vault di controllo per gli altri Vault. Dopo la caduta delle bombe furono accolte le persone più importanti degli Stati Uniti America, tra cui scienziati, artisti, membri del governo, musicisti, matematici e altro. Per assicurare di proteggere i loro pensieri le loro menti, i loro cervelli furono rimossi e mesi stato criogenico sotto il controllo del Super Computer, il Calcolatore. Esso era stato programmato in modo tale che, dopo la chiusura del Vault e in seguito alla diminuzione delle radiazioni nucleari, avrebbe dovuto funzionare in collaborazione con i cervelli di questi geni prebellici per progettare e coltivare una società umana ideale negli Stati Uniti del dopoguerra, aiutando i sopravvissuti a ricostruire un nuovo mondo. Ma con il passare degli anni, causa dei problema del suo sistema soprattutto la mancanza di alcuni sistemi di programmazione, il Calcolatore comincio a ritenere l'umanità una minaccia per suoi scopi, e liberò l'esercito di Robot progettati con lo scopo di ricostruire la civiltà e proteggere gli abitanti. 
    Scoprendo questa terribile minaccia, la Confraternita d'Acciaio decide di fermare il Calcolatore.
    </p>
    </div>
    

    
    
           <div class="colonnaGrande">
                <div class="slider_container">
                    <div class="slider">
                      <div class="slide one">
                        <img src="ImmaginiVideoSito/falloutT-1.jpg" alt="copertina del videogioco" />
                        <span class="caption"> Copertina </span>
                      </div>
                      <div class="slide two">
                        <img src="ImmaginiVideoSito/falloutT-2.jpg" alt="Vault 0" />
                        <span class="caption"> Vault 0 </span>
                      </div>
                      <div class="slide three">
                        <img src="ImmaginiVideoSito/falloutT-3.jpg" alt="Bandiera BOS" />
                        <span class="caption"> Bandiera BOS </span>
                      </div>
                      <div class="slide four">
                        <img src="ImmaginiVideoSito/falloutT-4.png" alt="Bramin Woods" />
                        <span class="caption"> Bramin Woods </span>
                      </div>
                      <div class="slide five">
                        <img src="ImmaginiVideoSito/falloutT-5.jpeg" alt="Newton" />
                        <span class="caption"> Newton </span>
                      </div>
                      
                    </div>
                </div>
            </div>


</body>


</html> 