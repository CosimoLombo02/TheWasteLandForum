function anteprimaFile(evt){
    var file = evt.target.files;
    var f = file[0];
    var reader = new FileReader();

    reader.onload = (function(theFile){
        return function(e){
            document.getElementById('anteprima').innerHTML = '<img style = "width: 150px; height: 150px;" title="'+escape(theFile.name)+'" src="'+e.target.result+'" alt="anteprima" />';
        };
    })(f);

    reader.readAsDataURL(f);
}

document.addEventListener("DOMContentLoaded", function(){
    document.getElementById('avatar').value='';
    document.getElementById('anteprima').value = '';
    document.getElementById('avatar').addEventListener('change', anteprimaFile, false);
});