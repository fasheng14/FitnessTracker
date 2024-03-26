<?php
session_start();
// Database configuration
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "fitnessTrackDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Grabs the username of the logged-in user
$username = $_SESSION['username'];

// Fetch user data from the database except the current user
$sql = "SELECT Username FROM User WHERE Username != '$username'";
$result = $conn->query($sql);
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row['Username'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracker App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Mate SC front from Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 style="font-size: 2em;">Fitness Tracker App</h1>
        <!-- Navigation between site pages  -->
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="../userDashboard.php">My Profile</a>
                <a href="../myPlan.php">My Plan</a>
                <a href="../communityPage.php">Community</a>
                <a href="../exerciseLibrary.php">Exercise Library</a>
                <a href="../SignUpPages/adminAccountCreate.php">Create an Admin Account</a>
                <a href="../createDatabase.php">Create the database</a>
                <a href="logout.php">Sign out </a>
            </nav>
        </div>
    </header>
    <!-- Main Content  -->
    <main>
        <h2 style="margin-bottom: 20px;">Welcome
            <?php echo $username ?> to our Fitness Tracker</h2>
        <div class="info-container"></div>
        <!-- Messaging tool button -->
        <button id="openMessagingBtn" class="messaging-button">
            <i class="fas fa-comments"></i> Messaging</button>
       <!-- Messaging section -->
        <div id="messagingSection" class="messaging-section hidden">
        <button id="backButton" class="back-button hidden">Back</button> <!-- Move the back button here -->
            <div class="contacts-container" id="contactsContainer">
                <h3 id="friendsHead">Friends</h3>
                <!-- List of contacts will be displayed here -->
                <?php foreach ($users as $user): ?>
                    <div class="contact" data-user="<?php echo $user ?>"><?php echo $user ?></div>
                <?php endforeach; ?>
            </div>
            <div class="conversation-container" id="conversationContainer">
                <!-- Conversation messages will be displayed here -->
            </div>
            <div class="input-container hidden" id="inputContainer">
                <input type="text" id="messageInput" placeholder="Type your message...">
                <button id="sendMessageBtn">Send</button>
            </div>
            <div class="new-contact-container hidden">
                <input type="text" id="newContactInput" placeholder="Enter username">
                <button id="addContactBtn">Add Friend</button>
    </div>
    </main>
    <footer></footer>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var openMessagingBtn = document.getElementById("openMessagingBtn");
            var messagingSection = document.getElementById("messagingSection");
            var contactsContainer = document.getElementById("contactsContainer");
            var conversationContainer = document.getElementById("conversationContainer");
            var inputContainer = document.getElementById("inputContainer");
            var messageInput = document.getElementById("messageInput");
            var backButton = document.getElementById("backButton");
            var newContactInput = document.getElementById("newContactInput");
            var addContactBtn = document.getElementById("addContactBtn");
            var newContactContainer = document.querySelector(".new-contact-container");

            // Toggle messaging section visibility when button is clicked
            openMessagingBtn.addEventListener("click", function () {
                messagingSection.classList.toggle("visible");
                // Show the input field for adding a new contact only when contacts are displayed
                if (contactsContainer.style.display === "block") {
                    newContactContainer.classList.toggle("hidden");
                }
            });

            var conversations = {};

            // Function to display conversation messages
            function displayConversation(user) {
                conversationContainer.innerHTML = ""; // Clear existing messages
                if (conversations[user]) {
                    // Remove existing username if displayed
                    var existingUserHeading = conversationContainer.querySelector('.user-heading');
                    if (existingUserHeading) {
                        existingUserHeading.remove();
                    }

                    // Display the name of the user at the top of the conversation
                    var userHeading = document.createElement("div");
                    userHeading.textContent = user; // Modify as needed
                    userHeading.classList.add("message-sender");
                    userHeading.classList.add("user-heading"); // Add the user-heading class
                    conversationContainer.appendChild(userHeading);
                    conversations[user].forEach(function (messageObj) {
                        var messageDiv = document.createElement("div");
                        if (messageObj.sender === "You") {
                            messageDiv.classList.add("user-message-container");
                            messageDiv.innerHTML = '<div class="message user-message">' +
                                '<span class="user-message-text">' + messageObj.message + '</span></div>';
                        } else {
                            messageDiv.classList.add("sender-message-container");
                            messageDiv.innerHTML = '<div class="message-sender">' + messageObj.sender + '</div>' +
                                '<div class="message sender-message">' +
                                '<span class="sender-message-text">' + messageObj.message + '</span></div>';
                        }
                        conversationContainer.appendChild(messageDiv);
                    });
                    // Display input field for sending messages
                    inputContainer.classList.remove("hidden");
                    backButton.classList.remove("hidden"); // Show the back button

                    // Show selected contact above the messages
                    var selectedContactElement = document.querySelector('.selected-contact');
                    if (selectedContactElement) {
                        var selectedContactUsername = selectedContactElement.textContent.trim();
                        var selectedContactHeading = document.createElement("div");
                        selectedContactHeading.textContent = selectedContactUsername;
                        conversationContainer.prepend(selectedContactHeading);
                    }
                }
            }

            // Event listener for clicking on a contact
            contactsContainer.addEventListener("click", function (event) {
                var target = event.target;
                if (target.classList.contains("contact")) {
                    var user = target.dataset.user;
                    // Set the selected contact class
                    var selectedContacts = document.querySelectorAll('.contact');
                    selectedContacts.forEach(function(contact) {
                        contact.classList.remove('selected-contact');
                    });
                    target.classList.add('selected-contact');

                    displayConversation(user);
                    // Hide contacts and show conversation
                    contactsContainer.style.display = "none";
                    conversationContainer.style.display = "block";
                    // Show the input field for sending messages
                    inputContainer.classList.remove("hidden");
                    // Hide the input field for adding a new contact
                    newContactContainer.classList.add("hidden");
                    // Show the back button
                    backButton.classList.remove("hidden");
                }
            });

            // Function to handle going back to the list of contacts
            function goBack() {
                contactsContainer.style.display = "block";
                conversationContainer.style.display = "none";
                inputContainer.classList.add("hidden");
                backButton.classList.add("hidden");
                // Show the input field for adding a new contact
                newContactContainer.classList.remove("hidden");
            }

            // Event listener for clicking the back button
            backButton.addEventListener("click", goBack);

            // Function to add a new contact
            function addContact() {
                var newContact = newContactInput.value.trim();
                if (newContact !== "") {
                    // Create a new contact element
                    var newContactElement = document.createElement("div");
                    newContactElement.textContent = newContact;
                    newContactElement.classList.add("contact");
                    newContactElement.dataset.user = newContact;
                    // Add the new contact to the contacts container
                    contactsContainer.appendChild(newContactElement);
                    // Clear the input field
                    newContactInput.value = "";
                }
            }

            // Event listener for clicking the add contact button
            addContactBtn.addEventListener("click", addContact);

            // Function to send a message
            function sendMessage() {
                var message = messageInput.value.trim();
                var selectedContact = document.querySelector(".selected-contact");
                if (message !== "" && selectedContact) {
                    var user = selectedContact.textContent.trim();
                    if (!conversations[user]) {
                        conversations[user] = [];
                    }
                    // Add the message to the conversation array for the selected user
                    conversations[user].push({ sender: "You", message: message });
                    // Update the conversation display
                    displayConversation(user);
                    // Clear the input field
                    messageInput.value = "";
                }
            }

            // Event listener for sending a message
            var sendMessageBtn = document.getElementById("sendMessageBtn");
            sendMessageBtn.addEventListener("click", sendMessage);
        });
</script>

</body>
</html>
