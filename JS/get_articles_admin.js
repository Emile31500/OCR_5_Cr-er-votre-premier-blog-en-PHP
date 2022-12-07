var articles_list = document.getElementById("articles_list");
var res;    
var xml_1 = new XMLHttpRequest();
xml_1.responseType = "document";



xml_1.onreadystatechange = function(){

    res = xml_1.response.querySelector("#async_res_zone").innerHTML;
    articles_list.innerHTML = res;

}

xml_1.open("GET", "http://127.0.0.1/Projet%20OC5/articles/list_admin");
xml_1.send();

