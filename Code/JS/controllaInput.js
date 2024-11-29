function checkConditions(event) {
    // Prendi i valori degli elementi
    const selectValue = document.getElementById('select1').value;
    const textValue = document.getElementById('text1').value;

    // Condizione: la select deve essere su altroS e il campo di testo non deve essere vuoto
    if (selectValue === "altroS" && textValue.trim() === "") {
        event.preventDefault(); // Impedisci il submit
        alert("Inserire dati!");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const button = document.getElementById("myButton1");
    button.addEventListener("click", checkConditions);
});