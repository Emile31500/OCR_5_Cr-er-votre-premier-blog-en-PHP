var load_com = new XMLHttpRequest();
load_com.responseType = "document";
var article_id = document.getElementById('article-id');
var zone_commentaires = document.getElementById('zone_commentaires');


load_com.onreadystatechange = function () {
    
    zone_commentaires.innerHTML = load_com.response.querySelector("#async_res_zone").innerHTML;

}

load_com.open("GET", "http://127.0.0.1/Projet%20OC5/commentaire/liste/" + article_id.value);
load_com.send();