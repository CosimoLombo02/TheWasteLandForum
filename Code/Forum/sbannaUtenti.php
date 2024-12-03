<?php 
//questo piccolo script si occuperà di sbannare automaticamente tutti gli utenti che hanno ricevuto un ban temporaneo
//ricordiamo che gli utenti con ban permanente hanno la data di fine ban settata al primo gennaio del 1970
//anche se probabilmente non si fa cosi viene fatto partire alla prima attivazione del sito, ovvero appena si 
//va nella pagina principale parte lo script
require "connection.php";

$dataOdierna = date('Y-m-d');

//la query si occupa di trovare gli utenti bannati fino alla data odierna e di togliere il ban 
$sql = "update  utenti set ban = 0 ,dataFineBan=null where dataFineBan='$dataOdierna'";
$result = mysqli_query($conn,$sql);

//debug 
/*
if($result) echo "sbannati";
else echo "errore"; echo $dataOdierna;*/