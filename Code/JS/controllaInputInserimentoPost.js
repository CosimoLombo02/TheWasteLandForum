function preventINS(e){
    // Prendi i valori degli elementi
    
    const textValue = document.getElementById('testo').value;

    // Condizione: la select deve essere su altroS e il campo di testo non deve essere vuoto
    if ( textValue.trim() === "") {
        e.preventDefault(); // Impedisci il submit
        alert("Inserire testo post!");
    }
}