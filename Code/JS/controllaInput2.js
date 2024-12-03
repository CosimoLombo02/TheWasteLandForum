function checkConditions(event) {
    // Prendi i valori degli elementi
    const selectValue = document.getElementById('select3').value;
    const textValue = document.getElementById('text3').value;

    // Condizione: la select deve essere su altroS e il campo di testo non deve essere vuoto
    if (selectValue === "altroC" && textValue.trim() === "") {
        event.preventDefault(); // Impedisci il submit
        alert("Inserire dati!");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const button = document.getElementById("myButton3");
    button.addEventListener("click", checkConditions);
});