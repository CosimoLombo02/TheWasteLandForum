//Questo piccolo script serve per controllare che l'utente inserisca più di due file, inoltre
//vengono controllate anche le estensioni che vengono inserite, ricordiamo che sono ammesse
//solo immagini e video
//viene mostrata anche una preview dei file inseriti dall'utente
/*
document.addEventListener('DOMContentLoaded', (event) => {
    const fileInput = document.getElementById('fileInput');
    const form = document.getElementById('form');
    const maxFiles = 2;
    const extensions = ['jpg', 'jpeg', 'png', 'mp4', 'mov', 'avi', 'mkv','gif','flv']; //queste sono le estensioni accettate per i post 

    fileInput.addEventListener('change', () => {
        const numFiles = fileInput.files.length;
        //controlliamo sia il numero dei file che l'estensione
        let fileInvalidi = false;
        
        for (let i = 0; i < numFiles; i++) {
            const file = fileInput.files[i];
            const fileExtension = file.name.split('.').pop().toLowerCase();

            if (!extensions.includes(fileExtension)) {
                fileInvalidi=true;
                alert("Attenzione! Sono ammessi solo: jpg,png,jpeg,mp4,mov,avi,gif e mkv");
                fileInput.value='';
                break;
            
            }//end if
        }//end for


        if (numFiles > maxFiles) {
            alert(`Puoi selezionare un massimo di ${maxFiles} file.`);
            fileInput.value = ''; // Resetta il campo di input
            
        } 
    });

   /* const reader = new FileReader();
    reader.onload = (function(file) {
        return function(e) {
            let element;
            if (file.type.startsWith('image/')) {
                element = document.createElement('img');
                element.src = e.target.result;
                element.style.maxWidth = '200px';
                element.style.maxHeight = '200px';
            } else if (file.type.startsWith('video/')) {
                element = document.createElement('video');
                element.src = e.target.result;
                element.controls = true;
                element.style.maxWidth = '200px';
                element.style.maxHeight = '200px';
            }
            preview.appendChild(element);
        };
    })(file);
    reader.readAsDataURL(file);
}*/

    

   /* form.addEventListener('submit', (event) => {
        const numFiles = fileInput.files.length;
         if (numFiles > maxFiles) {
            alert(`Puoi selezionare un massimo di ${maxFiles} file.`);
            event.preventDefault(); // Previene l'invio del form
        }
    });
/*});*/

/*
document.addEventListener('DOMContentLoaded', (event) => {
    const fileInput = document.getElementById('fileInput');
    const form = document.getElementById('form');
    const preview = document.getElementById('anteprima');
    const maxFiles = 2;
    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'mkv'];

    fileInput.addEventListener('change', () => {
        const numFiles = fileInput.files.length;
        let invalidFiles = false;
        preview.innerHTML = ''; // Reset della preview

        if (numFiles > maxFiles) {
            alert(`Puoi selezionare un massimo di ${maxFiles} file.`);
            fileInput.value = ''; // Resetta il campo di input
            return;
        }

        for (let i = 0; i < numFiles; i++) {
            const file = fileInput.files[i];
            const fileExtension = file.name.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                invalidFiles = true;
                break;
            }

            const reader = new FileReader();
            reader.onload = (function(file) {
                return function(e) {
                    let element;
                    if (file.type.startsWith('image/')) {
                        element = document.createElement('img');
                        element.src = e.target.result;
                        element.style.maxWidth = '200px';
                        element.style.maxHeight = '200px';
                    } else if (file.type.startsWith('video/')) {
                        element = document.createElement('video');
                        element.src = e.target.result;
                        element.controls = true;
                        element.style.maxWidth = '200px';
                        element.style.maxHeight = '200px';
                    }
                    preview.appendChild(element);
                };
            })(file);
            reader.readAsDataURL(file);
        }

        if (invalidFiles) {
            alert('Puoi caricare solo immagini o video (estensioni accettate: ' + allowedExtensions.join(', ') + ').');
            fileInput.value = ''; // Resetta il campo di input
            preview.innerHTML = ''; // Reset della preview
        } else {
            alert(`Hai selezionato ${numFiles} file.`);
        }
    });

    form.addEventListener('submit', (event) => {
        const numFiles = fileInput.files.length;
        if (numFiles === 0) {
            alert('Devi selezionare almeno un file per continuare.');
            event.preventDefault(); // Previene l'invio del form
        } else if (numFiles > maxFiles) {
            alert(`Puoi selezionare un massimo di ${maxFiles} file.`);
            event.preventDefault(); // Previene l'invio del form
        }
    });
});*/

/*function anteprimaFile(evt){
    
    var file = evt.target.files;
    var f = file[0];
    var reader = new FileReader();

    reader.onload = (function(theFile){
        return function(e){
            document.getElementById('anteprima').innerHTML = '<img style = "width: 30%; height: 30%;" title="'+escape(theFile.name)+'" src="'+e.target.result+'" alt="anteprima" />';
        };
    })(f);

    reader.readAsDataURL(f);

}

document.addEventListener("DOMContentLoaded", function(){
    document.getElementById('fileInput').value='';
    document.getElementById('anteprima').value = '';
    document.getElementById('fileInput').addEventListener('change', anteprimaFile, false);
});*/
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const anteprima = document.getElementById('anteprima');
    const maxFiles = 2;
    const estensioniConsentite = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'mkv']; //estensioni consentite

    //prepriamo l'eventuale anteprima
    fileInput.value = '';
    anteprima.innerHTML = '';

    fileInput.addEventListener('change', function(evt) {
        const files = evt.target.files;
        let invalido = false;

        anteprima.innerHTML = ''; // Reset dell'anteprima

        //controllo numero massimo file
        if (files.length > maxFiles) {
            alert(`Puoi selezionare un massimo di ${maxFiles} file.`);
            fileInput.value = ''; // Resetta il campo di input
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const estensioneFile = file.name.split('.').pop().toLowerCase();

            if (!estensioniConsentite.includes(estensioneFile)) {
                invalido = true;
                break;
            }

            const reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    let element;
                    if (theFile.type.startsWith('image/')) {
                        element = document.createElement('img');
                        element.src = e.target.result;
                        element.style.maxWidth = '300px';
                        element.style.maxHeight = '300px';
                       // element.style.margin = '2px';
                        element.title = escape(theFile.name);
                    } else if (theFile.type.startsWith('video/')) {
                        element = document.createElement('video');
                        element.src = e.target.result;
                        element.controls = true;
                        element.style.maxWidth = '300px';
                        element.style.maxHeight = '300px';
                       // element.style.margin = '2px';
                        element.title = escape(theFile.name);
                    }
                    anteprima.appendChild(element);
                };
            })(file);
            reader.readAsDataURL(file);
        }

        if (invalido) {
            alert('Attenzione! Estensione non valida:  (estensioni accettate: ' + estensioniConsentite.join(', ') + ').');
            fileInput.value = ''; // Resetta il campo di input
            anteprima.innerHTML = ''; // Reset della preview
        } else {
            alert(`Hai selezionato ${files.length} file.`);
        }
    });

    document.getElementById('form').addEventListener('submit', function(event) {
        const numFiles = fileInput.files.length;
        if (numFiles > maxFiles) {
            alert(`Puoi selezionare un massimo di ${maxFiles} file.`);
            event.preventDefault(); // Previene l'invio del form
        }
    });
});