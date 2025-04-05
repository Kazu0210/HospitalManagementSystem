<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservation_sys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM apt_info WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else {
    echo "No ID provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['Fname'];
    $lname = $_POST['Lname'];
    $email = $_POST['Email'];
    $contact_num = $_POST['Contact_num'];
    $address = $_POST['Address'];
    $emergency_fullname = $_POST['Emergency_fullname'];
    $emergency_num = $_POST['Emergency_num'];
    $btype = $_POST['Btype'];
    $gender = $_POST['Gender'];
    $birthdate = $_POST['Birthdate'];
    $med_condition = $_POST['Med_condition'];
    $reservation = $_POST['Reservation'];
    $payment_method = $_POST['payment_method'];

    $update_stmt = $conn->prepare("UPDATE apt_info SET Fname=?, Lname=?, Email=?, Contact_num=?, Address=?, Emergency_fullname=?, Emergency_num=?, Btype=?, Gender=?, Birthdate=?, Med_condition=?, Reservation=?, payment_method=? WHERE id=?");
    $update_stmt->bind_param("sssssssssssssi", $fname, $lname, $email, $contact_num, $address, $emergency_fullname, $emergency_num, $btype, $gender, $birthdate, $med_condition, $reservation, $payment_method, $id);

    if ($update_stmt->execute()) {
        ?>
        <script>
            alert('Record updated Successfully.');  
            window.location.href = "Admin.php";
        </script>
        <?php
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/AdminPage.css">
    <title>Edit Information</title>
</head>
<body>
    <div class="background"></div>
    <header class="header">
        <h1>Hanami Hospital</h1>
    </header>

    <h2>Edit Information</h2>

    <form method="POST">
        <div class="form-group">
            <label for="Fname">First Name:</label>
            <input type="text" name="Fname" id="Fname" value="<?= htmlspecialchars($row['Fname']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Lname">Last Name:</label>
            <input type="text" name="Lname" id="Lname" value="<?= htmlspecialchars($row['Lname']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Email">Email:</label>
            <input type="email" name="Email" id="Email" value="<?= htmlspecialchars($row['Email']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Contact_num">Contact Number:</label>
            <input type="text" name="Contact_num" id="Contact_num" value="<?= htmlspecialchars($row['Contact_num']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Address">Address:</label>
            <input type="text" name="Address" id="Address" value="<?= htmlspecialchars($row['Address']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Emergency_fullname">Emergency Contact Person:</label>
            <input type="text" name="Emergency_fullname" id="Emergency_fullname" value="<?= htmlspecialchars($row['Emergency_fullname']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Emergency_num">Emergency Contact Number:</label>
            <input type="text" name="Emergency_num" id="Emergency_num" value="<?= htmlspecialchars($row['Emergency_num']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Btype">Blood Type:</label>
            <input type="text" name="Btype" id="Btype" value="<?= htmlspecialchars($row['Btype']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Gender">Gender:</label>
            <input type="text" name="Gender" id="Gender" value="<?= htmlspecialchars($row['Gender']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Birthdate">Birthdate:</label>
            <input type="date" name="Birthdate" id="Birthdate" value="<?= htmlspecialchars($row['Birthdate']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Med_condition">Medical Condition:</label>
            <input type="text" name="Med_condition" id="Med_condition" value="<?= htmlspecialchars($row['Med_condition']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Reservation">Reservation:</label>
            <input type="text" name="Reservation" id="Reservation" value="<?= htmlspecialchars($row['Reservation']) ?>" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method:</label>
            <input type="text" name="payment_method" id="payment_method" value="<?= htmlspecialchars($row['payment_method']) ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" class="my-button">Update</button>
        </div>
    </form>

    <footer class="footer">
        <button class="my-button" id="back-button">Back</button>
    </footer>

    <script>
        document.getElementById('back-button').addEventListener('click', function() {
            window.location.href = '../admin/Admin.php';
        });
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
