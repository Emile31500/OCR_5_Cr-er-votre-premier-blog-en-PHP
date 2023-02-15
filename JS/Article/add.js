DecoupledEditor
        .create( document.querySelector( '#editor' ), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        } )
        .then( editor => {
            const toolbarContainer = document.querySelector( 'main .toolbar-container' );

            toolbarContainer.prepend( editor.ui.view.toolbar.element );

            window.editor = editor;
        } )
        .catch( err => {
            console.error( err.stack );
        } );

var alert_zone = document.getElementById("alert_zone");
var title_image = document.getElementById("title_image");
var pre_visu_img = document.getElementById("pre_visu_img");
var title_article = document.getElementById("title_article");
var ajouter_article = document.getElementById("ajouter_article");
var text_area_article =  document.getElementById("text_area_article");
var formulaire_ajout_article = document.getElementById("formulaire_ajout_article");
var data;
var xml = new XMLHttpRequest();

title_image.addEventListener("input", function (event){


    if(event.target.files.length > 0){

        var src = URL.createObjectURL(event.target.files[0]);
        pre_visu_img.src = src;
        pre_visu_img.style.display = "block";
    }

});
  



formulaire_ajout_article.addEventListener("submit", function(event){

    event.preventDefault();
    let editor = document.getElementById("editor");
    text_area_article.value = editor.innerHTML;

    if (editor.innerHTML.length > 16384){

                    
        alert_zone.className = "";
        alert_zone.classList.add("alert");
        alert_zone.classList.add("alert-warning");
        alert_zone.innerHTML = "Attetion : l'article est trop long et ne peut donc pas être enregistré";
        return false;


    }

    data = new FormData(this)
    xml.onreadystatechange = function () {

        var res = JSON.parse(xml.response);

        if (res.status == true) {

            
            alert_zone.className = "";
            alert_zone.classList.add("alert");
            alert_zone.classList.add("alert-success");
            alert_zone.innerHTML = "L'article a bien été enregistré ";
            return true;

        } else {

            
            alert_zone.className = "";
            alert_zone.classList.add("alert");
            alert_zone.classList.add("alert-danger");
            alert_zone.innerHTML = "Erreur : l'article n'a pas put être enregistré";
            return false;

        }

    }

    
    xml.open("POST", "http://127.0.0.1/Projet%20OC5/article/ajout");
    xml.send(data);

});