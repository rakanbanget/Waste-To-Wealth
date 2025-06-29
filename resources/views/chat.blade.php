<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste to Wealth - AI Idea Generator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-green-600 mb-8">Waste to Wealth - AI Idea Generator</h1>
        <div id="chatBox" class="bg-white rounded-lg shadow-lg p-6 h-[500px] overflow-y-auto mb-6"></div>
        <div class="flex gap-4">
            <input 
                type="text" 
                id="messageInput" 
                placeholder="Ceritakan sampah yang Anda miliki..." 
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
            />
            <button 
                onclick="sendMessage()" 
                class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
            >
                Kirim
            </button>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chatBox');
        const messageInput = document.getElementById('messageInput');

        function addMessage(message, isUser = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `mb-4 p-4 rounded-lg ${
                isUser 
                    ? 'bg-green-50 ml-12 rounded-br-none' 
                    : 'bg-gray-50 mr-12 rounded-bl-none'
            }`;
            messageDiv.textContent = message;
            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function displayProductIdeas(ideas) {
            const ideasContainer = document.createElement('div');
            ideasContainer.className = 'bg-white rounded-lg p-4 mb-4 shadow-sm';
            
            ideas.forEach(idea => {
                const ideaHtml = `
                    <div class="mb-4 last:mb-0">
                        <h4 class="text-lg font-semibold text-green-600">${idea.name}</h4>
                        <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 mt-2">
                            <p>Tingkat Kesulitan: ${idea.difficulty_level}</p>
                            <p>Estimasi Waktu: ${idea.estimated_time}</p>
                        </div>
                        <p class="mt-2 text-gray-700">${idea.short_description}</p>
                        <p class="mt-2 text-gray-600">
                            <span class="font-medium">Alat & Bahan:</span> 
                            ${idea.required_tools.join(', ')}
                        </p>
                        <hr class="my-4 border-gray-200">
                    </div>
                `;
                ideasContainer.innerHTML += ideaHtml;
            });
            chatBox.appendChild(ideasContainer);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function sendMessage() {
            const message = messageInput.value.trim();
            if (!message) return;

            addMessage(message, true);
            messageInput.value = '';

            fetch('/api/generate-idea', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message })
            })
            .then(response => response.json())
            .then(data => {
                addMessage(data.message);
                if (data.product_ideas) {
                    displayProductIdeas(data.product_ideas);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.');
            });
        }

        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>