var add_com = new XMLHttpRequest();
add_com.responseType = "document";  
var message = document.getElementById('message');
var alert_zone = document.getElementById('alert_zone');
var form_post_commentaire = document.getElementById('form_post_commentaire');

form_post_commentaire.addEventListener("submit", function (event) {
   
    event.preventDefault();
    var data = new FormData(this);

    if (message.value.length > 150) {
        
        alert_zone.className = "";
        alert_zone.className = "alert alert-warning";
        alert_zone.innerHTML = "Attention : le message ne doit pas faire plus de 150 caractères";
        return false;

    } else {

        add_com.onreadystatechange = function (){

            if (add_com.response.querySelector("#async_res_zone").innerHTML == true){

                alert_zone.className = "";
                alert_zone.classList.add("alert");
                alert_zone.classList.add("alert-success");
                alert_zone.innerHTML = "Le commentaire a bien été enregistré";
                return true;

            } else {

                alert_zone.className = "";
                alert_zone.classList.add("alert");
                alert_zone.classList.add("alert-danger");
                alert_zone.innerHTML = "Erreur : le commentaure n'a pas pu être ajouté";
                return false;

            }

        }

    }
    
    add_com.open("POST", "http://127.0.0.1/Projet%20OC5/commentaires/envoyer");
    add_com.send(data);
    

});