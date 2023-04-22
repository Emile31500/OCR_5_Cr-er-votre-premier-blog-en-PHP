function publishArt(){
    
    let xml = new XMLHttpRequest();
    let pub_link = document.querySelectorAll(".pub_link");
    let message, new_btn_txt, res, article;

    for (let i = 0; i < pub_link.length; i++) {

        pub_link[i].addEventListener("click", func =function(event){

            event.preventDefault();
            article = this.getAttribute("article");

            if (this.innerHTML == "Publier"){

                message = "Article publié";
                new_btn_txt = "Dépublier";

            } else {

                message = "Article dépublié";
                new_btn_txt = "Publier";

            }

            xml.onreadystatechange = function(){
                
                res = JSON.parse(xml.response);

                if (res.status === true){
    
                    alert(message);
                    pub_link[i].innerHTML = new_btn_txt;

                } else {

                    alert("Echec lors de la requête");

                }
    
            }
            
            xml.open("POST", "http://127.0.0.1/Projet%20OC5/article/publier/" + article, true);
            xml.send();

            pub_link[i].removeEventListener('click', func);
        
        })
    }
    
}