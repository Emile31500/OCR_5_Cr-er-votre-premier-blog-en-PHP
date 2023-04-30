function publishArt(){
    
    let xml = new XMLHttpRequest();
    let pub_link = document.querySelectorAll(".pub_link");
    let message, new_btn_txt, res, article;

    for (let i = 0; i < pub_link.length; i++) {

<<<<<<< HEAD
        pub_link[i].addEventListener("click", func =function(event){
=======
        pub_link[i].addEventListener("click", function(event){
>>>>>>> OCR5/master

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
                
<<<<<<< HEAD
                res = JSON.parse(xml.response);

                if (res.status === true){
    
                    alert(message);
                    pub_link[i].innerHTML = new_btn_txt;
=======
                res = JSON.parse(xml.response).status;

                if (res === true){
    
                    alert(message);
                    pub_link[i].innerHTML = new_btn_txt;x
>>>>>>> OCR5/master

                } else {

                    alert("Echec lors de la requête");

                }
    
            }
            
            xml.open("POST", "http://127.0.0.1/Projet%20OC5/article/publier/" + article, true);
            xml.send();
<<<<<<< HEAD

            pub_link[i].removeEventListener('click', func);
        
        })
    }
    
=======
        
        })
    }
>>>>>>> OCR5/master
}