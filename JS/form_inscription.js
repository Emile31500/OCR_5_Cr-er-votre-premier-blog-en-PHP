var sing_form = document.querySelector("#sing_form");
var notif_zone = document.querySelector("#alert");

var nom = document.querySelector("#name");
var firstname = document.querySelector("#firstname");
var user_name = document.querySelector("#user_name")
var email = document.querySelector("#email");
var password = document.querySelector("#password");
var confirm_password = document.querySelector("#confirm_password");
var birth_day = document.querySelector("#birth_day");

var xml = new XMLHttpRequest();
var data;
var res;

function is_password_valid(str) {

    contain_upper = /[A-Z]/.test(str);
    contain_lower = /[a-z]/.test(str);
    contain_numbers = /[0-9]/.test(str);

    return (contain_lower && contain_numbers && contain_upper);
}

sing_form.addEventListener("submit", function(event){

    event.preventDefault();
    data = new FormData(this)

    xml.responseType = "document";

    if (nom.value.length > 64 ) {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-warning");
        notif_zone.innerHTML = "Le nom ne doit pas contenir plus de 64 caractères";
        return false;
    
    } else if (prenom.value.length > 64 ) {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-warning");
        notif_zone.innerHTML = "Le prénom ne doit pas contenir plus de 64 caractères";
        return false;
    
    } else if (email.value.length > 64 ) {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-warning");
        notif_zone.innerHTML = "L'email ne doit pas contenir plus de 64 caractères";
        return false;
    
    }  else if (user_name.value.length > 64 ) {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-warning");
        notif_zone.innerHTML = "Le nom d'utilisateur ne doit pas contenir plus de 32 caractères";
        return false;
    
    } else if (password.value != confirm_password.value) {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-warning");
        notif_zone.innerHTML = "Vos mots de passe ne sont pas identique ";
        return false;
    
    } else if (password.value.length < 8 || password.value.length > 64 ) {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-warning");
        notif_zone.innerHTML = "La longueur de votre mot de passe n'est pas valide : Il doit contenir entre 8 et 64 caractères";
        return false;
    
    } else if (is_password_valid(password.value)) {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-warning");
        notif_zone.innerHTML = "Votre mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre";
        return false;

    }
    
    xml.onreadystatechange() = function() {

        res = xml.res.querySelector("#async_res_zone");

        if (res == "parametres_manquant"){

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-danger");
            notif_zone.innerHTML = "Votre inscription a bien été confirmé";
            
        } else if (res == "utilisateur_existe"){

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-danger");
            notif_zone.innerHTML = "Enregistrement impossible : Un utilisateur avec cette email ou ce numéro de téléphone existe déjà";
            
        } else if (res == 1 || res == true || res == "true"){

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
    

    }
    

    xml.open("POST", "http://127.0.0.1/Projet%20OC5/utilisateurs/inscription");
    xml.send(data)

});