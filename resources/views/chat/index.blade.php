<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e5ddd5; /* Warna latar belakang yang lebih lembut */
        }
        .chat-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .chat-box {
            height: 400px;
            overflow-y: scroll;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #ffffff; /* Warna latar belakang chat */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .text-right {
            background-color: #dcf8c6; /* Warna untuk pesan yang dikirim */
            border-radius: 10px;
            padding: 10px;
            margin: 5px 0;
            display: flex;
            align-items: center;
            justify-content: flex-end; /* Rata kanan */
        }
        .text-left {
            background-color: #f1f1f1; /* Warna untuk pesan yang diterima */
            border-radius: 10px;
            padding: 10px;
            margin: 5px 0;
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Rata kiri */
        }
        .back-button {
            margin-bottom: 20px;
        }
        .profile-picture {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .input-group {
            position: relative;
        }
        .input-group input {
            border-radius: 20px;
            border: 1px solid #ccc;
        }
        .input-group-append .btn {
            border-radius: 20px;
            background-color: #25d366; /* Warna tombol kirim */
            border: none;
        }
        .input-group-append .btn:hover {
            background-color: #128C7E; /* Warna tombol kirim saat hover */
        }
        .message-content { 
            display: flex;
        }
        .text-right .message-content {
            justify-content: flex-end; /* Rata kanan untuk pesan yang dikirim */
        }

        .text-left .message-content {
            justify-content: flex-start; /* Rata kiri untuk pesan yang diterima */
        }

        .text-right .profile-picture {
            order: 1; /* Gambar profil di sebelah kanan */
            margin-left: 10px; /* Jarak antara gambar dan teks */
        }

        .text-left .profile-picture {
            margin-right: 10px; /* Jarak antara gambar dan teks */
        }
    </style>
</head>
<body>
    <div class="container chat-container">
        <h1 class="mt-4">Chat with {{ $user->name }}</h1> <!-- Ganti ID dengan nama pengguna -->
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="back-button">
            <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('petugas.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        <div class="chat-box">
            @foreach($messages as $message)
            <div class="{{ $message->sender_id == Auth::id() ? 'text-right' : 'text-left' }}">
                <img src="{{ $message->sender_id == Auth::id() ? 
                    (Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/lte/dist/assets/img/user2-160x160.jpg') : 
                    ($message->sender->profile_picture ? asset('storage/' . $message->sender->profile_picture) : '/lte/dist/assets/img/user2-160x160.jpg') }}" 
                    class="profile-picture" alt="User  Image">
                <div>
                    <strong>{{ $message->sender_id == Auth::id() ? 'You' : ($message->sender->name ?? 'Unknown User') }}:</strong>
                    <p>{{ $message->message }}</p>
                    <p class="text-muted" style="font-size: 0.8em;">{{ $message->created_at->format('H:i') }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <form action="{{ route('chat.send') }}" method="POST">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $userId }}">
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="Type your message..." required aria-label="Type your message...">
                <div class="input-group-append">
                    <button class="btn btn -primary" type="submit" aria-label="Send message">Send</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const chatBox = document.querySelector('.chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
        
        // Fungsi untuk mengambil pesan baru
        function fetchMessages() {
            const userId = {{ $userId }};
            $.ajax({
                url: `/chat/messages/${userId}`,
                method: 'GET',
                success: function(data) {
                    chatBox.innerHTML = ''; // Kosongkan chat box
                    data.forEach(message => {
                        const messageDiv = document.createElement('div');
                        messageDiv.className = message.sender_id == {{ Auth::id() }} ? 'text-right' : 'text-left';
                        
                        // Ambil gambar profil berdasarkan pengirim
                        const profilePicture = message.sender_id == {{ Auth::id() }} 
                            ? ({{ Auth::user()->profile_picture }} ? '{{ asset('storage/') }}' + '{{ Auth::user()->profile_picture }}' : '/lte/dist/assets/img/user2-160x160.jpg') 
                            : (message.sender.profile_picture ? '{{ asset('storage/') }}' + message.sender.profile_picture : '/lte/dist/assets/img/user2-160x160.jpg');
        
                        messageDiv.innerHTML = `<img src="${profilePicture}" alt="Profile Picture" class="profile-picture">
                                                <div>
                                                    <strong>${message.sender_id == {{ Auth::id() }} ? 'You' : message.sender.name}:</strong>
                                                    <p>${message.message}</p>
                                                    <p class="text-muted" style="font-size: 0.8em;">${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</p>
                                                </div>`;
                        chatBox.appendChild(messageDiv);
                    });
                    chatBox.scrollTop = chatBox.scrollHeight; // Scroll ke bawah
                }
            });
        }
        
        // Ambil pesan baru setiap 5 detik
        setInterval(fetchMessages, 5000);
    </script>
</body>
</html>