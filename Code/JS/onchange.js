//queste funzioni sono state create poichè abbiamo scoperto che l'evento onclick non è supportato
//nei tag option, con firefox funzionavan con chrome no,
//creando queste funzioni si dovrebbe risolvere questo problema


function onchangeSpoiler(){
    var selectBox = document.getElementsByName("sp")[0];
    var x = selectBox.value;
    //alert(selectBox); //debug
    if(x == 'si'){
        visibile('spoiler');

    }else{
        if(x=='no'){
            sparisciSpeciale('spoiler','catSpoilerCustom');
        }

    }
}

function onchangeSpoilerCustom(){
    var selectBox = document.getElementsByName("categorieSpoiler")[0];
    var x = selectBox.value;
    //alert(x); //debug
    if(x == 'altroS'){
        visibile('catSpoilerCustom');

    }else{
        
            sparisci('catSpoilerCustom');
    }

}

function onchangeCustomSottocategoria(){
    var selectBox = document.getElementsByName("sottocategorie")[0];

    var x = selectBox.value;
   // alert(selectBox); //debug
    if(x == 'altro'){
        visibile('sottoCategoriaCustom');

    }else{
        
        sparisci('sottoCategoriaCustom');
        

    }

}