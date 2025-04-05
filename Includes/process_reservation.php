<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "reservation_sys";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO apt_info (
    Fname, Lname, Email, Contact_num, Address, Emergency_fullname, 
    Emergency_num, Btype, Gender, Birthdate, Med_condition, 
    Reservation, payment_method, payment_details, temp
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Get form data
$fname = $_POST['Fname'];
$lname = $_POST['Lname'];
$email = $_POST['Email'];
$contact = $_POST['Contact_num'];
$address = $_POST['Address'];
$emergency_name = $_POST['Emergency_fullname'];
$emergency_num = $_POST['Emergency_num'];
$blood_type = $_POST['Btype'];
$gender = $_POST['Gender'];
$birthdate = $_POST['Birthdate'];
$med_condition = $_POST['Med_condition'];
$reservation = $_POST['Reservation'];
$payment_method = $_POST['payment-method'];
$temp_id = rand(1000, 9999);

// Handle payment details based on payment method
$payment_details = "";
switch ($payment_method) {
    case 'credit-card':
        $payment_details = json_encode([
            'card_number' => $_POST['card_number'],
            'card_holder' => $_POST['card_holder'],
            'expiry_date' => $_POST['expiry_date'],
            'cvv' => $_POST['cvv']
        ]);
        break;
    case 'paypal':
        $payment_details = json_encode(['paypal_email' => $_POST['paypal_email']]);
        break;
    case 'bank-transfer':
        $payment_details = json_encode([
            'bank_name' => $_POST['bank_name'],
            'account_number' => $_POST['account_number'],
            'routing_number' => $_POST['routing_number']
        ]);
        break;
    case 'cash':
        default:
        $payment_details = json_encode(['method' => 'cash']);
        break;
}

// Bind parameters
$stmt->bind_param("ssssssssssssssi", 
    $fname, $lname, $email, $contact, $address, $emergency_name,
    $emergency_num, $blood_type, $gender, $birthdate, $med_condition,
    $reservation, $payment_method, $payment_details, $temp_id
);

session_start();

$_SESSION['form_data'] = [
    'id' => $temp_id,
    'Fname' => $_POST['Fname'],
    'Lname' => $_POST['Lname'],
    'Email' => $_POST['Email'],
    'Contact_num' => $_POST['Contact_num'],
    'Address' => $_POST['Address'],
    'Emergency_fullname' => $_POST['Emergency_fullname'],
    'Emergency_num' => $_POST['Emergency_num'],
    'Btype' => $_POST['Btype'],
    'Birthdate' => $_POST['Birthdate'],
    'Med_condition' => $_POST['Med_condition'],
    'Reservation' => $_POST['Reservation'],
    'payment_method' => $_POST['payment-method'],
];


if ($stmt->execute()) {
    header("Location: ../ClarificationPage.php");
    exit(); 
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>