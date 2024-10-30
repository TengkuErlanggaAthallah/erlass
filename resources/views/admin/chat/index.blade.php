<!-- resources/views/chat.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Chat</h2>
    <div id="chat-container" style="border: 1px solid #ccc; padding: 10px; height: 400px; overflow-y: scroll;">
        <div id="messages"></div>
    </div>
    <input type="text" id="message" placeholder="Ketik pesan..." class="form-control mt-2">
    <button id="send" class="btn btn-primary mt-2">Kirim</button>
</div>

<script>
    const userId = {{ $userId }}; // ID pengguna yang ingin Anda ajak chat
    const messagesContainer = document.getElementById('messages');

    document.getElementById('send').addEventListener('click', function() {
        const message = document.getElementById('message').value;

        fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ receiver_id: userId, message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('message').value = '';
                loadMessages();
            }
        });
    });

    function loadMessages() {
        fetch(`/chat/messages/${userId}`)
            .then(response => response.json())
            .then(messages => {
                messagesContainer.innerHTML = '';
                messages.forEach(msg => {
                    const messageElement = document.createElement('div');
                    messageElement.textContent = `${msg.sender_id}: ${msg.message}`;
                    messagesContainer.appendChild(messageElement);
                });
            });
    }

    // Load messages every 2 seconds
    setInterval(loadMessages, 2000);
</script>
@endsection