var login_form = document.getElementById("admin_login_form");
var login = document.getElementById("login");
var notif_zone = document.getElementById("notif_zone")
var password = document.getElementById("password");
var xml = new XMLHttpRequest();

login_form.addEventListener("submit", function(event){

    event.preventDefault();
    var data = new FormData(this);
    
    xml.onreadystatechange = function(){

        var res = JSON.parse(this.responseText);

        if (res.status == "password_ok"){

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-success");
            notif_zone.innerHTML = "Connexion ...";
            window.location.replace("http://127.0.0.1/Projet OC5/administrateur/dashbord");
            return true;

        } else {

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-danger");
            notif_zone.innerHTML = "Une erreur est survenu lors l'exécution de la requête";
            return false;

        }

    }

    xml.open("POST", "http://127.0.0.1/Projet%20OC5/administrateur/connexion", true);
    xml.send(data)

});

