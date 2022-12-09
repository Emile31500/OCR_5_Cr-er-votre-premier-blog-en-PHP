var article
var res
var redirect = new XMLHttpRequest();
redirect.responseType = "document"
xml_1.addEventListener("loadend", function(){

    var supp_links = document.querySelectorAll("button.supp_link");
    for (let i = 0; i < supp_links.length; i++) {

        supp_links[i].addEventListener("click", function(event){

            event.preventDefault();
            article = this.getAttribute("article");
            redirect.onreadystatechange = function(){
                
                res = redirect.response.querySelector("#async_res_zone").innerHTML
                if (res == true){
    
                    alert("Article supprimer");
                    supp_links[i].parentElement.parentElement.parentElement.parentElement.classList.add("d-none");
                    return true;

                } else {

                    alert("Echec lors de la supression");
                    return false;

                }
    
            }
            
            redirect.open("POST", "http://127.0.0.1/Projet%20OC5/articles/supprimer/" + article);
            redirect.send();
        
        })
    }

}, true);

