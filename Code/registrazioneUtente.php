<?xml version="1.0" encoding="UTF-8"?>
<?php

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





        if(isset($_POST['r'])){
            if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['passwordC']) && !empty($_POST['email'])){
                $passw = $_POST['password'];
                $pass1 = $_POST['passwordC'];
                $email=$_POST['email'];
                $pattern = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/'; //la password deve avere almeno un carattere,almeno 1 carattere speciale
                                                                //almeno una lettera maiuscola ed almeno un numero
                
                $pattern_mail ='/^[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}$/'; //questa regex serve per controllare che la mail
                                                                                //sia effettivamente una mail
         //ricordarsi di if wrapper per controllare presenza mail nel db
         //pregmatch mail se ok, entro e verifico le altre cose
         if(preg_match($pattern_mail,$email)){
                if(!preg_match($pattern, $passw)){
                    echo "<div ><p>Attenzione!La password deve avere almeno un carattere speciale(! @ # $ % ^ & * -),almeno 1 carattere maiuscolo,almeno un numero ed almeno 8 caratteri!</p></div>";
                    $passw ="";
                    $pass1 = "";
                    $username=$_POST['username'];
                }else{
                    if($passw != $pass1){
                        echo "<div><p>Attenzione!Le Password non corrispondono!</p></div>";
                        $passw ="";
                        $pass1 = "";
                    }else{
                        //se sono qui posso inserire nel database l'utente
                        $username=$_POST['username'];
                        $passw=md5($_POST['password']); 
                        $email = $_POST['email'];

                        require_once "connection.php";
                        
                        /*Abbiamo inserito questo costrutto try catch per poter gestire al meglio l'eventualità che quel 
                        nome utente sia già presente nel db, se $result === false allora verra' lanciata e gestita un'eccezzione
                        di tipo mysqli_sql_exception */
                        try{$sql="insert into utenti(username,password,ruolo) values('$username','$passw',2)";
                            $result = mysqli_query($conn,$sql);
                            if($result){
                                session_start();
                                    $_SESSION['username']=$username;
                                    $_SESSION['password']=$pass;
                                       header("Location:homepage.php");
    
                            }else{throw new mysqli_sql_exception;} //istruzione "paranoica" per chi non ha la gestione delle eccezioni attiva
                                

                        }catch(mysqli_sql_exception $e){

                            echo "<div class='center'><p class='para'>Attenzione!Cambiare username</p></div>";
                            $passw=$_POST['password'];
                            $pass1=$_POST['passwordC'];
                            $username="";

                        }//end catch

                    }//end else password
                }//end pregmatch pass 
            }else{
                //regex falita
                echo "<div ><p>Attenzione!Inserire una mail valida</p></div>";
            } 
        }else{
            if(empty($_POST['password']) && empty($_POST['username']) && empty($_POST['passwordC'])){
                echo "<div ><p>Inserire i dati!</p></div>";
                $passw="";
                $username="";
                $username = "";
            } 
            if(empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['passwordC'])){
                echo "<div><p >Inserire Username!</p></div>";
                $passw=$_POST['password'];
                $pass1=$_POST['passwordC'];
                
            } 
            if(empty($_POST['password'])){
                echo "<div><p>Inserire Password!</p></div>";
                $pass1="";
                $username=$_POST['username'];
            } 
            if(!empty($_POST['password']) && empty($_POST['passwordC'])){
                echo "<div><p>Inserire conferma Password!</p></div>";
                $passw=$_POST['password'];
                $username=$_POST['username'];
            } 

            
        }//end else pregmatch pass
    
    
    }//end if isset r
        
    
?>






<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Registrazione Utente</title> 
    <!--<link rel="stylesheet" href="foglioDiStile.css " type="text/css" /></head>-->
    <link rel ="stylesheet" href="CSS/stileRegUtente.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <link href='https://fonts.googleapis.com/css?family=Share Tech Mono' rel='stylesheet'/> <!--font di usato nei terminali presenti in Fallout-->
    <style type="text/css">
        body {
            font-family: 'Share Tech Mono';font-size: 22px;
            background-color: black;
            color:green;
        }
    </style>
</head>
<body>
    <div><h1>Inserisci i tuoi dati!</h1></div>
    <div>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
        <label>Nome Utente: </label> <br />  
        <input class="input" type="text" name = "username" size="100" value="<?php echo $username?>" /> <br /><br />
        <label>Email: </label> <br />  
        <input class="input" type="text" name = "email" size="100" value="<?php echo $email?>" /> <br /><br />
        <label>Password: </label><br />
        <input  class="input" type = "password" name = "password" size = "100" value="<?php echo $passw?>"><br /><br />
        <label>Conferma password: </label><br />
        <input class="input" type = "password" name = "passwordC" size = "100" value="<?php echo $pass1?>">
        <div><label>Avatar: </label>
        <input class="input" type = "file" name = "avatar" id = "avatar" value = "immagine avatar"/>
        </div>
        <div>
        <button class="input" type = "submit" size = "100"  name ="r">Registrati</button>
        <button class="input" type = "reset" >Annulla</button>
        </div>
        
        
        </form>
    </div>

    

    


</body>


</html> 