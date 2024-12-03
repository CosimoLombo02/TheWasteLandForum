<!DOCTYPE html> <!--questa pagina contiene video, viene usate html 5-->

<html>


<head>
    <title> Home page forum</title> 
    <!--<link rel="stylesheet" href="foglioDiStile.css " type="text/css" /></head>-->
    <link rel ="stylesheet" href="../CSS/homepage.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno-->
    <?php
    session_start();
    /* if(isset($_SESSION['username'])){
        
    $User=$_SESSION['username'];
    
            echo "<div class='topnav'><a href='../logout.php'>Logout</a><a href='../homepage.php'>Pagina iniziale</a><a href='regGenerali.php'>Regole Generali</a><a href='../fallout1.php'>Fallout 1</a><a href='../fallout2.php'>Fallout 2</a><a href='../fallout3.php'>Fallout 3</a><a href='../fallout4.php'>Fallout 4</a><a href='../falloutT.php'>Fallout Tactics</a><a href='../falloutB.php'>Fallout Brotherhood Of Steel</a><a href='../falloutN.php'>Fallout New Vegas</a><a href='../fallout76.php'>Fallout 76</a><a href='../falloutS.php'>Fallout Serie TV</a><a href='nuovaDiscussione.php'>Nuova discussione</a><a href='discussioni.php'>Discussioni</a><a href='bachecaPersonale.php'>$User</a></div>";

        }else{
            
            echo "<div class='topnav'><a href='../reservedArea.php'>Login</a><a href='../homepage.php'>Pagina iniziale</a><a href='regGenerali.php'>Regole Generali</a><a href='discussioni.php'>Discussioni</a><a href='../fallout1.php'>Fallout 1</a><a href='../fallout2.php'>Fallout 2</a><a href='../fallout3.php'>Fallout 3</a><a href='../fallout4.php'>Fallout 4</a><a href='../falloutT.php'>Fallout Tactics</a><a href='../falloutB.php'>Fallout Brotherhood Of Steel</a><a href='../falloutN.php'>Fallout New Vegas</a><a href='../fallout76.php'>Fallout 76</a><a href='../falloutS.php'>Fallout Serie TV</a></div>";


            }//end else
            */ require "mostraNavBar1.php";?>
    

    <div class="container">
        <div class="itemText">
            <p style="color:green">Questa è la pagina principale del forum, qui potrai trovare e/o creare discussioni 
                su qualsiasi media della saga
            </p>
        </div>
    </div>

    <div class="container">
        <div class="videoCentrato">
        <video width="480" height="360" controls>
        <source src="../ImmaginiVideoSito/combatGameplay.mp4" type="video/mp4">
        </video> 
        </div>
        <!--<div class="item"></div>-->
    </div>



</body>


</html> 