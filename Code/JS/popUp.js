
function openPopup() {
    document.getElementById("overlay").style.display = "block"; // Mostra l'overlay
    document.getElementById("popup").style.display = "block";   // Mostra il popup
    document.getElementById("popup").style.visibility = "visible";    // Mostra il popup
}


function closePopup() {
    document.getElementById("overlay").style.display = "none";  // Nascondi l'overlay
    document.getElementById("popup").style.display = "none";    // Nascondi il popup
    document.getElementById("popup").style.visibility = "hidden";    // Nascondi il popup

}


document.getElementById("closePopup").addEventListener("click", closePopup);


document.getElementById("overlay").addEventListener("click", closePopup);




