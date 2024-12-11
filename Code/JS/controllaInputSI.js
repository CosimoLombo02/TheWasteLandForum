function preventSI(e){
    // Prendi i valori degli elementi
    const selectValue = document.getElementById('select2').value;
    const textValue = document.getElementById('text2').value;

    // Condizione: la select deve essere su altroS e il campo di testo non deve essere vuoto
    if (selectValue === "altroS" && textValue.trim() === "") {
        e.preventDefault(); // Impedisci il submit
        alert("Inserire dati!");
    }
 }