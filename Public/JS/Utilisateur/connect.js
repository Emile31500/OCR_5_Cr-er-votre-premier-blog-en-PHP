var login_form = document.getElementById("login_form");
var login = document.getElementById("login");
var notif_zone = document.getElementById("notif_zone")
var password = document.getElementById("password");
var xml = new XMLHttpRequest();
var data;


login_form.addEventListener("submit", function(event){
    
    event.preventDefault();
    data = new FormData(this);

    
    xml.onreadystatechange = function(){
        
        var res = JSON.parse(xml.response);
        
        if (res.status == "password_ok"){

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-success");
            notif_zone.innerHTML = "Connexion ...";
            window.location.replace("http://127.0.0.1/Projet OC5/accueil/index");
            return true;

        } else if (res.status == "password_notok"){

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-danger");
            notif_zone.innerHTML = "Votre mot de passe est incorrect";
            return false;

        } else if (res.status == "user_not_exist"){

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-danger");
            notif_zone.innerHTML = "L'utilisateur que vous recherchez n'existe pas"
            return false;

        } else if (res.status == "miss_parameters"){

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-danger");
            notif_zone.innerHTML = "Un paramètre est manquant pour votre inscription : merci de remplir tout les champs nécessaire ou de contacter notre service technique.";
            return false;

        } else {

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-danger");
            notif_zone.innerHTML = "Une erreur inconnu est survenu lors l'exécution de la requête";
            return false;

        }

        return false;

    }

    xml.open("POST", "http://127.0.0.1/Projet%20OC5/utilisateur/connexion", true);
    xml.send(data)

}); 

