<?php


/*Prima di far partire questo script ricordarsi di cambiare username e password
nel file AccountSettings.php*/

require_once "AccountSettings.php"; 


$password = $pass;

$connessione = new mysqli($host,$username_1,$password);

if($connessione === false){
    die("Errore di connesione:".$connessione->connect_error);

}

/*Se già presente nel server il db utentiforum viene eliminato e 
poi successivamente viene ricreato */

$sql = "drop database utentiforum";
if($connessione->query($sql)===true){
  echo "Database preesistente eliminato!\n";
}


$sql = "create database utentiforum";

if($connessione->query($sql)===true){
      echo "Creazione db avvenuta con successo!\n";
}else{
    echo "Errore nella creazione del db!\n";
}


$sql = "use utentiforum";
if($connessione->query($sql)===true){
    echo "Database selezionato correttamente\n";
}else{
  echo "Errore nella selezione  del db!\n";
}

//creazione tabella utenti
$sql = "create table utenti( id int not null auto_increment, nomeUtente varchar(100) not null unique,password varchar(100) not null, email varchar(100) not null unique, ruolo int not null, livelloReputazione int default 0, nomeFileAvatar varchar(255) not null, ban int not null default 0, dataFineBan date, primary key(id))";
if($connessione->query($sql)===true){
    echo "Tabella utenti creata correttamente\n";
}else{
  echo "Errore nella creazione della tabella utenti!\n";
}


/*Ora creo ed inserisco l'utente admin
avra come password: admin e come username:admin, è l'unico di ruolo 1 che puo' accedere alla sezione privata Admin.php*/

$u = "admin" ;
$p = md5("Fallout123!"); 
$email = "admin@gmail.com";
$nomeAvatar = "FO01_Overseer_Cinematic.jpeg";

$sql = "insert into utenti(nomeUtente,password,email,ruolo,livelloReputazione,nomeFileAvatar,ban,dataFineBan) values('$u','$p','$email',1,null,'$nomeAvatar',0,null)";
if($connessione->query($sql)===true){
    echo "Admin inserito correttamente!\n";
}else{
  echo "Errore nell'inserimento dell'admin!\n";
}



//utente recensore(ovviamente è possibile crearne altri registrandosi al sito)
$u = "account1" ;
$p = md5("Fallout123!"); 
$email = "account1@gmail.com";
$nomeAvatar = "Into_the_desert.jpeg";

$sql = "insert into utenti(nomeUtente,password,email,ruolo,livelloReputazione,nomeFileAvatar,ban,dataFineBan) values('$u','$p','$email',0,0,'$nomeAvatar',0,null)";
if($connessione->query($sql)===true){
    echo "Utente inserito correttamente!\n";
}else{
  echo "Errore nell'inserimento dell'utente!\n";
}

$u = "account4" ;
$p = md5("Fallout123!"); 
$email = "account4@gmail.com";
$nomeAvatar = "Into_the_desert.jpeg";

$sql = "insert into utenti(nomeUtente,password,email,ruolo,livelloReputazione,nomeFileAvatar,ban,dataFineBan) values('$u','$p','$email',0,0,'$nomeAvatar',0,null)";
if($connessione->query($sql)===true){
    echo "Utente inserito correttamente!\n";
}else{
  echo "Errore nell'inserimento dell'utente!\n";
}

$u = "account2" ;
$p = md5("Fallout123!"); 
$email = "account2@gmail.com";
$nomeAvatar = "Perk_wild_wasteland.jpeg";

$sql = "insert into utenti(nomeUtente,password,email,ruolo,livelloReputazione,nomeFileAvatar,ban,dataFineBan) values('$u','$p','$email',0,0,'$nomeAvatar',0,null)";
if($connessione->query($sql)===true){
    echo "Utente inserito correttamente!\n";
}else{
  echo "Errore nell'inserimento dell'utente!\n";
}

$u = "account3" ;
$p = md5("Fallout123!"); 
$email = "account3@gmail.com";
$nomeAvatar = "Feral_ghoul.jpeg";

$sql = "insert into utenti(nomeUtente,password,email,ruolo,livelloReputazione,nomeFileAvatar,ban,dataFineBan) values('$u','$p','$email',0,0,'$nomeAvatar',0,null)";
if($connessione->query($sql)===true){
    echo "Utente inserito correttamente!\n";
}else{
  echo "Errore nell'inserimento dell'utente!\n";
}
