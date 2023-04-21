var send_message_form = document.getElementById('send_message_form');
var alert_zone = document.querySelector(".alert");
var firstname = document.getElementById("firstname");
var nom = document.getElementById("name");
var message = document.getElementById("message");
var objet = document.getElementById("objet");
var email = document.getElementById("email");
var xml = new XMLHttpRequest();
var data;

send_message_form.addEventListener('submit', function(event){

    event.preventDefault();
    data = new FormData(this);

    if (nom.value.length > 64) {

        alert_zone.className = "";
        alert_zone.classList.add("alert");
        alert_zone.classList.add("alert-warning");
        alert_zone.innerHTML = "Erreur : un nom ne doit pas contenir plus de 64 caractères";
        return false;

    } else if (firstname.value.length > 64 ) {

        alert_zone.className = "";
        alert_zone.classList.add("alert");
        alert_zone.classList.add("alert-warning");
        alert_zone.innerHTML = "Erreur : un prénom ne doit pas contenir plus de 64 caractères";
        return false;

    } else if (email.value.length > 64 ) {

        alert_zone.className = "";
        alert_zone.classList.add("alert");
        alert_zone.classList.add("alert-warning");
        alert_zone.innerHTML = "Erreur : une addresse mail ne doit pas contenir plus de 64 caractères";
        return false;

    } else if (objet.value.length > 64 ) {

        alert_zone.className = "";
        alert_zone.classList.add("alert");
        alert_zone.classList.add("alert-warning");
        alert_zone.innerHTML = "Erreur : un objet ne doit pas contenir plus de 64 caractères";
        return false;

    }  else if (message.value.length > 1500 ) {

        alert_zone.className = "";
        alert_zone.classList.add("alert");
        alert_zone.classList.add("alert-warning");
        alert_zone.innerHTML = "Erreur : un message ne doit pas contenir plus de 1500 caractères";
        return false;
    }

    xml.onreadystatechange = function () {

        var res = JSON.parse(xml.response);
        
        if (res.status == true) {

            
            alert_zone.className = "";
            alert_zone.classList.add("alert");
            alert_zone.classList.add("alert-success");
            alert_zone.innerHTML = "Le message a été envoyé avec succsés !";
            return true;

        } else if (res.status == "erreur") {

            alert_zone.className = "";
            alert_zone.classList.add("alert");
            alert_zone.classList.add("alert-danger");
            alert_zone.innerHTML = "Erreur : Une ou des informations ont été perdu ou non renseigné dans la requête";
            return false;
        
        } else {

            
            alert_zone.className = "";
            alert_zone.classList.add("alert");
            alert_zone.classList.add("alert-danger");
            alert_zone.innerHTML = "Erreur : Une erreur est survenue à l'envoie du message";
            return false;

        }

    }

    xml.open("POST", "http://127.0.0.1/Projet%20OC5/message/envoyer");
    xml.send(data);

});