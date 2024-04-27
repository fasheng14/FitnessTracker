// Function to toggle messenger visibility
function toggleMessenger() {
    var messenger = document.getElementById("msg-container");
    if (messenger.style.display === "none") {
        messenger.style.display = "block";
        update(); // Load messages when messenger is opened
    } else {
        messenger.style.display = "none";
    }
}

// Function to update messages
function update() {
    var xmlhttp = new XMLHttpRequest();
    var output = "";
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = xmlhttp.responseText.split("\n");
            var rl = response.length;
            var item = "";
            for (var i = 0; i < rl; i++) {
                item = response[i].split("\\");
                if (item[1] != undefined) {
                    output += "<div class=\"msgc\"> <div class=\"msg\">" + item[1] + "</div> <div class=\"msgarr\"></div> <div class=\"msgsentby\">Sent by " + item[0] + "</div> </div>";
                }
            }
            document.getElementById("msg-area").innerHTML = output;
            document.getElementById("msg-area").scrollTop = document.getElementById("msg-area").scrollHeight;
        }
    };
    xmlhttp.open("GET", "get-message.php", true);
    xmlhttp.send();
}

// Function to send message
function sendmsg() {
    var message = document.getElementById("msginput").value.trim(); // Trim to remove leading/trailing whitespace
    if (message !== "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // If message successfully sent, update the UI
                if (xmlhttp.responseText === "Message inserted successfully.") {
                    var msgArea = document.getElementById("msg-area");
                    msgArea.innerHTML += "<div class=\"msgc\"> <div class=\"msg msgfrom\">" + message + "</div> <div class=\"msgarr msgarrfrom\"></div> </div>";
                    msgArea.scrollTop = msgArea.scrollHeight; 
                    document.getElementById("msginput").value = ""; // Clear input field
                }
            }
        };
        xmlhttp.open("GET", "update-message.php?message=" + encodeURIComponent(message), true);
        xmlhttp.send();
    }
}

// Add event listener for Enter key press
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("msginput").addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            sendmsg();
        }
    });
});

// Update messages periodically
setInterval(function() {
    var messenger = document.getElementById("msg-container");
    if (messenger.style.display === "block") {
        update();
    }
}, 2500);

// REFERENCES

// https://github.com/howCodeORG/Messenger/blob/master/get-messages.php
