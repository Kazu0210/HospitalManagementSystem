<?php
// Check if the 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "reservation_sys";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the delete query
    $stmt = $conn->prepare("DELETE FROM apt_info WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    // Execute the delete query
    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='../admin/Admin.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    // Close the connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
