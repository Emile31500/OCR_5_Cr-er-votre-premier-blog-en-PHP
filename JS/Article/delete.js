function deleteArt() {
    
    let article;
    let res;
    let xml = new XMLHttpRequest();
    
    let sup_link = document.querySelectorAll(".sup_link");
    for (let i = 0; i < sup_link.length; i++) {

        sup_link[i].addEventListener("click", function(event){
            
            event.preventDefault();
            console.log("event listened");
            article = this.getAttribute("article");
            xml.onreadystatechange = function(){
                
                res = JSON.parse(xml.response);
                if (res.status == true){
    
                    alert("Article supprimé");
                    sup_link[i].parentElement.parentElement.parentElement.classList.add("d-none");
                   
                } else {

                    alert("Echec lors de la supression");

                }
    
            }
            
            xml.open("POST", "http://127.0.0.1/Projet%20OC5/article/supprimer/" + article);
            xml.send();
        
        })
    }
    
}