<?xml version="1.0" encoding="UTF-8"?>
<!--Questa è la pagina scheletro di ogni bacheca personale-->

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Bacheca Personale</title> 
    <link rel ="stylesheet" href="../CSS/bachecapersonale.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
</head>

<?php 
//qui min occupo di recuperare i dati dell'utente
session_start();
require "riferimento.php";
require "funzioniUtili.php";
require "../connection.php";
$conta=1;
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
//var_dump($_SESSION);
}
else{
    session_destroy();
    header("Location: ../reservedArea.php");
}

if(ritornaRuolo($username)==1){
    //admin page ancora da sviluppare 
    //echo "comando io"; //qui se si è l'admin si viene reindirizzati nella sua bacheca personale dedicata 
    header('Location: Admin.php');
}else{
    /*if($conta==1){echo popUp($_SESSION['username']); }*/


    $sql = "select * from utenti where nomeUtente='$username'";
    $result=mysqli_query($conn,$sql);
    if($result){
       // echo "sono qui";
        while($row = mysqli_fetch_array($result)){
            //prendo tutti i dati dell'utente
           // echo $row['nomeUtente'];
            $avatar=$row['nomeFileAvatar'];
            $email_user=$row['email'];
            $livelloReputazione=$row['livelloReputazione'];
        }
    }//end if result
    
    $path = "../Avatar/".$avatar;
    
    //debug 
   // echo "<img src='$path'/>";
   // echo $email_user;
    
    
    
}//end else admin?>
<body>
<?php require "mostraNavBar1.php";// echo "<div class='topnav'><a href='../logout.php'>Logout</a><a href='../homepage.php'>Pagina iniziale</a><a href='forumHP.php'>Forum</a><a href='regGenerali.php'>Regole Generali</a><a href='../fallout1.php'>Fallout 1</a><a href='../fallout2.php'>Fallout 2</a><a href='../fallout3.php'>Fallout 3</a><a href='../fallout4.php'>Fallout 4</a><a href='../falloutT.php'>Fallout Tactics</a><a href='../falloutB.php'>Fallout Brotherhood Of Steel</a><a href='../falloutN.php'>Fallout New Vegas</a><a href='../fallout76.php'>Fallout 76</a><a href='../falloutS.php'>Fallout Serie TV</a><a href='discussioni.php'>Discussioni</a><a href='nuovaDiscussione.php'>Nuova discussione</a></div>";?>
<div class='container'>
            <?php
            
            echo "<img src='$path' class='immagineCornice' alt='$avatar'/>";
            ?>
        </div>

