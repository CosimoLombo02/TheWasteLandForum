<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title> Registrazione Utente</title> 
    <!--<link rel="stylesheet" href="foglioDiStile.css " type="text/css" /></head>-->
    <link rel ="stylesheet" href="CSS/stileRegUtente.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
    
</head>

<body><div><h1>Inserisci i tuoi dati!</h1></div>
<?php

require "connection.php";

//pattern per la regex per la password
$pattern = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/'; //la password deve avere almeno un carattere,almeno 1 carattere speciale
                                                                //almeno una lettera maiuscola ed almeno un numero


 if(isset($_POST['password']))
 $passw =$_POST['password'];
 else $passw="";
 if(isset($_POST['passwordC']))
 $pass1 =$_POST['passwordC'];
 else $pass1="";
 if(isset($_POST['username']))
 $username =$_POST['username'];
 else $username="";
 if(isset($_POST['email']))
 $email =$_POST['email'];
 else $email="";


 //accessori uploader file
 if(isset($_FILES['avatar'])){
    $target_dir = "Avatar/"; //directory target per gli avatar
    $target_file = $target_dir . basename($_FILES['avatar']['name']);
    $nomeFileAvatar = basename($_FILES["avatar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //tipo del file
 }



 //controlliamo le azioni svolte dall'utente
 if(isset($_POST['r'])){
    if(empty($_POST['username'])){
        echo "<div><p>Attenzione! Inserire username!</p></div>";

    }else{
        //$username=$_POST['username'];
        //controllo che lo username non sia presente nel db
        $userTemp = $_POST['username'];
        $sql = "select u.nomeUtente from utenti u where u.nomeUtente='$userTemp'";
        $result = mysqli_query($conn, $sql); //query
        if(mysqli_num_rows($result)==1){
            echo "<div><p>Nome utente già presente nel sistema</p></div>";
            $username="";
        }else{
            $username = $userTemp; //setto l'username
            if(!empty($_POST['email'])){
                $emailTemp = $_POST['email'];
                if(filter_var($emailTemp, FILTER_VALIDATE_EMAIL)){ //usiamo questa funzione per vedere se la mail è well-formed
                    $sql = "select u.email from utenti u where u.email = '$emailTemp'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) == 1){
                       echo "<div><p>Attenzione!Email già presente nel sistema</p></div>";
                       $email = "";
                    }else{
                        $email = $emailTemp; //setto la mail
                        if(!empty($_POST['password'])){
                            $pT = $_POST['password'];
                            if(preg_match($pattern,$pT)){ //controllo che la password rispetti il pattern
                                if(!empty($_POST['passwordC'])){
                                    $pass1 = $_POST['passwordC']; 
                                    if($pass1 == $pT){
                                        $passw = $pT; //setto la password

                                        //se sono qui posso allora procedere con l'avatar
                                        //entra in gioco l'image uploader
                                        if(!empty($_FILES['avatar']['tmp_name'])){ //controllo che l'utente abbia inserito il file
                                            
                                            // verifica che il file sia effettivamente un immagine o un fake
                                            $check = getimagesize($_FILES["avatar"]["tmp_name"]);
                                            if($check){
                                                //se sono qui, il file è probabilmente un'immagine, per sicurezza controllo la sua estensione
                                                // Vengono ammessi solo jpeg, png 
                                                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                                                        echo "<div><p>Attenzione! Sono ammessi solo JPG o PNG o JPEG!</p></div>";
                                                        //$uploadOk = 0;
                                                }else{
                                                    //se sono qui l'estensione va bene
                                                    //ora posso inserire l'utente e caricare il file nel sistema
                                                    //move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)
                                                    if(copy($_FILES["avatar"]["tmp_name"],$target_file)){
                                                        $md5passw=md5($passw); //la password viene criptata con md5

                                                        //ora posso procedere ad inserire l'utente nel database
                                                        $sql = "insert into utenti(nomeUtente,email,password,livelloReputazione,nomeFileAvatar,ruolo,ban) values('$username','$email','$md5passw',0,'$nomeFileAvatar',0,0)";
                                                        $result = mysqli_query($conn, $sql);
                                                        if($result){
                                                            //echo "<div><p>Creazione pagina personale ancora da implementare...</p></div>";
                                                            session_start();
                                                            $_SESSION['username'] = $username;
                                                            $_SESSION['password'] = $passw;
                                                    
                                                            require_once "creaPaginaUtente.php";
                                                            
                                                        }else{

                                                            die("Errore nell'inserimento dell'utente");

                                                        }//end else inserimento utente

                                                    }else{
                                                        echo "<div><p>Errore nell'upload del file!</p></div>";
                                                    }

                                                }//end else controllo estensione

                                            }else{
                                                echo "<div><p>Attenzione! Inserire un file immagine!</p></div>";
                                                  
                                            }//end else check
                                            
                                        }else{
                                            echo "<div><p>Attenzione! Inserire un immagine avatar!</p></div>";
                                        }// end else empty avatar
                                        
                                    }else{
                                        echo "<div><p>Le password non corrispondono!</p></div>";
                                        $pass1="";
                                        

                                    }//end else == password

                                }else{
                                    echo "<div><p>Attenzione!Inserire la conferma della password</p></div>";

                                }//end else conferma

                            }else{
                                echo "<div><p>Attenzione!La password deve avere almeno 8 caratteri, di cui almeno 1 maiuscolo, 1 speciale((! @ # $ % ^ & * -)) ed almeno un numero</p></div>";
                                $passw="";
                                $pass1="";
                            }//end pregmatch password

                        }else{
                            echo "<div><p>Attenzione!Inserire la password</p></div>";

                        }//end empty isset password
                    }//end else email presente sistema

                }else{
                    echo "<div><p>Attenzione!Inserire una mail valida !</p></div>";
                    $_POST['email']="";

                }//end else validazione mail

            }else{
                echo "<div><p>Attenzione! Inserire email!</p></div>";

            }// end else empty email

        }//end else query username


    }//end else isset username

 }//end if isset r


?>

    <div >
       <form action="registrazioneUtente.php" method = "post" enctype="multipart/form-data">
        
        <p>Nome Utente:  </p>  
        <p><input class="input" type="text" name = "username" size="100" value="<?php echo $username?>" /> </p>
        <p>Email: </p> 
        <p><input class="input" type="text" name = "email" size="100" value="<?php echo $email?>" /> </p>
        <p>Password: </p>
        <p><input  class="input" type = "password" name = "password" size = "100" value="<?php echo $passw?>" /></p>
        <p>Conferma password: </p>
        <p><input class="input" type = "password" name = "passwordC" size = "100" value="<?php echo $pass1?>" /></p>
        
        <div><p>Avatar: </p>
        <input class="input" type = "file" name = "avatar" id = "avatar" />
        </div>
        <div>
        <button class="input" type = "submit" name ="r">Registrati</button>
        <button class="input" type = "reset" >Annulla</button>
        </div>
        
        
        </form>
    </div>


</body>


</html> 