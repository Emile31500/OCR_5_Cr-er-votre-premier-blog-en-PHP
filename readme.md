# Process to setp up this projet 
### Available in : English, Français

<br></br>

 ## English Explanation

 * Ensure you have a web server. Preferably wamp.

 * Import the projec with this git command :
 <br>```git clone https://github.com/Emile31500/OCR_5_Cr-er-votre-premier-blog-en-PHP ```</br>
Put the directory "Projet OC5" in the **server web root**

 * Import the DB "Projet OC5/mon_blog.sql"

 * Change the mysql user login and password in : "Projet OC5/app/model.php" 

 * *The site dosn't work ?*

 * Some packages could not work, especially with the shift of linux to windows os. You have to uninstall et reinstall those.
 
 Certain package ne marche pas en passant de linux à windows par exepmle. Il faut allors les désintaller et les réinstaller<br>
 For this, go in the site root.

 * Execute the upcoming command : ```composer remove twig/twig:^1.0```
 * Then : ```composer remove ckeditor/ckeditor:^4.2.0```

 * To reinstall packages, execute those commands

 * ```composer require twig/twig:^1.0```
 * And : ```composer require ckeditor/ckeditor:^4.2.0```

<br></br>

## Explication en français

 * Installez un serveur web. De préférence Wamp

 * Importez le projet avec cette commande git :
<br> ```git clone https://github.com/Emile31500/OCR_5_Cr-er-votre-premier-blog-en-PHP``` </br>
Mettre le répertoire Projet OC5 **à la racine du serveur web**

 * Importez la BDD "Projet OC5/mon_blog.sql"

 * Changez le login & mdp de l'utilisateur mysql dans  : "Projet OC5/app/model.php" 

 * *Le site ne marche pas ?*

 * Certain package ne marche pas en passant de linux à windows par exepmle. Il faut allors les désintaller et les réinstaller<br>
 Pour ceci, aller à la racine du site.

 * Tapez la commande suivante : ```composer remove twig/twig:^1.0```
 * Puis : ```composer remove ckeditor/ckeditor:^4.2.0```

 * Pour réinstaller les packets, exécutez les commandes

 * ```composer require twig/twig:^1.0```
 * Et : ```composer require ckeditor/ckeditor:^4.2.0```
