<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gemini Chatbot</title>
    
    <meta name="title" content="Gemini Chatbot by Arif Nezami">
    <meta name="description" content="Gemini Chatbot by Arif Nezami">
    <meta name="keywords" content="gemini, google cloud, gcp, LLM, chatbot, php">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="arifnezami">
        
    
    
    <link rel="stylesheet" href="style.css">
    <script src="chatbot.js"></script>
</head>
<body>
    <div class="chat-container">
        <div class="header">Gemini Chatbot</div>
        
        <div id="chatbox" class="chatbox"></div>
        
       

        <div class="input-container">
            <input type="text" id="userInput" placeholder="Type a message..." onkeydown="handleKeyDown(event)">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
</body>
</html>
