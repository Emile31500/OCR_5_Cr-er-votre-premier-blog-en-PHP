let articles_list = document.getElementById('articles_list');

async function fetchArticlesAdmin () {

    const r = await fetch('http://127.0.0.1/Projet%20OC5/article/listAdmin')
    if (r.ok === true) {
        return r.json();
    }

    throw new Error ('Requête impossible');
}

fetchArticlesAdmin().then(articles => {

    console.log(articles);
    let zone_messages = document.getElementById('zone_affichage_messages');
    let articles_html = '';
    articles.forEach(article => {

        articles_html += "<div class='blog-item mt-3 mb-3'>"
        articles_html += "<div class='row'>"
        articles_html += "<div class='col-md-4'>"
        articles_html += "<img src='http://127.0.0.1/Projet%20OC5/media/image/article_image/" + article.image + "' alt='Blog Image' class='img-fluid'>"
        articles_html += "</div>"
        articles_html += "<div class='col-md-8'>"
        articles_html += "<h3><a href='#'>"  + article.libelle + "</a></h3>"
        articles_html += "<p>"

        articles_html += "<span> Rédigé le  <span class='fst-italic'>" + article.date_enregistrement+ "</span> par " + article.prenom + " " + article.nom + "</span><br>";

        if (article.date_enregistrement != article.date_derniere_modification){

            articles_html += "et édité le" + article.date_derniere_modification + "</span>";
    
        }

        articles_html += "</p>"
        articles_html += "<a href='http://127.0.0.1/Projet%20OC5/article/editer/'" + article.id + "' class='btn border border-primary '>Editer</a>"
        articles_html += "<a href='#' article='" + article.id + "' class='btn border-danger supp_link'> Supprimer</a>"
        articles_html += "<a href='#' article='" + article.id + "' class='btn border-success pub_link'>Publier </a>"
        articles_html += "</div>"
        articles_html += "</div>"
        articles_html += "</div>"

        

       
    
    });

    articles_list.innerHTML = articles_html;

})
