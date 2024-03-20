// Fonction pour envoyer un message
function envoyerMessage() {
    var messageInput = document.getElementById("messageInput");

    // Obtenir le texte du message
    var texteMessage = messageInput.value;

    // Récupérer les messages stockés localement
    var messages = JSON.parse(localStorage.getItem("messages")) || [];

    // Ajouter le nouveau message à la liste
    messages.push(texteMessage);

    // Stocker la liste mise à jour dans le stockage local
    localStorage.setItem("messages", JSON.stringify(messages));

    // Rediriger vers la page intervent.html
    window.location.href = 'intervent.html';
}