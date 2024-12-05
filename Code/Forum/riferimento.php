<?php 
//Questo script serve per il tasto torna indietro presente nella pagina nuovaDiscussione
//passiamo l'url della pagina con la sessione visto che con http_header stavamo avendo problemi
//la soluzione js con history.back() è stata scartata poichè non correttamente funzionante




// Ottieni il protocollo (http o https)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

// Ottieni l'host (dominio o localhost)
$host = $_SERVER['HTTP_HOST'];  // Ad esempio "localhost" o "127.0.0.1"

// Ottieni il percorso della pagina (uri)
$uri = $_SERVER['REQUEST_URI'];  // Percorso e parametri della query

// Componi l'URL completo
$currentUrl = $protocol . '://' . $host . $uri;
//session_start();
$_SESSION['rif'] = $currentUrl; // Lo passo ora tramite sessione

/*var_dump($_SESSION['rif']);
echo $_SESSION['rif'];*/


