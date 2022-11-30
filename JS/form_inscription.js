var sing_form = document.querySelector("#sing_form");
var notif_zone = document.querySelector("#alert");

var name = document.querySelector("#name");
var firstname = document.querySelector("#firstname");
var email = document.querySelector("#email");
var password = document.querySelector("#password");
var confirm_password = document.querySelector("#confirm_password");
var birth_day = document.querySelector("#birth_day");

var xml = new XMLHttpRequest();
var data;
var res;


sing_form.addEventListener("submit", function(event){

    event.preventDefault();
    data = new FormData(this)

    xml.responseType = "document";
    
    res = xml.res.querySelector("#async_res_zone");

    if (res == 1 || res == true || res == "true"){

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-success");
        notif_zone.innerHTML = "Votre inscription a bien été confirmé";
        
    } else {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-danger");
        notif_zone.innerHTML = "Une erreur est survenu lors l'exécution de la reqête";

    }


    xml.open("POST", "http://127.0.0.1/Projet%20OC5/utilisateurs/inscription");
    xml.send(data)

});