<?php
$nomeFile = 'PaginePersonaliUtenti/'.$_SESSION['username'].'.php';
$handler = fopen($nomeFile, 'w'); //se non esiste viene creato il file homepage degli utenti
                                   //il file viene aperto il lettura scrittura

if (false === $handler) {
    printf('Impossibile creare  il file %s', $nomeFile);
    exit;
}

fclose($handler);

//header si viene reindirizzati ecc...