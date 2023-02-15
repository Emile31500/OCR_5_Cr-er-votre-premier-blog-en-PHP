var article
var res
var publier = new XMLHttpRequest();
publier.responseType = "document"
publier.addEventListener("loadend", function(){

    var supp_links = document.querySelectorAll("button.pub_link");
    for (let i = 0; i < supp_links.length; i++) {

        supp_links[i].addEventListener("click", function(event){

            event.preventDefault();
            article = this.getAttribute("article");
            publier.onreadystatechange = function(){
                
                res = publier.response.querySelector("#async_res_zone").innerHTML
                if (res == true){
    
                    alert("Article publié");
                    return true;

                } else {

                    alert("Echec lors de la publication");
                    return false;

                }
    
            }
            
            publier.open("POST", "http://127.0.0.1/Projet%20OC5/article/publier/" + article);
            publier.send();
        
        })
    }

}, true);

