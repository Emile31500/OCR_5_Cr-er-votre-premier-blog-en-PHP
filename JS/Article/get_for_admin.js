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

        articles_html +=" <div class='row'>";
        articles_html += "<img style='margin:0; padding: 0px;' class='article_image rounded-start' src='http://127.0.0.1/Projet%20OC5/media/image/article_image/" + article.image + "'/>"
        articles_html += "<div style='margin:0; padding-bottom: 0px; position: relative;' class='col-9 border border-light rounded-end'>"
        articles_html += "<h4>" + article.libelle + "</h4>"
        articles_html += "<div class='border border-top text-primary' style='width: 100%;position: absolute;padding: 10px 16px 10px 16px;bottom: 0;left: 0;right: 0;margin: auto;'>"; 
        articles_html += "<div class='btn-group me-2 float-end' role='group' aria-label='First group'>";
        articles_html += "<button type='button' article='{{article.id}}' class='supp_link btn border border-danger'> x </button>";
        articles_html += "<a href='http://127.0.0.1/Projet%20OC5/article/editer/" + article.id + "'><button type='button' class='btn border border-info'> Editer </button></a>";
        articles_html += "<button type='button' article='" + article.id + "' class='pub_link btn border border-success'> Publier </button></div>";
        articles_html += "<div class='float-start'> Rédigé le  <span class='fst-italic'>" + article.date_enregistrement;

        if (article.date_enregistrement != article.date_derniere_modification){

            articles_html += "et édité le" + article.date_derniere_modification + "</span> par " + article.prenom + " " + article.nom + "</div></div></div></div>";

        }

        articles_html += "</span> par " + article.prenom + " " + article.nom + "</div></div></div></div>";
    
    });

    articles_list.innerHTML = articles_html;

})