<div class="container">
        <?php
        /*echo'<p style="color:green;"> Username: '.$username.'</p><br>';
        echo'<p style="color:green;"> Email: '.$email_user.'  '.'</p>';
        echo'<p style="color:green;">'.'  '.' Punti Reputazione: '.$livelloReputazione.'  -->  '.' Stato Reputazione:'.statoReputazione($livelloReputazione) .'</p>';
       // echo "<img src='$path' class='immagineCornice'/>";*/

       echo '<table><thead>';
       echo '<tr><th>Nome Utente</th><th>Email</th><th>Punti </th><th>Livello Reputazione</th></tr></thead>';
       echo '<tbody>';
       echo '<tr>';
       echo '<td>'.$username.'</td>';
       echo '<td >'.$email_user.'</td>';
       echo '<td>'.$livelloReputazione.'</td>';
       echo '<td>'.statoReputazione($livelloReputazione).'</td>';
       echo '</tr>';
       echo '</tbody>';
       echo '</table>'
    
        ?>

        <button class="button" onclick="window.location='cambiaDati.php'">Cambia i tuoi dati</button>
       
        
    </div>

    <!--Questo container contiene i due bottoni di selezione per vedere le discussioni di cui si è moderatori
    e anche le segnalazioni con le conseguenze -->
    <div class='container'>
        <form action = "bachecapersonale.php" method = "post">
            <div>
        
        <button class="button" type = "submit" name ="discussioni">Discussioni moderate</button>
        <button class="button" type = "submit" name ="segnalazioni">Segnalazioni effettuate</button></div>
        
        
        
        </form>

    </div>
    
        <?php 
        //ora a seconda di cosa è stato premuto faccio visualizzare contenuto diverso
        if(isset($_POST['discussioni'])){
            echo "<h2>Discussioni Moderate</h2>";
            echo "<div class='colonnaGrandeScroll'>";
            //qui verranno visualizzate tutte le discussioni moderate dall'utente in questione
           
         
              
           
            
            //carico il file XML
            $doc=caricaXML("Discussioni.xml","schemaDiscussioni.xsd");
            $discussioni = $doc->getElementsByTagName('discussione'); //prendo tutte le discussioni
            $conta =0; //questo contatore mi serve per vedere se esistono discussioni con quel media, quella categoria e quella determinata sotto categoria
            foreach ($discussioni as $discussione) {

                //first e second sono dei flag che servono per capire se l'untente in questione è moderatore di quella discussione
                //first va a true se l'utente è creatore di quella discussione
                //mentre second va a true se l'utente è moderatore(anche non creatore) della discussione
                //questo or va poi in and con lo stato della discussione, ovvero se è attiva o meno

                $first = false;
               
                if($discussione->getElementsByTagName('nomeUtenteCreatoreDiscussione')->item(0)->nodeValue==$username)
                    $first=true;
                //else echo "fallito"; di debug 

                $second = false;
               
                //questa parte è da testare ancora bene
                $mod = $discussione->getElementsByTagName('ModeratoriEletti')->item(0);
                $moderatori = $mod->getElementsByTagName('nomeUtenteModeratore');
                foreach($moderatori as $moderatore){
                    if($moderatore->nodeValue==$username)
                        $second = true;
                }//end foreach
                
              
             if(($first || $second) && $discussione->getElementsByTagName('statoDiscussione')->item(0)->nodeValue=="attiva"){
                $conta++; 
                
                echo "<form action='reindirizza.php' method='post'>";
                    echo "<div class='containerTitolo'><button class='buttonF' type='submit'>".$discussione->firstChild->nextSibling->textContent."</button>"; //titolo
                    echo "<input type='hidden' name='codDiscussione' value='".$discussione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue."'/></div>";
                    echo "</form>";
                echo " "."Data Creazione: ".$discussione->getElementsBytagName('dataCreazioneD')->item(0)->nodeValue."</p>";
                echo "Numero di post: ".$discussione->getElementsByTagName('listaPost')->item(0)->childNodes->count()."</p>";
                echo "<hr />";
                 
                
             } 
             
               
                
            }//end foreach
            echo "</div>"; //colonnaGrandeD

            if($conta==0){
             //Se entro qui significa che non ho trovato nessuna recensione con questi dati
             echo "<div><h1>Non moderi nessuna discussione</h1></div>";
            }
         

        }else{
            if(isset($_POST['segnalazioni'])){
                echo "<h2>Segnalazioni effettuate</h2>";
                //qui invece verranno fatte visualizzare tutte le segnalazioni effettuate dall'utente
                //verranno anche visualizzate eventuali conseguenze delle segnalazioni
                //carico il file XML
                echo "<div class='colonnaGrandeScroll'>";
            $doc=caricaXML("segnalazioni.xml","schemaSegnalazioni.xsd");
            $segnalazioni = $doc->getElementsByTagName('segnalazione'); 
            $conta=0; 
            

            $doc = caricaXML("conseguenzeSegnalazioni.xml","");
            $conseguenzeSegnalazioni = $doc->getElementsByTagName('ConseguenzaSegnalazioni');

            

            foreach($segnalazioni as $segnalazione){
               // echo "<p>Sono qui</p>"; debug
                if($segnalazione->getElementsByTagName('utenteSegnalatore')->item(0)->nodeValue==$username){
                    $conta++;
                    $codiceSegnalazione = $segnalazione->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue;
                    $data = $segnalazione->getElementsByTagName('data')->item(0)->nodeValue;
                    $stato = $segnalazione->getElementsByTagName('stato')->item(0)->nodeValue;
                    $titoloDiscussione = ritornaTitoloDiscussione($segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue);
                    $cod = $segnalazione->getElementsByTagName('codicePostSegnalato')->item(0)->nodeValue;
                    $testoPostSegnalato = ritornaPostDiscussione($cod,$segnalazione->getElementsByTagName('codiceDiscussione')->item(0)->nodeValue);

                    
            
                    echo "<p>Data : ".$data."</p>";
                    echo "<p>Titolo Discussione : ".$titoloDiscussione."</p>";
                    echo "<p>Testo post segnalato : ".$testoPostSegnalato."</p>";
                    echo "<p>Stato : ".$stato.'</p>';
                    
                    //presenzaConseguenze un flag che serve a capire se la segnalazione ha conseguenze o meno
                    $presenzaConseguenze = presenzaConseguenze($codiceSegnalazione);
                    

                    if(($stato == 'accettata' || $stato = 'rifiutata') && $presenzaConseguenze==true){
                        
                        //se sono qui è perche la segnalazione è stata lavorata, quindi prendo anche
                        //ovviamente le segnalazioni verso l'utente segnalatore 
                        //se ci sono conseguenze allora procedo
                        foreach($conseguenzeSegnalazioni as $conseguenza){
                            if($conseguenza->getElementsByTagName('codiceSegnalazione')->item(0)->nodeValue==$codiceSegnalazione){
                                //faccio visualizzare le eventuali conseguenze 
                                $puntiConseguenza = $conseguenza->getElementsByTagName('descrizioneConseguenza')->item(0)->nodeValue;
                                $dataEvasione = $conseguenza->getElementsByTagName('dataEvasioneSegnalazione')->item(0)->nodeValue;
                                $gestitaDa = $conseguenza->getElementsByTagName('utenteGestore')->item(0)->nodeValue;

                                echo "<p>Data Evasione: ".$dataEvasione."</p>";
                                echo "<p> Gestita da  : ".$gestitaDa."</p>";
                                echo "<p>Punti conseguenza : ".$puntiConseguenza."</p>";
                                if($conseguenza->getElementsByTagName('testoWarning')->item(0)->nodeValue != null){
                                    $testoWarning=$conseguenza->getElementsByTagName('testoWarning')->item(0)->nodeValue;
                                    echo "<p>Nota dal gestore : ".nl2br($testoWarning)."</p>";
                                    echo '<hr />';
                                }//end if testoWarning
                                


                            }

                        }//end inner foreach

                    }
                    echo "<hr />";


                    


                }//end if principale all'interno del foreach
                

            } //end foreach
            echo "</div>"; //div colonnaGrandeScroll segnalazioni

            if($conta==0){
             //Se entro qui significa che non ho trovato nessuna recensione con questi dati
             echo "<div><h1>Non hai effettuato nessuna segnalazione</h1></div>";
            }
         
         
         
         
         //echo "</div>"; //div colonna grande scroll



            }//end if segnalazioni

        }//end else principale
        ?>
    
    
</body>
</html>


