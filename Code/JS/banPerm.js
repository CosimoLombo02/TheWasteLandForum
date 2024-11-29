
function onchangeBanPermanente(){
    var selectBox = document.getElementsByName("banP")[0];
    var x = selectBox.value;
    //alert(selectBox); //debug
    if(x == 'si'){
        document.getElementById('dataBan').style.visibility = "visible";

    }else{
        if(x=='no'){
            document.getElementById('dataBan').style.visibility = "hidden";
        }

    }
}