async function fetchMessages () {

    const r = await fetch('http://127.0.0.1/Projet%20OC5/message/getMessages')
    if (r.ok === true) {
        return r.json();
    }

    throw new Error ('Requête impossible');
}

fetchMessages().then(messages => {

    let zone_messages = document.getElementById('zone_affichage_messages');
    let messages_html = '';
    messages.forEach(message => {
        
        messages_html += "<tr> <th class='optional-content'> "+message[0] +" </th> <td class='optional-content'    >" + message['nom'] + " " + message['prenom'] + "</td><td> " + message['email'] + "</td><td> " + message['date_envoie'] + "</td><td> " + message['objet'] + "</td><td>" + message['message'] + "</td></tr>";
   
    });

    zone_messages.innerHTML = messages_html;

})