@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl p-6 bg-white shadow-lg rounded-lg mt-10">
    <h2 class="text-2xl font-bold mb-4">Chat</h2>

    <div id="chat-box" class="p-4 border rounded h-80 overflow-auto bg-gray-100">
        <ul id="messages"></ul>
    </div>

    <form id="chat-form" class="mt-4">
        @csrf
        <input type="text" id="message" class="w-full p-2 border rounded" placeholder="Type a message..." required>
        <button type="submit" class="mt-2 w-full bg-green-500 text-white p-2 rounded">Send</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.0/axios.min.js"></script>
<script>
    const messagesList = document.getElementById('messages');

    function fetchMessages() {
        axios.get('/chat/messages').then(response => {
            messagesList.innerHTML = '';
            response.data.forEach(msg => {
                messagesList.innerHTML += `<li class="p-2 border-b">${msg.user.name}: ${msg.message}</li>`;
            });
        });
    }

    fetchMessages();

    Echo.channel('chat-channel')
        .listen('.chat-message', (event) => {
            messagesList.innerHTML += `<li class="p-2 border-b">${event.message.user.name}: ${event.message.message}</li>`;
        });

    document.getElementById('chat-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const message = document.getElementById('message').value;

        axios.post('/chat/messages', { message })
            .then(() => {
                document.getElementById('message').value = '';
            });
    });
</script>
@endsection
