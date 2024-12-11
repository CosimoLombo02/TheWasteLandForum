<?xml version="1.0" encoding="UTF-8"?>



<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Gestione Utenti</title> 
    <link rel ="stylesheet" href="../CSS/bachecapersonale.css" type = "text/css" />
    <link rel ="stylesheet" href="../CSS/adminStile.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <script type="text/javascript" src="../JS/popUp.js"></script>
    
</head>
<body>
<?php

session_start(); require "riferimento.php";
require_once "funzioniUtili.php";   require "connection1.php"; //require "mostraNavBar1.php";
require "mostraNavBar1.php";
if(isset($_SESSION['username'])){
    if(ritornaRuolo($_SESSION['username']) == 0){
        header("Location: ../homepage.php"); //gli utenti normali non possono entrare qui
         }else{
            $User = $_SESSION['username'];
            //echo "<div class='topnav'><a href='../logout.php'>Logout</a><a href='forumHP.php'>Homepage Forum</a><a href='../homepage.php'>Pagina iniziale</a><a href='regGenerali.php'>Regole Generali</a><a href='../fallout1.php'>Fallout 1</a><a href='../fallout2.php'>Fallout 2</a><a href='../fallout3.php'>Fallout 3</a><a href='../fallout4.php'>Fallout 4</a><a href='../falloutT.php'>Fallout Tactics</a><a href='../falloutB.php'>Fallout Brotherhood Of Steel</a><a href='../falloutN.php'>Fallout New Vegas</a><a href='../fallout76.php'>Fallout 76</a><a href='../falloutS.php'>Fallout Serie TV</a><a href='nuovaDiscussione.php'>Nuova discussione</a><a href='discussioni.php'>Discussioni</a><a href='bachecaPersonale.php'>$User</a><a href='gestioneUtenti.php'>Gestione Utenti</a><a href='gestioneCategorie.php'>Gestione categorie e sottocategorie</a></div>";
         }
        }else header("Location: ../reservedArea.php");


     
?>

<?php if(isset($_POST['banna'])){
    $_SESSION['creatorePost'] = $_POST['nomeUtente'];               
    echo '<div id="overlay"></div>';
    echo '<div id="popup">';
    echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
    echo '<h3>Banna Utente</h3>';
    echo '<form id="popupForm" action="bannaUtente.php" method="POST" >';
    echo '<label for="data">Data:</label>';
    echo '<input type="date" class="date" name="data" value="'.date("Y-m-d", strtotime("+1 day")).'" />';
   echo '<input type="submit" class="button" name="invia" value="Invia" />';
    echo '</form>';
    echo '</div>';}//end if banna

    if(isset($_POST['sbanna'])){
        $nU = $_POST['nomeUtente'];
        $sql = "update utenti set dataFineBan=null,ban= 0 where strcmp(nomeUtente,'$nU')=0";
        $result = mysqli_query($conn,$sql);
        if($result) popUp1('Operazione completata!');

    }

?>
    
        <div class="colonnaGrandeScroll">
            <?php
          
            $sql = "select * from utenti where ruolo=0";
            $result = mysqli_query($conn,$sql);
            if($result){
                while($row = mysqli_fetch_array($result)){
                    echo '<p class="testoGenerico">Nome utente: '.$row['nomeUtente'].'</p>';
                    echo '<p class="testoGenerico">Stato Reputazione: '.statoReputazione($row['livelloReputazione']).'</p>';
                  
                    echo '<form action="gestioneUtenti.php" method = "post">';
                    echo '<div>';
                    if(presenzaBan($row['nomeUtente'])){
                        //se c'è il ban mostro la data di fine ban 
                        if($row['dataFineBan'] >= date('Y-m-d')){
                           echo '<p class="testoGenerico">Utente bannato fino al '.$row['dataFineBan'].'</p>';
                        }else{
                            echo '<p class="testoGenerico">Utente bannato a data da destinarsi</p>';
                        }
                        echo '<input type="submit" name = "sbanna" class="button1" value = "Sbanna Utente" />';
                    }//end if presenza ban
                    else{
                        echo '<input type="submit" name = "banna" class="button1" value = "Banna Utente" />';
                    }//end else presenza ban
                    echo "<input type='hidden' name='nomeUtente' value='".$row['nomeUtente']."'/>";
                    echo '</div>';
                    echo '</form>';
                    echo '<hr />';
                }
            }//end result 


             ?>
        </div>

       
            
    

</body>


</html> 