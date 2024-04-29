

// Handle sending a message to the chatbot
function sendMessage() {
    var userInput = document.getElementById("userInput").value.trim(); // Get the user input
    
    if (userInput === "") {
        return; // Don't send empty messages
    }

    addMessage("user", userInput); // Add the user's message to the chat
    document.getElementById("userInput").value = ""; // Clear the input field

    // Send the user's message to the backend
    fetch("chatbot.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ message: userInput }), // Convert to JSON
    })
    .then(response => response.json()) // Parse the JSON response
    .then(data => {

        if (data.image) {
            addImage(data.image); // Add any image provided
        }
        addMessage("bot", data.message); // Add the chatbot's response
        scrollChatbox(); // Scroll to the latest message
    })
    .catch(error => console.error("Error sending message:", error)); // Handle errors
}
// Handle the Enter key to send messages
function handleKeyDown(event) {
    if (event.key === "Enter") {
        sendMessage(); // Send message on Enter key
    }
}

// Add a message to the chatbox
function addMessage(sender, text) {
    var chatbox = document.getElementById("chatbox");
    var messageElement = document.createElement("div");
    messageElement.className = "message " + (sender === "user" ? "user-message" : "bot-message");
    messageElement.innerText = text; // Set message text
    chatbox.appendChild(messageElement); // Add to chatbox
    scrollChatbox(); // Scroll to the latest message
}

// Add an image to the chatbox
function addImage(src) {
    var chatbox = document.getElementById("chatbox");
    var imgElement = document.createElement("img");
    imgElement.src = src; // Set image source
    imgElement.style.maxWidth = "100%"; // Ensure image doesn't overflow
    chatbox.appendChild(imgElement); // Add to chatbox
}

// Scroll to the latest message in the chatbox
function scrollChatbox() {
    var chatbox = document.getElementById("chatbox");
    chatbox.scrollTop = chatbox.scrollHeight; // Scroll to the bottom
}
