<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Fallout New Vegas</title> 
    <link rel ="stylesheet" href="CSS/stilePagLore.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
    
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno
    quando si entra nella pagina di un media, la voce relativa a quel media viene sostituita
    con una voce per tornare alla pagina principale-->
    <?php /*

    if(isset($_SESSION['username'])){
      $User=$_SESSION['username'];
      echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='homepage.php'>Home Page</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni</a><a href='Forum/bachecaPersonale.php'>$User</a></div>";

    }else{

        echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='Forum/discussioni.php'>Discussioni</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='homepage.php'>Home Page</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a></div>";


        }//end else
    */require "mostraNavBar.php";
    
    ?>
    
    
    <!--L'idea è la seguente: ogni pagina di questo tipo avrà una sezione con la lore del media in questione
    e di fianco uno slider costruito attraverso css che mostrerà immagini riguardanti quel media, sempre cercando di mantenere lo
    stile da terminale
    -->
    <div class="colonnaGrandeScroll">
        <p class="simpleText"><strong>Trama</strong><br />
        La storia contiene alcune parti degli eventi di Fallout e Fallout 2, ed è strettamente collegata a quella di Fallout 3.
Fallout: New Vegas si svolge nel 2281, quattro anni dopo gli eventi di Fallout 3 e trentanove anni dopo quelli di Fallout 2. La Repubblica della Nuova California svolge un ruolo importante nella storia in una lotta a tre vie con la Legione di Caesar e il popolo locale di New Vegas.
Il Corriere, il protagonista, è stato assoldato per consegnare un pacchetto al Signor House. Tuttavia, il Corriere cade in un'imboscata e si becca un proiettile in testa. Gli viene sottratto l'oggetto da consegnare e poi, dato per morto, viene sepolto in una fossa poco profonda. Esecutore dell'agguato è Benny con l'aiuto di alcuni membri dei Great Khan. Il protagonista viene poi salvato da un robot Securitron di nome Victor che lo porta a Goodsprings.
Il corriere è quindi curato da un uomo, Il dottor Mitchell, un ex abitante del Vault 21 che gli regalerà anche il suo vecchio PipBoy 3000. In seguito inizierà una caccia all'uomo che porterà il Corriere sulle tracce di Benny, il misterioso uomo dalla giacca a quadri che gli ha sottratto la merce.
La sua ricerca lo porterà a Primm dove, dopo aver ristabilito l'ordine in città, scoprirà che gli uomini che lo accompagnavano, un gruppo di spacciatori appartenenti ai Great Khan, si sono diretti verso la città di Novac. Lungo il suo viaggio il corriere potrebbe imbattersi nella città di Nipton, questa è stata saccheggiata da un gruppo di legionari guidati da Vulpes Inculta, comandante della Legione di Ceasar. Giunto a Novac, il corriere apprenderà da Manny Vargas, un cecchino che difende la città degli attacchi dei ghoul, che i Great Khan si sono diretti a Boulder City, vicino alla diga di Hoover.
Giunto lì, il corriere dovrà affrontare una delicata situazione: i Great Khan hanno preso in ostaggio alcuni soldati della RNC e la situazione rischia di degenerare. Dopo aver risolto la situazione, il corriere scoprirà finalmente che Benny è tornato a New Vegas, città sorta dalle macerie della precedente Las Vegas. Dopo essere riuscito a entrare nella favolosa città, il corriere verrà invitato al Lucky 38, casinò da cui il signor House, fondatore di New Vegas, gestisce tutto. Il protagonista così apprende che Benny sta cercando di impadronirsi della città utilizzando il chip di platino rubato al Corriere. Questo chip è una chiave che permette di risvegliare un esercito dormiente di Securitron, di aggiornarli e di renderli più potenti. Il corriere si confronterà con Benny al casinò The Tops, il casinò gestito da Benny, per riottenere il chip di platino.
Dopo aver deciso il destino di Benny, il giocatore potrà decidere la sorte della zona contaminata del Mojave schierandosi con una delle quattro fazioni nella 2º battaglia di Hoover Dam. Il finale, seppure definitivo come quello di Fallout 3, offre una maggiore libertà di scelta. È possibile infatti schierarsi con la Legione di Caesar, con l'RNC, con il Sig. House, o mettersi in proprio (imbrogliando quindi tutte e tre le altre fazioni) tramite l'aiuto di un Securitron chiamato Yes Man. 
</p>
    <p class="simpleText">
        <strong>Ambientazione</strong><br />
        Il gioco è ambientato in una Las Vegas post-apocalittica, divenuta New Vegas dopo la distruzione portata 
        dalla grande guerra nucleare fra Stati Uniti e Cina, con l'olocausto nucleare verificatosi il 23 ottobre 2077. 
        Prima della grande guerra ci sono state le guerre delle risorse, durante le quali le Nazioni Unite si sono sciolte, 
        seguita dalla guerra per l'Alaska durata undici anni (2066–2077) e terminata con la liberazione di Anchorage dalle forze 
        cinesi da parte degli americani nel gennaio del 2077 (anno della grande guerra nucleare). La città di New Vegas non è stata 
        devastata come la costa est; sulla costa ovest infatti la maggior parte degli edifici sono intatti e sono presenti una diga e 
        una centrale solare che producono energia elettrica. Questo ha attirato l'interesse di organizzazioni quali l'RNC 
        (già presente in Fallout 2) e la Legione di Caesar. Sullo sfondo dello scontro tra queste due organizzazioni si posiziona 
        la vicenda del protagonista.
        La mappa è quattro volte più grande di quella del suo predecessore (sfiora i 36 km quadrati di superficie) e contiene 190 luoghi scopribili dal giocatore, distribuiti in territori appartenenti agli odierni Stati di Nevada (contea di Clark), California e Arizona. Lo spazio esplorabile a piedi dal corriere è chiamato Zona Contaminata del Mojave e riproduce fedelmente il reale deserto del Mojave. Vi si trovano le Spring Mountains, il fiume Colorado, il lago Mead e i caratteristici rilievi rocciosi, 
        in un ambiente arido e secco prevalentemente sabbioso punteggiato da bassi arbusti e poche aree fertili.
        La Zona Contaminata del Mojave ospita diverse specie vegetali e radici da cui il corriere può ricavare frutti, risultato di mutazioni genetiche per esposizione a radioattività. Il deserto del Mojave è popolato da svariate creature mutate dall'esposizione alle radiazioni. 
    </p>
    </div>
    

    
    
           <div class="colonnaGrande">
                <div class="slider_container">
                    <div class="slider">
                      <div class="slide one">
                        <img src="ImmaginiVideoSito/falloutN-1.jpeg" alt="copertina del videogioco" />
                        <span class="caption"> Copertina </span>
                      </div>
                      <div class="slide two">
                        <img src="ImmaginiVideoSito/falloutN-2.jpg" alt="Mojave" />
                        <span class="caption"> Mojave </span>
                      </div>
                      <div class="slide three">
                        <img src="ImmaginiVideoSito/falloutN-3.svg" alt="Bandiera NCR" />
                        <span class="caption"> Bandiera NCR </span>
                      </div>
                      <div class="slide four">
                        <img src="ImmaginiVideoSito/falloutN-4.jpg" alt="Pip-Boy 3000" />
                        <span class="caption"> Pip-Boy 3000 </span>
                      </div>
                      <div class="slide five">
                        <img src="ImmaginiVideoSito/falloutN-5.jpg" alt="Yes Man" />
                        <span class="caption"> Yes Man </span>
                      </div>
                      
                    </div>
                </div>
            </div>


</body>


</html> 