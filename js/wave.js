var btnpri = document.getElementById("water_color_nochange");
var btnsec = document.getElementById("water_color_nochange");

var waveWidth = 5;

function createbtn(btntype){

    for(var j = 0; j < btntype.length; j++){
        var wavebox = document.createDocumentFragment();

        var width = window.getComputedStyle(btntype[j]).width;
        
        var waveCount = (parseInt(width)+40)/parseInt(waveWidth)+1;

        for (var i = 0; i < waveCount; i++) {
            var wave = document.createElement("div");
            wave.className += " wave";
            wavebox.appendChild(wave);
            wave.style.left = i * waveWidth + "px";
            wave.style.animationDelay = (i / 80) + "s";
        }
        btntype[j].appendChild(wavebox);
    }
}

createbtn(btnpri);
createbtn(btnsec);