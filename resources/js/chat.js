window.Echo.channel('chat-channel')
    .listen('.chat-message', (e) => {
        console.log('New message:', e);
        let chatBox = document.getElementById('chat-messages');
        let newMessage = document.createElement('div');
        newMessage.innerHTML = `<strong>User ${e.user_id}:</strong> ${e.message}`;
        chatBox.appendChild(newMessage);
    });
