var sing_form = document.getElementById("admin_sing_form");
var notif_zone = document.getElementById("notif_zone");
var nom = document.getElementById("name");
var firstname = document.getElementById("firstname");
var email = document.getElementById("email");
var password = document.getElementById("password");
var confirm_password = document.getElementById("confirm_password");

var xml = new XMLHttpRequest();
xml.responseType = "document";
var data;
var res;

function is_password_valid(pswd, pswd_conf) {

    contain_upper = /[A-Z]/.test(pswd);
    contain_lower = /[a-z]/.test(pswd);
    contain_numbers = /[0-9]/.test(pswd);
    contain_spe_carac = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(pswd);
    pswd_equal = (pswd == pswd_conf);
    length = pswd.length >= 16 && pswd.length < 64;

    console.log(" 1 " +contain_lower)
    console.log(" 2 " +contain_numbers)
    console.log(" 3 " +contain_upper)
    console.log(" 6 " +contain_spe_carac)
    console.log(" 4 " +length)
    console.log(" 5 " +pswd_equal) 

    return (contain_lower && contain_numbers && contain_upper && length && pswd_equal && contain_spe_carac);

}

sing_form.addEventListener("submit", function(event){

    event.preventDefault();
    data = new FormData(this)
    
    if (nom.value.length > 64 ) {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-warning");
        notif_zone.innerHTML = "Le nom ne doit pas contenir plus de 64 caractères";
        return false;
    
    } else if (firstname.value.length > 64 ) {

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
    
    } else if (is_password_valid(password.value, confirm_password.value) == false) {

        notif_zone.className = "";
        notif_zone.classList.add("alert");
        notif_zone.classList.add("alert-warning");
        notif_zone.innerHTML = "Votre mot de passe n'est pas valide";
        return false;

    }
    

    xml.onreadystatechange = function (){

        console.log(xml.response)    
        res = xml.response.querySelector("#async_res_zone").innerHTML;

       if (res == "singed"){

            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-success");
            notif_zone.innerHTML = "Votre inscription a bien été confirmé";
            return true
            
        } else {
    
            notif_zone.className = "";
            notif_zone.classList.add("alert");
            notif_zone.classList.add("alert-danger");
            notif_zone.innerHTML = "Une erreur est survenu lors l'exécution de la requête";
            return false;

        }

    }

    xml.open("POST", "http://127.0.0.1/Projet%20OC5/administrateurs/nouveau");
    xml.send(data)

});