<?php
session_start(); // Start the session to access session data

if (!isset($_SESSION['form_data'])) {
    echo "No form data available. Please go back and fill out the form.";
    exit();
}

// Retrieve session data
$data = $_SESSION['form_data'];

// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $Email = $_POST['Email'];
    $Contact_num = $_POST['Contact_num'];
    $Address = $_POST['Address'];
    $Emergency_fullname = $_POST['Emergency_fullname'];
    $Emergency_num = $_POST['Emergency_num'];
    $Btype = $_POST['Btype'];
    $Birthdate = $_POST['Birthdate'];
    $Med_condition = $_POST['Med_condition'];
    $Reservation = $_POST['Reservation'];
    $payment_method = $_POST['payment_method'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "reservation_sys";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id']; 
    $stmt = $conn->prepare("UPDATE apt_info SET 
        Fname=?, Lname=?, Email=?, Contact_num=?, Address=?, Emergency_fullname=?, Emergency_num=?, 
        Btype=?, Birthdate=?, Med_condition=?, Reservation=?, payment_method=? 
        WHERE temp=?");

    $stmt->bind_param("ssssssssssssi", 
        $Fname, $Lname, $Email, $Contact_num, $Address, $Emergency_fullname, $Emergency_num,
        $Btype, $Birthdate, $Med_condition, $Reservation, $payment_method, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully!'); window.location.href='End.html';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/ClarificationPage.css">
    <title>Edit Appointment</title>
</head>
<body>
    <div class="background"></div>
    <header class="header">
        <h1>Hanami Hospital</h1>
    </header>
    <h2>Edit Appointment Info</h2>

    <form method="post" class="form-container">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">

        <div class="form-group">
            <label>First Name:</label><br>
            <input type="text" name="Fname" value="<?php echo htmlspecialchars($data['Fname']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Last Name:</label><br>
            <input type="text" name="Lname" value="<?php echo htmlspecialchars($data['Lname']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Email:</label><br>
            <input type="email" name="Email" value="<?php echo htmlspecialchars($data['Email']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Contact Number:</label><br>
            <input type="text" name="Contact_num" value="<?php echo htmlspecialchars($data['Contact_num']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Address:</label><br>
            <input type="text" name="Address" value="<?php echo htmlspecialchars($data['Address']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Emergency Contact Name:</label><br>
            <input type="text" name="Emergency_fullname" value="<?php echo htmlspecialchars($data['Emergency_fullname']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Emergency Contact Number:</label><br>
            <input type="text" name="Emergency_num" value="<?php echo htmlspecialchars($data['Emergency_num']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Blood Type:</label><br>
            <input type="text" name="Btype" value="<?php echo htmlspecialchars($data['Btype']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Birthdate:</label><br>
            <input type="date" name="Birthdate" value="<?php echo htmlspecialchars($data['Birthdate']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Medical Condition:</label><br>
            <input type="text" name="Med_condition" value="<?php echo htmlspecialchars($data['Med_condition']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Reservation Date:</label><br>
            <input type="date" name="Reservation" value="<?php echo htmlspecialchars($data['Reservation']); ?>" required><br><br>
        </div>

        <div class="form-group">
            <label>Payment Method:</label><br>
            <select name="payment_method" required>
                <option value="credit-card" <?php echo ($data['payment_method'] == 'credit-card') ? 'selected' : ''; ?>>Credit Card</option>
                <option value="paypal" <?php echo ($data['payment_method'] == 'paypal') ? 'selected' : ''; ?>>PayPal</option>
                <option value="bank-transfer" <?php echo ($data['payment_method'] == 'bank-transfer') ? 'selected' : ''; ?>>Bank Transfer</option>
                <option value="cash" <?php echo ($data['payment_method'] == 'cash') ? 'selected' : ''; ?>>Cash</option>
            </select><br><br>
        </div>

        <button type="submit" class="submit-btn">Update</button>
    </form>

    <footer class="footer">
        <button class="my-button" id="back-button">Back</button>
    </footer>

    <script>
        document.getElementById('back-button').addEventListener('click', function() {
            window.location.href = 'zMainPage.html';
        })
    </script>
</body>
</html>
