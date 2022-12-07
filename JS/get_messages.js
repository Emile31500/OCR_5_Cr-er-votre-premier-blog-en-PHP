var messages_list = document.getElementById("messages_list");
var res;
var xml = new XMLHttpRequest();
xml.responseType = "document";



xml.onreadystatechange = function(){

    res = xml.response.querySelector("#async_res_zone").innerHTML;
    messages_list.innerHTML = res;    

}

xml.open("GET", "http://127.0.0.1/Projet%20OC5/messages/get_messages");
xml.send();



