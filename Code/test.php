<?php

$host="localhost";
$username_1="root";
$pass="admin";
$db="utentiforum";


$conn=mysqli_connect($host, $username_1, $pass);
mysqli_select_db($conn, $db) or die('Accesso al database non riuscito: ' . mysqli_error());

$nome_utente="admin";
$password ="Fallout123!";
$nome_utente = stripslashes($nome_utente);
    $password = stripslashes($password);
    $nome_utente=mysqli_real_escape_string($conn, $nome_utente); //contiene il nome utente
    $password=mysqli_real_escape_string($conn, $password);//contiene la password
    $passmd5 = md5($password); //password crittografata in md5

    //$sql = "SELECT * FROM 'utenti' WHERE username='$nome_utente' AND password='$passmd5'";
    $sql = "select * from utenti where username='$nome_utente' and password='$passmd5'";
    
    $result=mysqli_query($conn, $sql);
    $conta=mysqli_num_rows($result);

    if($conta==1){ //se entro qui la query ha avuto buon fine
        while ($row = mysqli_fetch_array($result)){
            $ruolo = $row['ruolo'];
            echo $row['ruolo'];
        }}




        ------------------------------------------------------


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
        