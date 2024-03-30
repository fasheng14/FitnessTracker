<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger</title>
    <style type="text/css">
        /* CSS for the messenger window */
        .msg-container {
            position: fixed;
            bottom: 10px;
            right: 10px;
            width: 500px; 
            height: 600px; 
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            display: none; 
        }

        .header {
            height: 30px;
            background-color: #f0f0f0;
            border-bottom: 1px solid #ccc;
            text-align: center;
            line-height: 30px;
        }

        .msg-area {
            height: calc(100% - 82px);
            overflow-y: auto;
            padding: 5px;
        }

        .bottom {
            height: 50px;
            border-top: 1px solid #ccc;
            padding: 5px 10px;
        }

        .msginput {
            width: calc(100% - 20px);
            padding: 5px;
            margin-bottom:10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            outline: none;
        }

        .msg {
        margin: 10px 10px;
        background-color: #b637a1;
        max-width: calc(45% - 20px);
        color: #000;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
        word-wrap: break-word; 
    }

    .msgsentby {
        color: #8C8C8C;
        font-size: 12px;
        margin: 4px 0px 30px 150px;
    }
        /* Additional styles */
        .messenger-button {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color: #473d87;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Messaging button -->
    <button class="messenger-button" onclick="toggleMessenger()">Messenger</button>

    <!-- Messenger container -->
    <div class="msg-container" id="msg-container">
         <div class="header" onclick="toggleMessenger()">Messenger <span class="close-btn"></span></div>
        <div class="msg-area" id="msg-area"></div>
        <div class="bottom">
            <input type="text" name="msginput" class="msginput" id="msginput" placeholder="Enter your message here ... (Press enter to send message)">
        </div>
    </div>

    <script type="text/javascript">
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
                            msgArea.scrollTop = msgArea.scrollHeight; // Scroll to bottom
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
    </script>
</body>
</html>

<!--REFERENCES

https://github.com/howCodeORG/Messenger/blob/master/index.php

-->


