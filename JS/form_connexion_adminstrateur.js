var login_form = document.getElementById("admin_login_form");
var login = document.getElementById("login");
var notif_zone = document.getElementById("notif_zone")
var password = document.getElementById("password");
var xml = new XMLHttpRequest();
xml.responseType = "document";
var data;
var res;

login_form.addEventListener("submit", function(event){
    
    event.preventDefault();
    data = new FormData(this);

    
    xml.onreadystatechange = function(){

        console.log(xml.response);
        res = xml.response.querySelector("#async_res_zone").innerHTML;

        if (res == "password_ok"){

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-success");
            notif_zone.innerHTML = "Connexion ...";
            window.location.replace("http://127.0.0.1/Projet OC5/administrateurs/dashbord");
            return true;

        } else {

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-danger");
            notif_zone.innerHTML = "Une erreur est survenu lors l'exécution de la requête";
            return false;

        }

        return false;

    }

    xml.open("POST", "http://127.0.0.1/Projet%20OC5/administrateurs/connexion");
    xml.send(data)

}); 

