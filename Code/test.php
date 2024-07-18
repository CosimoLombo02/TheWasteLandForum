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