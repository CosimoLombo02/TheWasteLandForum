<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Area Riservata</title>
    <link rel ="stylesheet" href="CSS/login.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    
    </head>
<body>
    <div class="containerLogin">
        <form action="reservedArea.php" method="post">
            
            <p >Username:</p>
            <p><input class="input" type="text" name="username" /></p>
            
            <p>Password</p>
            <p><input class="input" type="password" name="password" />
            
            <button  type ="submit">Accedi</button></p>
            
            
            
            <div><p>Non registrato?</p></div>
            <p><a class="customLink" href="registrazioneUtente.php">Clicca qui!</a></p>
            
        </form>
        
    </div>
    <div class="containerLogin"><p><a class="customLink" href="homepage.php">Homepage sito </a></p><p>|</p>
    <p><a class="customLink" href="Forum/forumHP.php">Homepage Forum </a></p>
    
    
    </div>
    
    
    

<?php

require_once "connection.php";
if(isset($_POST["username"]) && isset($_POST["password"])){
    $nome_utente = $_POST["username"];
    $password = $_POST["password"];
    $tab_nome="utenti";
    $nome_utente = stripslashes($nome_utente);
    $password = stripslashes($password);
    $nome_utente=mysqli_real_escape_string($conn, $nome_utente); //contiene il nome utente
    $password=mysqli_real_escape_string($conn, $password);//contiene la password
    $passmd5 = md5($password); //password crittografata in md5

    $sql = "select * from utenti where nomeUtente='$nome_utente' and password='$passmd5'";
    $result=mysqli_query($conn, $sql);
    $conta=mysqli_num_rows($result);

    if($conta==1){ //se entro qui la query ha avuto buon fine
        while ($row = mysqli_fetch_array($result)){
            $ruolo = $row['ruolo'];
            $ban = $row['ban'];
        }
        if($ruolo==1){ //admin
            echo "Accesso  riuscito utente admin <br />";
            session_start();
            $_SESSION['username'] = $nome_utente;
            $_SESSION['password'] = $passmd5;
            header("Location: Admin.php"); //l'admin viene automaticamente reindirizzato alla sua bacheca personale

        }else{ //qualsiasi altro utente presente nel sistema
            if($ban != 1){ //se non sono bannato posso effettuare l'accesso altrimenti no
            echo "Accesso  riuscito  <br />";//debug
            session_start();
            $_SESSION['username'] = $nome_utente;
            $_SESSION['password'] = $passmd5;
            header("Location: Forum/forumHP.php"); //tutti gli altri utenti invece vengono reindirizzati alla pagina principale del forum
            }else{
                echo "<div class='containerLogin'><p >Attenzione!Sul tuo account è presente un ban! </p></div>";
            }
        }//end else

    } else {
        echo "<div class='containerLogin'><p >Attenzione!Accesso non riuscito! Username o password errati! </p></div>";
        
}//end else
}//end if principale isset

?>


</body>
</html>
