function preventSott(e){
    // Prendi i valori degli elementi
    const selectValue = document.getElementById('select3').value;
    const textValue = document.getElementById('text3').value;

    // Condizione: la select deve essere su altroS e il campo di testo non deve essere vuoto
    if (selectValue === "altroC" && textValue.trim() === "") {
        e.preventDefault(); // Impedisci il submit
        alert("Inserire dati!");
    }
 }