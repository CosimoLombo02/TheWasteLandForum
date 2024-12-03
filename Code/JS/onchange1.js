function onchangeSpoilerCustom1(){
    var selectBox = document.getElementsByName("categorieSpoiler")[0];
    var x = selectBox.value;
    //alert(x); //debug
    if(x == 'altroS'){
        document.getElementById('catSpoilerCustom').style.visibility = "visible";

    }else{
        
        document.getElementById('catSpoilerCustom').style.visibility = "hidden";
    }

}

function onchangeCategoria(){
    var selectBox = document.getElementsByName("categoriaSottoCategoria")[0];
    var x = selectBox.value;
    //alert(x); //debug
    if(x == 'altroC'){
        document.getElementById('catCustom').style.visibility = "visible";

    }else{
        
        document.getElementById('catCustom').style.visibility = "hidden";
    }

}
