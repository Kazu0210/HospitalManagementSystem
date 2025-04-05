<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservation_sys";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = null; // Initialize

// Get record by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM apt_info");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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

    $stmt = $conn->prepare("UPDATE apt_info SET 
        Fname=?, Lname=?, Email=?, Contact_num=?, Address=?, Emergency_fullname=?, Emergency_num=?, 
        Btype=?, Birthdate=?, Med_condition=?, Reservation=?, payment_method=? 
        WHERE id=?");

    $stmt->bind_param("ssssssssssssi", 
        $Fname, $Lname, $Email, $Contact_num, $Address, $Emergency_fullname, $Emergency_num,
        $Btype, $Birthdate, $Med_condition, $Reservation, $payment_method, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully!'); window.location.href='your-main-page.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment</title>
</head>
<body>
    <h2>Edit Appointment Info</h2>

    <?php if (isset($_GET['id']) && $data) { ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

            <label>First Name:</label><br>
            <input type="text" name="Fname" value="<?php echo htmlspecialchars($data['Fname']); ?>"><br><br>

            <label>Last Name:</label><br>
            <input type="text" name="Lname" value="<?php echo htmlspecialchars($data['Lname']); ?>"><br><br>

            <label>Email:</label><br>
            <input type="text" name="Email" value="<?php echo htmlspecialchars($data['Email']); ?>"><br><br>

            <label>Contact Number:</label><br>
            <input type="text" name="Contact_num" value="<?php echo htmlspecialchars($data['Contact_num']); ?>"><br><br>

            <label>Address:</label><br>
            <input type="text" name="Address" value="<?php echo htmlspecialchars($data['Address']); ?>"><br><br>

            <label>Emergency Contact Name:</label><br>
            <input type="text" name="Emergency_fullname" value="<?php echo htmlspecialchars($data['Emergency_fullname']); ?>"><br><br>

            <label>Emergency Contact Number:</label><br>
            <input type="text" name="Emergency_num" value="<?php echo htmlspecialchars($data['Emergency_num']); ?>"><br><br>

            <label>Blood Type:</label><br>
            <input type="text" name="Btype" value="<?php echo htmlspecialchars($data['Btype']); ?>"><br><br>

            <label>Birthdate:</label><br>
            <input type="text" name="Birthdate" value="<?php echo htmlspecialchars($data['Birthdate']); ?>"><br><br>

            <label>Medical Condition:</label><br>
            <input type="text" name="Med_condition" value="<?php echo htmlspecialchars($data['Med_condition']); ?>"><br><br>

            <label>Reservation Date:</label><br>
            <input type="text" name="Reservation" value="<?php echo htmlspecialchars($data['Reservation']); ?>"><br><br>

            <label>Payment Method:</label><br>
            <input type="text" name="payment_method" value="<?php echo htmlspecialchars($data['payment_method']); ?>"><br><br>

            <button type="submit">Update</button>
        </form>
    <?php } elseif (!isset($_GET['id'])) { ?>
        <p style="color: red;">No ID provided in the URL. Use something like: <code>edit.php?id=?</code></p>
    <?php } else { ?>
        <p style="color: red;">No record found for ID: <?php echo htmlspecialchars($_GET['id']); ?></p>
    <?php } ?>
</body>
</html>
