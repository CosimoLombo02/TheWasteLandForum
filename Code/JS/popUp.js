// mostra il popup dopo 2000 millisecondi (2secondi)
setTimeout(
    function() {
    	console.log("run");
      document.getElementById('pop').style.display="block"	;
   	}, 2000);


// chiudi il popup quando clicchi sulla X
document.getElementById("close").onclick = function(e){
    document.getElementById('pop').style.display="none";
}