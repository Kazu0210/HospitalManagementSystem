<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservation_sys";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM apt_info");
$stmt->execute();
$result = $stmt->get_result();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/ClarificatinPage.css">
    <script src="./Scripts//Clarification.js"></script>
    <title>Hanami Hospital - Clarification</title>
</head>
<body>
    <div class="background"></div>
    <header class="header">
        <h1>Hanami Hospital</h1>
    </header>
    <h2>Clarification</h2>
    <div class="content">
        <div id="selected-method">Loading...</div>
    </div>
    <footer class="footer">
        <a href="PaymentPage.html"><button class="my-button">Back</button></a>
        <a href="End.html"><button class="my-button">Next</button></a>
    </footer>
</body>
</html>