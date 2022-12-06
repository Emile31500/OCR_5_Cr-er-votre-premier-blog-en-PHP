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
var title_article = document.getElementById("title_article");
var ajouter_article = document.getElementById("ajouter_article");
var text_area_article =  document.getElementById("text_area_article");
var formulaire_ajout_article = document.getElementById("formulaire_ajout_article");
var data;
var xml = new XMLHttpRequest()


formulaire_ajout_article.addEventListener("submit", function(event){

    event.preventDefault();
    var editor = document.getElementById("editor");
    text_area_article.value = editor.innerHTML;

    data = new FormData(this)
    xml.responseType = "document";
    xml.onreadystatechange = function () {

        var res = xml.response;
        console.log(res);
        res = res.querySelector("#async_res_zone");

        if (res.innerHTML == 1 || res.innerHTML == true|| res.innerHTML == "true") {

            
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

    
    xml.open("POST", "http://127.0.0.1/Projet%20OC5/articles/ajout");
    xml.send(data);

});