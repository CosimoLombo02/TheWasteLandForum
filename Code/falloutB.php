<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Fallout Brotherhood of Steel</title> 
    <link rel ="stylesheet" href="CSS/stilePagLore.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
   
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno
    quando si entra nella pagina di un media, la voce relativa a quel media viene sostituita
    con una voce per tornare alla pagina principale-->
    
    <?php /*if(isset($_SESSION['username'])){
        $User=$_SESSION['username'];
        echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='homepage.php'>Home Page</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni</a><a href='Forum/bachecaPersonale.php'>$User</a></div>";

        }else{

        echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='Forum/discussioni.php'>Discussioni</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='homepage.php'>Home Page</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a></div>";


    }  //end else
    */require "mostraNavBar.php";
    ?>
    
    
    <!--L'idea è la seguente: ogni pagina di questo tipo avrà una sezione con la lore del media in questione
    e di fianco uno slider costruito attraverso css che mostrerà immagini riguardanti quel media, sempre cercando di mantenere lo
    stile da terminale
    -->
    <div class="colonnaGrandeScroll">
        <p class="simpleText"><strong>Trama</strong><br />
        Il gioco è incentrato sulle vicende di un iniziato della Confraternita d'Acciaio. 
        Il gioco prende luogo nella città di Carbon, Texas nell'anno 2208. Si può scegliere fra tre personaggi da controllare: Cain, Cyrus e Nadia. 
        Tutti e tre fanno parte della Confraternita d'Acciaio texana, con il ruolo di iniziati. La storia è divisa in capitoli.
        I membri della Confraternita sono scomparsi a Carbon e l'iniziato prescelto ha il compito di cercare i paladini, a partire dalla città vicina. I criminali armati si aggirano in città e stanno facendo del loro meglio per distruggere i mobili di un vicino bar. Il barista sarà dunque grato se l'Iniziato ucciderà alcuni di loro e, in cambio, guiderà l'Iniziato nella direzione del sindaco sfuggente di questa città ormai senza legge.
        Il sindaco potrebbe incaricare l'elettorato a risolvere i problemi a causa dello stato della sua città attraverso varie missioni, una in particolare darà al personaggio uno sconto-ricompensa per aver aiutato il sindaco. Questo non farà rivelare al sindaco la posizione dei paladini scomparsi. Egli inoltre insiste che il personaggio 
        del giocatore ripulisca un'infestazione di scorpioni radioattivi nel magazzino vicino.
        L'Iniziato può però raccogliere le code di scorpione e qualsiasi contenuto del magazzino 
        che non sia inchiodato, che il barista è interessato ad acquistare. Quando tutti gli scorpioni 
        mutanti giganti, radioattivi e normali saranno sconfitti, l'Iniziato ritorna dal sindaco. Il sindaco rivelerà così la posizione 
        dei paladini scomparsi diretti in direzione di un enorme cratere fuori città.
        Seguendo la strada verso il basso, l'Iniziato scopre che il sindaco non è uno di quei personaggi non giocanti; Egli ha più esplosivi 
        con sé che chiunque dovrebbe davvero essere in grado di trasportare e sembra determinato a scaricarne il più possibile nelle vicinanze dell'Iniziato. Il risultato finale di questa scelta per il sindaco è un bel pisolino sotto lo scivolo roccioso causato dai suoi esplosivi. Il personaggio del giocatore ritornerà dunque in città.
        Intanto i predoni hanno smesso di bighellonare a favore del saccheggio. Molti cittadini della città sono fuggiti, uno di loro che non è 
        riuscito a raggiungere il proprio rifugio nel magazzino recentemente sgomberato richiede l'aiuto dell'Iniziato per salvarli. 
        Ma prima un totale di 37 cittadini sparsi in tutte le aree della città hanno bisogno di aiuto. Se dovessero essere salvati 
        dall'Iniziato, Wasteland Stranger sarà davvero molto grato, donando un fucile BB Red Ryder LE. I banditi all'interno della città e il 
        loro leader stanno facendo ciò che gli riesce meglio ma l'Iniziato troverà il modo di renderli meno ostili.        
        Con l'aiuto di Vault Dweller, il protagonista del primo titolo di Fallout, il personaggio del giocatore si dirige verso la città di Los. Lì, andrà in cerca di alcuni supermutanti. La ricerca conduce alla Chiesa dei Perduti, un culto particolare all'interno della città. Un paladino della Confraternita, Rhombus, chiede al personaggio del giocatore di uccidere il leader della setta, Blake. Blake e l'Iniziato combattono e, dopo aver recuperato una chiave dal leader del culto ormai morente, 
        il personaggio accompagna Rhombus su un camion per nasconderla.
        Ma quando tenterà di portare in salvo la chiave, esso sarà attaccato da un particolare tipo di ghoul kamikaze. 
        Il personaggio del giocatore, avvertito del pericolo, uccide tutti i ghoul kamikaze presenti nell'area. Rhombus,
        gravemente ferito, gli dà la chiave magnetica e affida il compito di fermare i supermutanti, che stanno per combinare qualcosa 
        di orribile e c'entrano con la sparizione di alcuni membri della Confraternita. Il personaggio del giocatore chiede informazioni ai
        ghoul di Los e uno di loro parla di un magazzino e di un "Vault segreto" che si trova non lontano dalla posizione attuale. Il personaggio troverà poi il magazzino ed entrerà all'interno.
        Dopo aver combattuto nel magazzino, l'Iniziato riesce a riparare un vecchio generatore e prende un ascensore che si 
        affaccia sull'ingresso del caveau segreto. Qui, due supermutanti attivano delle torrette che l'Iniziato dovrà distruggere. 
        Dopo tutto ciò, il personaggio del giocatore userà la chiave magnetica per aprire la porta del rifugio corazzato ed entrare. 
        Durante una battaglia con Attis, il generale supermutante, l'Iniziato 
        viene lasciato incosciente e quasi morto. Con l'aiuto degli abitanti umani del vault, 
        l'Iniziato viene rianimato ed entra nelle rovine del vault in cerca di Attis. Quando i due 
        si incontrano di nuovo, Attis si è trasformato in un blob (dalle sembianze simili a quelle del Maestro, in Fallout 3). 
        Il giocatore combatte contro di lui per ottenere l'accesso a un terminale di un computer che può avviare la decontaminazione 
        e l'autodistruzione del caveau.
         L'Iniziato, dopo la lotta, correrà via con un mezzo su monorotaia, sfuggendo all'autodistruzione del vault. 
        </p>
    <p class="simpleText">
        <strong>Ambientazione</strong><br />
        La storia in Fallout: Brotherhood of Steel si svolge in una sola zona per capitolo. 
        Una zona è composta da molte posizioni e il personaggio può tornare alle posizioni precedentemente visitate quando 
        lo desidera fino a quando non entra in un nuovo capitolo e in una nuova zona (Carbon, Los o il Vault Segreto). A volte non 
        si è in grado di visitare una nuova posizione fino a quando la trama non avanza. L'intero sistema è 
        simile alla moda di Deus Ex o Vampire: The Masquerade - Redemption. Ci sono 50 mappe separate di varie dimensioni nel gioco. 
        Le principali località sono: Vault Prototipo, Carbon, Carbon Centro, Carbon Bar, Carbon Warehouse, Cratere di Carbon,Carbon Ovest,Carbon Nord,Carbon Est,Carbon Mill, 
        Los,Ponte di Los,Bacini di Los,Pozzo del Gladiatore,Magazzino Vault-Tec,Vault Segreto,Vault Segreto - Area di residenza,Vault Segreto - Giardino,Vault Segreto - Strutture varie,Vault Segreto - Rovine,Vault Segreto - Laboratori  
    </p>
    </div>
    

    
    
           <div class="colonnaGrande">
                <div class="slider_container">
                    <div class="slider">
                      <div class="slide one">
                        <img src="ImmaginiVideoSito/falloutB-1.jpg" alt="copertina del videogioco" />
                        <span class="caption"> Copertina </span>
                      </div>
                      <div class="slide two">
                        <img src="ImmaginiVideoSito/falloutBgame.jpg" alt="Gameplay" />
                        <span class="caption"> Gameplay </span>
                      </div>
                      <div class="slide three">
                        <img src="ImmaginiVideoSito/falloutB-3.jpg" alt="Attis" />
                        <span class="caption"> Attis </span>
                      </div>
                      <div class="slide four">
                        <img src="ImmaginiVideoSito/falloutb-4.jpg" alt="Cyrus" />
                        <span class="caption"> Cyrus </span>
                      </div>
                      <div class="slide five">
                        <img src="ImmaginiVideoSito/falloutB-5.jpeg" alt="Donne di Carbon" />
                        <span class="caption"> Donne di Carbon </span>
                      </div>
                      
                    </div>
                </div>
            </div>


</body>


</html> 