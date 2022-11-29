var send_message_form = document.getElementById('send_message_form');
var firstname = document.getElementById('firstname');
var name = document.getElementById('name');
var email = document.getElementById('email');
var objet = document.getElementById('objet');
var message = document.getElementById('message');

var xml = new XMLHttpRequest();
var data;

send_message_form.addEventListener('submit', function(event){

    event.preventDefault();
    data = new FormData(this);

    req.open("GET", "http://127.0.0.1/Projet%20OC5/message/envoyer");
    xml.send(data);

});