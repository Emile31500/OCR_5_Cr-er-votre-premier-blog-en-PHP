var login_form = document.getElementById("login_form");
var login = document.getElementById("login");
var password = document.getElementById("password");
var xml = new XMLHttpRequest();
var data;


login_form.addEventListener("submit", function(event){
    
    event.preventDefault();
    data = new FormData(this);

    xml.responseType = "document";
    xml.onreadystatechange = function(){

        var res = xml.response.querySelector("#async_res_zone").innerHTML;
        if (res == "password_ok"){

            alert("Connexion ...");

        } else {

            alert("ERREUR");

        }

    }

    xml.open("POST", "http://127.0.0.1/Projet%20OC5/utilisateurs/connexion");
    xml.send(data)

}); 

