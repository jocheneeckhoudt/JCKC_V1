<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Create a message string
    $messageContent = "Name: $name\nEmail: $email\nMessage: $message\n\n";

    // Define the directory where you want to save the messages
    $directory = 'messages/';

    // Create the directory if it doesn't exist
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true); // Recursive mkdir
    }

    // Generate a unique filename based on timestamp
    $filename = $directory . 'message_' . time() . '.txt';

    // Save the message content to the file
    if (file_put_contents($filename, $messageContent) !== false) {
        echo 'Message sent successfully!';
    } else {
        echo 'Failed to send message.';
    }
}
?>