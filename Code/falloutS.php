<?xml version="1.0" encoding="UTF-8"?>
<?php
session_start();
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Fallout Serie TV</title> 
    <link rel ="stylesheet" href="CSS/stilePagLore.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
    
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno
    quando si entra nella pagina di un media, la voce relativa a quel media viene sostituita
    con una voce per tornare alla pagina principale-->
    <?php 
/*
    if(isset($_SESSION['username'])){
        $User=$_SESSION['username'];
        echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='homepage.php'>Home Page</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni</a><a href='Forum/bachecaPersonale.php'>$User</a></div>";

    }else{

        echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='Forum/discussioni.php'>Discussioni</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='homepage.php'>Home Page</a></div>";


        }//end else
    */require "mostraNavBar.php";
    
    ?>
    
    
    <!--L'idea è la seguente: ogni pagina di questo tipo avrà una sezione con la lore del media in questione
    e di fianco uno slider costruito attraverso css che mostrerà immagini riguardanti quel media, sempre cercando di mantenere lo
    stile da terminale
    -->
    <div class="colonnaGrandeScroll">
        <p class="simpleText"><strong>Trama</strong><br />
        In un XXI secolo distopico, in cui l'estetica e la cultura americana degli anni '50 non sono mai tramontate, dove il progresso della tecnologia nucleare dopo la Seconda guerra mondiale ha portato ad emergere una società retrofuturistica e a una successiva guerra per le risorse, il mondo è ancora diviso in sfere d'influenza tra Stati Uniti d'America e il blocco comunista costituito da Cina e Unione Sovietica, sotto la minaccia reciproca delle armi nucleari.
2077. Cooper Howard è una stella di Hollywood, attore western che sponsorizza la propaganda anticomunista del governo e ha una bella famiglia sulle colline di Los Angeles, quando esplode una guerra nucleare e tutto il pianeta viene ridotto in cenere dai bombardamenti atomici. La popolazione americana è colta di sorpresa e solo alcuni sopravvissuti in Nord America riescono a rifugiarsi in rifugi antiatomici conosciuti come Vault, costruiti e promossi dalla Vault-Tec per preservare l'umanità in caso di sterminio nucleare nei secoli a venire.
2296. 219 anni dopo, una giovane donna, Lucy MacLean, discendente dai primi abitanti del Vault 33, lascia dietro di sé l'unica vita che abbia mai conosciuto nel sottosuolo, per avventurarsi nella Zona contaminata, pericolosamente ostile e selvaggia, verso una California devastata. 
         
</p>
    <p class="simpleText">
        <strong>Ambientazione</strong><br />
       La serie tv è ambientata nella West Cost degli Stati Uniti, viene menzionata anche Shady Sands, famosa città della New California Republic.
    </p>
    </div>
    

    
    
           <div class="colonnaGrande">
                <div class="slider_container">
                    <div class="slider">
                      <div class="slide one">
                        <img src="ImmaginiVideoSito/falloutS-1.jpg" alt="copertina della serie" />
                        <span class="caption"> Copertina </span>
                      </div>
                      <div class="slide two">
                        <img src="ImmaginiVideoSito/falloutS-2.jpg" alt="Lucy" />
                        <span class="caption"> Lucy </span>
                      </div>
                      <div class="slide three">
                        <img src="ImmaginiVideoSito/falloutS-3.jpg" alt="Lucy e Maximus" />
                        <span class="caption"> Lucy e Maximus </span>
                      </div>
                      <div class="slide four">
                        <img src="ImmaginiVideoSito/falloutS-4.jpg" alt="Il Ghoul (Cooper)" />
                        <span class="caption"> Il Ghoul (Cooper) </span>
                      </div>
                      <div class="slide five">
                        <img src="ImmaginiVideoSito/falloutS-5.jpg" alt="Super-Duper Mart" />
                        <span class="caption"> Super-Duper Mart </span>
                      </div>
                      
                    </div>
                </div>
            </div>


</body>


</html> 