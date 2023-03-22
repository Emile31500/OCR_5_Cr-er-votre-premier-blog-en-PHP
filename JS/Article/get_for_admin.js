let articles_list = document.getElementById('articles_list');

async function fetchArticlesAdmin () {

    const r = await fetch('http://127.0.0.1/Projet%20OC5/article/listAdmin')
    if (r.ok === true) {
        return r.json();
    }

    throw new Error ('Requête impossible');
}

fetchArticlesAdmin().then(articles => {
    
    let zone_messages = document.getElementById('zone_affichage_messages');
    let articles_html = '';
    articles.forEach(article => {

        articles_html += "<div class='blog-item mt-3 mb-3'>"
        articles_html += "<div class='row'>"
        articles_html += "<div class='col-md-4'>"
        articles_html += "<img src='http://127.0.0.1/Projet%20OC5/media/image/article_image/" + article.image + "' alt='Blog Image' class='img-fluid'>"
        articles_html += "</div>"
        articles_html += "<div class='col-md-8'>"
        articles_html += "<h3>"  + article.libelle + " </h3>"
        articles_html += "<p>"

        articles_html += "<span> Rédigé le  <span class='fst-italic'>" + article.date_enregistrement+ "</span> par " + article.prenom + " " + article.nom + "</span><br>";

        if (article.date_enregistrement != article.date_derniere_modification){

            articles_html += "et édité le" + article.date_derniere_modification + "</span>";
    
        }

        articles_html += "</p>"
        articles_html += "<a href='http://127.0.0.1/Projet%20OC5/article/editer/" + article.id + "' class='btn border border-primary  mx-2 ml-3 mr-3 '>Editer</a>"
        articles_html += "<button article='" + article.id + "' type='button' class='btn border-primary sup_link ml-3 mr-3' data-bs-toggle='modal' data-bs-target='#confirmSup'> Supprimer </button>";

        let txt_btn = "Publier";
        if (article.est_publier == true){
            txt_btn = "Dépublier";
        }
        articles_html += "<a article='" + article.id + "' class='btn border-success pub_link mx-2' >" + txt_btn + "</a>"
        articles_html += "</div>"
        articles_html += "</div>"
        articles_html += "</div>"

    });

    articles_html += "<div class='modal fade' id='confirmSup' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='confirmSupLabel' aria-hidden='true'>"
    articles_html += "<div class='modal-dialog'>"
    articles_html += "<div class='modal-content'>"
    articles_html += "<div class='modal-header'>"
    articles_html += "<h3 class='modal-title fs-5' id='confirmSupLabel'>Attention ! </h3>"
    articles_html += "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>"
    articles_html += "</div>"
    articles_html += "<div id='modal-body-sup' class='modal-body'> Voulez-vous vraiment supprimer votre article ?</div>"
    articles_html += "<div class='modal-footer'>"
    articles_html += "<button type='button' id='closing_button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>"
    articles_html += "<button type='button' id='confirm_delete' atricle-id='' class='btn btn-danger'> Confirmer la suppression </button>"
    articles_html += "</div>"
    articles_html += "</div>"
    articles_html += "</div>"
    articles_html += "</div>"

    articles_list.innerHTML = articles_html;

}).then(function(){
    publishArt();
}).then(function (){
    deleteArt();
});
