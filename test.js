var statutB = 1;

var bandeau = document.querySelector("#bandeau");
var menu = document.querySelector("#menu");
var cote = document.querySelector("#cote");
var etatJ = document.querySelector("#etatJ");
var fenetre = document.querySelector("#fenetre");
var tdb = document.querySelector("#tdb");
var tda = document.querySelector("#tda");
var table = document.querySelector("#table");


bandeau.addEventListener("click", function (){
    if (statutB == 0){
	menu.style.visibility="visible";
	cote.style.width="20%";
	tdb.style.width="0%";
	menu.style.width="0%";
	fenetre.style.width="75%";
	tba.style.width="2%";
	
        statutB = 1;
    }
    
    else if (statutB == 1){
        menu.style.visibility="hidden";
	cote.style.width="5%";
	tdb.style.width="17%";
	menu.style.width="17%";
	fenetre.style.width="90%";
	tba.style.width="2%";
	
        statutB = 0;
    }
});
