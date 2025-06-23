<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste to Wealth - AI Idea Generator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .chat-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .chat-box {
            height: 400px;
            border: 1px solid #ddd;
            padding: 20px;
            overflow-y: auto;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px 15px;
            border-radius: 8px;
        }
        .user-message {
            background-color: #e3f2fd;
            margin-left: 20%;
        }
        .ai-message {
            background-color: #f5f5f5;
            margin-right: 20%;
        }
        .input-container {
            display: flex;
            gap: 10px;
        }
        #messageInput {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .product-ideas {
            margin-top: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1>Waste to Wealth - AI Idea Generator</h1>
        <div class="chat-box" id="chatBox"></div>
        <div class="input-container">
            <input type="text" id="messageInput" placeholder="Ceritakan sampah yang Anda miliki..." />
            <button onclick="sendMessage()">Kirim</button>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chatBox');
        const messageInput = document.getElementById('messageInput');

        function addMessage(message, isUser = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${isUser ? 'user-message' : 'ai-message'}`;
            messageDiv.textContent = message;
            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function displayProductIdeas(ideas) {
            const ideasContainer = document.createElement('div');
            ideasContainer.className = 'product-ideas';
            
            ideas.forEach(idea => {
                const ideaHtml = `
                    <h4>${idea.name}</h4>
                    <p>Tingkat Kesulitan: ${idea.difficulty_level}</p>
                    <p>Estimasi Waktu: ${idea.estimated_time}</p>
                    <p>${idea.short_description}</p>
                    <p>Alat & Bahan: ${idea.required_tools.join(', ')}</p>
                    <hr>
                `;
                ideasContainer.innerHTML += ideaHtml;
            });

            chatBox.appendChild(ideasContainer);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        async function sendMessage() {
            const message = messageInput.value.trim();
            if (!message) return;

            // Tampilkan pesan user
            addMessage(message, true);
            messageInput.value = '';

            try {
                const response = await fetch('/api/generate-idea', {  // Pastikan ada forward slash di awal
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ message })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                
                // Tampilkan pesan AI
                addMessage(data.ai_message);
                
                // Tampilkan ide produk jika ada
                if (data.ideas && data.ideas.length > 0) {
                    displayProductIdeas(data.ideas);
                }
            } catch (error) {
                addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.');
                console.error('Error:', error);
            }
        }

        // Handle Enter key
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>