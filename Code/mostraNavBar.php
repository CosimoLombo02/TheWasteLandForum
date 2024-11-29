<?php // require "Forum/funzioniUtili.php";
require "connection.php";
if(isset($_SESSION['username'])){
        $User=$_SESSION['username'];
        $sql = "select ruolo from utenti where strcmp(nomeUtente,'$User')=0";
        $result = mysqli_query($conn,$sql);
        if($result){
            while($row = mysqli_fetch_array($result)){
                $ruolo = $row['ruolo'];
            }
            if($ruolo==1){
                echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='homepage.php'>Pagina Iniziale</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni<a href='Forum/bachecaPersonale.php'>$User</a><a href='Forum/gestioneUtenti.php'>Gestione Utenti</a><a href='Forum/gestioneSAdmin.php'>Segnalazioni con risalto</a></div>";
            }else{
                echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='homepage.php'>Pagina Iniziale</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni<a href='Forum/bachecaPersonale.php'>$User</a></div>";
            }
        }
        //if(ritornaRuolo($User) == 0)
           //  echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='homepage.php'>Pagina Iniziale</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni<a href='Forum/bachecaPersonale.php'>$User</a></div>";
/*if(ritornaRuolo($User)==0){
    echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='homepage.php'>Pagina Iniziale</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni<a href='Forum/bachecaPersonale.php'>$User</a></div>";
}else{
    echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='homepage.php'>Pagina Iniziale</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a><a href='Forum/nuovaDiscussione.php'>Nuova discussione</a><a href='Forum/discussioni.php'>Discussioni<a href='Forum/bachecaPersonale.php'>$User</a><a href='Forum/gestioneUtenti.php'>Gestione Utenti</a><a href='Forum/gestioneCategorie.php'>Gestione categorie e sottocategorie</a></div>";
}*/

           
 //<a href='Forum/gestioneUtenti.php'>Gestione Utenti</a><a href='Forum/gestioneCategorie.php'>Gestione categorie e sottocategorie</a>
        }else{

            echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='homepage.php'>Homepage Sito</a><a href='Forum/forumHP.php'>Forum</a><a href='Forum/regGenerali.php'>Regole Generali</a><a href='Forum/discussioni.php'>Discussioni</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a><a href='falloutS.php'>Fallout Serie TV</a></div>";


            }//end else