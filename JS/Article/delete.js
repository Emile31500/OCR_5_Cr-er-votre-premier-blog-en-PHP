function deleteArt() {
    
    let article;
    let res;
    let xml = new XMLHttpRequest();

    let confirm_delete = document.querySelector('#confirm_delete');
    let sup_link = document.querySelectorAll(".sup_link");
    for (let i = 0; i < sup_link.length; i++) {

        sup_link[i].addEventListener("click", function(event){
            
            event.preventDefault();
            article = this.getAttribute("article");
            confirm_delete.setAttribute("article", article);

            confirm_delete.addEventListener("click", function(event){

                event.preventDefault();
                xml.onreadystatechange = function(){
                
                     res = JSON.parse(xml.response);
                     if (res.status == true){

                        alert("Suppression éxecutée avec succés.");
                        sup_link[i].parentElement.parentElement.parentElement.classList.add("d-none");
                        document.querySelector('#closing_button').click();
                        
                     } else {
                    
                         alert("Echec lors de la supression.");
                    
                     }
                        
                 }
                                
                 xml.open("POST", "http://127.0.0.1/Projet%20OC5/article/supprimer/" + article);
                 xml.send();

                 return true
            });
            
            return true
        
        })
    }
    
}