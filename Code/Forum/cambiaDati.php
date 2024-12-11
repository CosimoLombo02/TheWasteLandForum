<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title> Nuovi Dati</title> 
    <link rel ="stylesheet" href="../CSS/stileRegUtente.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="../ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <script type="text/javascript" src="../JS/anteprima.js"></script> <!--questo piccolo script serve per far vedere all'utente
                                                                    un anteprima dell'immagine che carica come avatar-->
    
</head>

<body><div><h1>Inserisci i dati che vuoi cambiare!(Non necessariamente tutti)</h1></div>
<?php

require "../connection.php";
require "funzioniUtili.php";
session_start();

 //il form inizialmente è riempito con tutti i dati dell'utente, tranne la password che per motivi di sicurezza 
 //non viene fatta visualizzare

 //attraverso questa query prendo i dati dell'utente
 $conta=1;
if(isset($_SESSION['username']))
$username = $_SESSION['username'];
else{
    session_destroy();
    header("Location: ../reservedArea.php");
}

    $sql = "select * from utenti where nomeUtente='$username'";
    $result=mysqli_query($conn,$sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            //prendo tutti i dati dell'utente
           // echo $row['nomeUtente'];
            $avatar=$row['nomeFileAvatar'];
            $email=$row['email'];
            $password=$row['password'];
            $nomeAvatar=$row['nomeFileAvatar'];
        }
    }//end if result

    $passw="";
    $pass1="";



 //se premo il tasto cambia allora devo attuare i cambiamenti
 if(isset($_POST['cambia'])){
    //controllo se l'username è stato cambiato e controllo che non sia vuoto
    if(!empty($_POST['newusername'])){
        if($_SESSION['username']!=$_POST['newusername']){ //se non sono uguali allora lo cambio
           
           //se sono qui controllo che il nuovo nomeUtente non sia già presente nel sistema
           $userTemp=$_POST['newusername'];
           $sql = "select u.nomeUtente from utenti u where strcmp(u.nomeUtente,'$userTemp')=0";
            $result = mysqli_query($conn, $sql); //query
            if(mysqli_num_rows($result)==1){
                echo "<div><p>Nome utente già presente nel sistema</p></div>";
                
            }else{
                //se sono qui posso cambiare il nome utente, ovviamente esso deve essere cambiato
                //anche i tutti i file xml presenti nel sistema e devo aggiornare il nome utente anche nel db
                 $oldUsername = $_SESSION['username'];
                 //qui ora attraverso queste funzioni metto in atto tutto cio
                 $newUsername = trim($_POST['newusername']); 
                 $sql = "update utenti  set nomeUtente='$newUsername' where strcmp(nomeUtente,'$oldUsername')=0";
                 $result = mysqli_query($conn, $sql);
                 $_SESSION['username'] = $newUsername;
                 $username = $newUsername;

                 cambiaTutto($_SESSION['username'],$oldUsername); //da testare bene

                 



            }//end else controllo username gia presente 

        }//end if !=

    }//end if empty username

    if(isset($_POST['newemail'])){
        //controllo che sia diversa da quella precedente e che non sia vuota
        if(!empty($_POST['newemail'])){
            if($_POST['newemail'] != $email){
                //se sono diverse allora proseguo con i controlli
                $emailTemp = $_POST['newemail'];
                if(filter_var($emailTemp, FILTER_VALIDATE_EMAIL)){ //usiamo questa funzione per vedere se la mail è well-formed
                    $sql = "select u.email from utenti u where strcmp(u.email,'$emailTemp')=0";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) == 1){
                       echo "<div><p>Attenzione!Email già presente nel sistema</p></div>";
                       
                    }else{

                        //effettuo ora l'update sul db 
                        $newEmail = trim($_POST['newemail']);
                        $sql = "update utenti set email='$newEmail' where strcmp(email,'$email')=0 ";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            echo "<div><p>Email correttamente aggiornata</p></div>";
                            $email=$newEmail;
                        }

                    }//end else email gia presente
                }//end if filter validate 

            }//end if diverse 

        }//end if empty email

    }//end if isset newemail

    //ora vediamo invece per la nuova password
    if(isset($_POST['newpassword']) && isset($_POST['newpasswordC'])){
        if(!empty($_POST['newpassword'])){
            $pattern = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/'; //la password deve avere almeno un carattere,almeno 1 carattere speciale
                                                                //almeno una lettera maiuscola ed almeno un numero
            $newpass = trim($_POST['newpassword']) ;
            if(preg_match($pattern,$newpass)){
                if($newpass == $_POST['newpasswordC']){
                    //qui controllo che la password non sia uguale a quella già immessa
                    if(md5($newpass)!=$passw){
                        //qui posso effettuare l'update 
                        $np = md5($newpass); 
                        //$p = md5($password);

                      /*  var_dump($username);
                        var_dump($_SESSION);*/

                        $sql = "update utenti set password='$np' where nomeUtente='$username'";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            echo "<div><p>Password correttamente aggiornata</p></div>";
                            //quando cambia la password distruggo la sessione
                            //require "../logout.php";
                            $_SESSION = array();

                    session_destroy(); //viene distrutta la sessione lato server
                    setcookie("PHPSESSID",'',time()-1,'/'); //cosi viene eliminato anche il cookie lato client

                    header("Location: ../reservedArea.php"); //si viene reindirizzati all'homepage principale del sito
                        }

                    }//end if password uguale gia inserita
                }//end if conferma password
                else{
                    echo "<div><h1>Le password non corrispondono !</h1></div>";
                }

            } else{
                echo "<div><h1>Nuova password non valida !</h1></div>";
            }                                                  


        }//fine if empty

    }



 }//end isset cambia
 if(isset($_POST['bacheca'])){
    header("Location: bachecapersonale.php");
 }

 

 if(isset($_FILES['avatar'])){
    $target_dir = "../Avatar/"; //directory target per gli avatar
    $target_file = $target_dir . basename($_FILES['avatar']['name']);
    $nomeFileAvatar = basename($_FILES["avatar"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //tipo del file
    if(!empty($_FILES['avatar']['tmp_name'])){
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //tipo del file
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if($check){
            //se sono qui, il file è probabilmente un'immagine, per sicurezza controllo la sua estensione
                // Vengono ammessi solo jpeg, png 
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    echo "<div><p>Attenzione! Sono ammessi solo JPG o PNG o JPEG!</p></div>";
                    //$uploadOk = 0;
            }else{
                if(copy($_FILES["avatar"]["tmp_name"],$target_file)){
                    //cancello il vecchio file e faccio l'update del dp
                    $sql = "update utenti set nomeFileAvatar='$nomeFileAvatar' where nomeUtente='$username'";
                    $result = mysqli_query($conn, $sql);
                    $path = "../Avatar/".$nomeAvatar;
                    unlink($path); 
                }//end if
            }//end else imageFileType

        }//end if check
        else{
            echo "<div><h1>Immagine non valida !</h1></div>";
        }


    }//end if empty


 }//end if isset avatar
 


?>

    <div >
       <form action="cambiaDati.php" method = "post" enctype="multipart/form-data">
        
        <p>Nuovo Nome Utente:  </p>  
        <p><input class="input" type="text" name = "newusername" size="100" value="<?php echo $username?>" /> </p>
        <p>Nuova Email: </p> 
        <p><input class="input" type="text" name = "newemail" size="100" value="<?php echo $email?>" /> </p>
        <p>Nuova Password: </p>
        <p><input  class="input" type = "password" name = "newpassword" size = "100" value="<?php echo $passw?>" /></p>
        <p>Conferma Nuova password: </p>
        <p><input class="input" type = "password" name = "newpasswordC" size = "100" value="<?php echo $pass1?>" /></p>
        
        <div><p>Nuovo Avatar: </p>
        <input class="input" type = "file" name = "avatar" id = "avatar" accept="image/*" />
        </div>
        <div id="anteprima"></div>
        <div>
        <button class="input" type = "submit" name ="cambia">Cambia</button>
        <button class="input" type = "reset" onclick="window.location.reload();" >Annulla</button>
        <button class="input" type = "submit" name="bacheca" >Torna alla bacheca</button>
        </div>
        
        
        
        </form>
    </div>
    
    


</body>


</html> 