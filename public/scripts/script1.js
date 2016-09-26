// $('#form').submit(function(e){
//     e.preventDefault(); // on empêche le bouton d'envoyer le formulaire

//     var pseudo = encodeURIComponent( $('#pseudo').val() ); // on sécurise les données
//     var message = encodeURIComponent( $('#message').val() );

//     if(pseudo != "" && message != ""){ // on vérifie que les variables ne sont pas vides
//         $.ajax({
//             url : "apps/traitement_home.php", // on donne l'URL du fichier de traitement
//             type : "POST", // la requête est de type POST
//             data : "submit=1&pseudo=" + pseudo + "&message=" + message // et on envoie nos données
//         });
//         charger();
//        // $('#messages').append("<p>" + pseudo + " dit : " + message + "</p>"); // on ajoute le message dans la zone prévue
//     }
// });
setInterval(charger, 1500);
function charger(){

        var premierID = $('#input p:first').attr('id'); // on récupère l'id le plus récent

        $.ajax({
            url : "apps/list_message.php", // on passe l'id le plus récent au fichier de chargement
            type : "GET",
            success : function(html){
                $('#messages').html(html);
            }
        });

}

charger();
