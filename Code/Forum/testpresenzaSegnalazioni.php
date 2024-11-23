<?php
require "funzioniUtili.php";
/*if (presenzaSegnalazione('testFile',5,1,'linguaggioOff')) echo "ciao";
else echo "e";*/

echo '<div id="overlay"></div>';
echo '<div id="popup">';
echo '<span class="close-btn" id="closePopup" onclick="closePopup()">&times;</span>';
echo '<h3>Segnala post</h3>';
echo '<form id="popupForm" action="insSegnalazioni.php" method="POST">';
echo '<label for="motivo">Segnala per:</label>';
/* echo '<select name="valore">
                <option value="linguaggioOff" >Linguaggio Offensivo</option>
                <option value="offTopic" >Off-Topic</option>
                <option value="Razzismo" >Razzismo</option>
                <option value="Politica" >Politica</option>
                <option value="suggDannosi" >Suggerimenti Dannosi</option>
                <option value="Bullismo" >Bullismo</option></select>';*/
  echo '<select name ="motivo">';
  if(presenzaSegnalazione($_SESSION['username'],$_SESSION['codPost'],$_SESSION['discussione'],'linguaggioOff')===false){
    echo '<option value="linguaggioOff" >Linguaggio Offensivo</option>';
  }
  if(presenzaSegnalazione($_SESSION['username'],$_SESSION['codPost'],$_SESSION['discussione'],'offTopic')==false){
    echo '<option value="offTopic" >Off-Topic</option>';
  }

  if(presenzaSegnalazione($_SESSION['username'],$_SESSION['codPost'],$_SESSION['discussione'],'Razzismo')==false){
    echo '<option value="Razzismo" >Razzismo</option>';
  }

  if(presenzaSegnalazione($_SESSION['username'],$_SESSION['codPost'],$_SESSION['discussione'],'Politica')==false){
    echo '<option value="Politica" >Politica</option>';
  }

  if(presenzaSegnalazione($_SESSION['username'],$_SESSION['codPost'],$_SESSION['discussione'],'suggDannosi')==false){
    echo '<option value="suggDannosi" >Suggerimenti Dannosi</option>';
  }

  if(presenzaSegnalazione($_SESSION['username'],$_SESSION['codPost'],$_SESSION['discussione'],'Bullismo')==false){
    echo '<option value="Bullismo" >Bullismo</option>';
  }
  echo '</select>';
