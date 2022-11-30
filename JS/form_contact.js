var send_message_form = document.getElementById('send_message_form');
/*var firstname = document.getElementById('firstname');
var name = document.getElementById('name');
var email = document.getElementById('email');
var objet = document.getElementById('objet');
var message = document.getElementById('message');*/

var xml = new XMLHttpRequest();
var data;

send_message_form.addEventListener('submit', function(event){

    event.preventDefault();
    data = new FormData(this);

    xml.responseType = "document";
    xml.onreadystatechange = function () {

        var res = xml.response.querySelector("#async_res_zone");

        if (res.innerHTML == 1 || res.innerHTML == true|| res.innerHTML == "true") {

            alert("Le message a été envoyé");

        } else {

            alert("Une erreur est survenue à l'envoie du message");

        }

    }

    xml.open("POST", "http://127.0.0.1/Projet%20OC5/messages/envoyer");
    xml.send(data);

});