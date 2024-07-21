<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();

     
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Fallout 1</title> 
    <link rel ="stylesheet" href="CSS/stilePagLore.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno
    quando si entra nella pagina di un media, la voce relativa a quel media viene sostituita
    con una voce per tornare alla pagina principale-->
    <?php if(isset($_SESSION['username'])){
      $User=$_SESSION['username'];

    echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='#'>Forum</a><a href='homepage.php'>Home Page</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='#'>$User</a></div>";

    }else{

    echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='#'>Forum</a><a href='homepage.php'>Home Page</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a></div>";


    }//end else
    
    
    ?>
    
    
    <!--L'idea è la seguente: ogni pagina di questo tipo avrà una sezione con la lore del media in questione
    e di fianco uno slider costruito attraverso css che mostrerà immagini riguardanti quel media, sempre cercando di mantenere lo
    stile da terminale
    -->
    <div class="colonnaGrandeScroll">
        <p class="simpleText"><strong>Trama</strong><br />
        Intorno all'anno 2077 il mondo fu teatro di una guerra tra la
         Cina e gli Stati Uniti d'America, motivata dalla volontà delle grandi potenze di accaparrarsi gli ultimi giacimenti di petr
         olio e uranio. Dopo mesi di scontri i predetti Stati utilizzarono le bombe atomiche portando l'umanità vicina all'estinzione. In previsione di un simile avvenimento erano stati costruiti dei rifugi antiatomici, i Vault, nei quali trovarono riparo diverse migliaia di persone. Quasi tutti gli esseri viventi rimasti all'esterno perirono, 
         e i pochi sopravvissuti subirono mutazioni genetiche più o meno gravi.Il gioco inizia nel 2161, quando il microchip necessario per la purificazione dell'acqua del Vault 13 si guasta. Il protagonista è chiamato ad affrontare il mondo esterno, (in quanto i due abitanti precedentemente incaricati non hanno fatto più ritorno) per cercare il pezzo di ricambio necessario a salvare la propria gente. Una volta trovato il Water-Chip, l'abitante del Vault deve confrontarsi con "il Maestro" e il suo irriducibile esercito di mutanti, per sventare i suoi piani di conquista delle terre desolate. 
    </p>
    <p class="simpleText">
        <strong>Ambientazione</strong><br />
        Il giocatore si trova catapultato in un mondo parallelo a quello reale, 
        dove l'orologio sembra essersi fermato tra gli anni quaranta e cinquanta del XX secolo. 
        Più correttamente è come se il mondo avesse preso un'altra piega da quegli anni in poi: 
        il futuro visto dagli occhi di una persona d'altri tempi. Manifesti con volti sorridenti 
        e truccati spesso contrastanti con il messaggio violento che invece trasmettono, 
        armi laser improbabili e veicoli d'epoca modificati con reattori altrettanto improbabili. 
    </p>
    </div>
    

    
    
           <div class="colonnaGrande">
                <div class="slider_container">
                    <div class="slider">
                      <div class="slide one">
                        <img src="ImmaginiVideoSito/fallout1-1.jpeg" alt="copertina del videogioco" />
                        <span class="caption"> Copertina </span>
                      </div>
                      <div class="slide two">
                        <img src="ImmaginiVideoSito/fallout1-2.jpg" alt="Visuale 2D" />
                        <span class="caption"> Visuale 2D </span>
                      </div>
                      <div class="slide three">
                        <img src="ImmaginiVideoSito/fallout1-3.jpg" alt="Sovrintendente del vault 13" />
                        <span class="caption"> Sovrintendente del vault 13 </span>
                      </div>
                      <div class="slide four">
                        <img src="ImmaginiVideoSito/shady sands.jpg" alt="Shady Sands" />
                        <span class="caption"> Shady Sands </span>
                      </div>
                      <div class="slide five">
                        <img src="ImmaginiVideoSito/fallout1-5.png" alt="Mappa del mondo" />
                        <span class="caption"> Mappa del mondo </span>
                      </div>
                      
                    </div>
                </div>
            </div>


</body>


</html> 