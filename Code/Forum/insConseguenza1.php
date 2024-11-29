<?php
session_start();
require "funzioniUtili.php";

var_dump($_SESSION);

if(isset($_POST['valuta'])){
if(isset($_POST['nP'])){
    if($_POST['nP']=='si'){
        OperaSuPost(1,$_SESSION['codiceDiscussione'],$_SESSION['cpSeg']);
    }
    if(isset($_POST['w'])){
        if($_POST['w']=='' && $_POST['valuta']=='accettata'){
            //accetto con pazienza
            accettaRifiutaSegnalazione($_POST['valuta'],$_SESSION['codSeg']); 
            inserisciConseguenza($_SESSION['codSeg'],'','',0,date('Y-m-d'),$_SESSION['username']);
        }
        if($_POST['w']!='' && $_POST['valuta']=='accettata'){
            //accetto con ringraziamento
            accettaRifiutaSegnalazione($_POST['valuta'],$_SESSION['codSeg']);
            punti($_SESSION['uSeg'],+2);
            inserisciConseguenza($_SESSION['codSeg'],$_POST['w'],$_SESSION['uSeg'],+2,date('Y-m-d'),$_SESSION['username']);

        }
        if($_POST['w']=='' && $_POST['valuta']=='rifiutata'){
            //rifiuto senza warning
            accettaRifiutaSegnalazione($_POST['valuta'],$_SESSION['codSeg']); 
            inserisciConseguenza($_SESSION['codSeg'],'','',0,date('Y-m-d'),$_SESSION['username']);
        }
        if($_POST['w']!='' && $_POST['valuta']=='rifiutata'){
            //rifiuto con warning
            accettaRifiutaSegnalazione($_POST['valuta'],$_SESSION['codSeg']);
            punti($_SESSION['uSeg'],-2);
            inserisciConseguenza($_SESSION['codSeg'],$_POST['w'],$_SESSION['uSeg'],+2,date('Y-m-d'),$_SESSION['username']);

        }

        if(isset($_POST['sU'])){
            if($_POST['sU']=='si'){
                sospendiUtente($_SESSION['codiceDiscussione'],$_SESSION['ucp']);
            }
        }

        if(ritornaRuolo($_SESSION['username'])==1){
            if(isset($_POST['banP'])){
                if($_POST['banP']=='si'){
                    bannaUtente($_SESSION['ucp'],$_POST['dataFineBan']);
                }

            }
        }

        if(isset($_POST['rA'])){
            if($_POST['rA']=='si'){
                $risalto = 1;
                cambiaRisalto($risalto,$_SESSION['codice']);

            }
        }

        

    }
}//end if isset nP

echo "<html><head><script>alert(' Operazione completata con successo!'); window.location.href='gestioneSAdmin.php'</script></head><body></body></html>";

}//end if isset valuta