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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/AdminPage.css">
    <title>Hanami Hospital</title>
</head>
<body>
    <nav>
        <h1>Hanami Hospital</h1>
        <button type="button" class="back-btn" id="back-btn">Back</button>
    </nav>
    <h1>Admin Page</h1>
    <div class="content">
        <div class="table-list">
            <table class="table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Emergency Contact Person</th>
                        <th>Emergency Contact Number</th>
                        <th>Blood Type</th>
                        <th>Gender</th>
                        <th>Birthdate</th>
                        <th>Medical Condition</th>
                        <th>Reservation</th>
                        <th>Payment Method</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row["Fname"]) ?></td>
                                <td><?= htmlspecialchars($row["Lname"]) ?></td>
                                <td><?= htmlspecialchars($row["Email"]) ?></td>
                                <td><?= htmlspecialchars($row["Contact_num"]) ?></td>
                                <td><?= htmlspecialchars($row["Address"]) ?></td>
                                <td><?= htmlspecialchars($row["Emergency_fullname"]) ?></td>
                                <td><?= htmlspecialchars($row["Emergency_num"]) ?></td>
                                <td><?= htmlspecialchars($row["Btype"]) ?></td>
                                <td><?= htmlspecialchars($row["Gender"]) ?></td>
                                <td><?= htmlspecialchars($row["Birthdate"]) ?></td>
                                <td><?= htmlspecialchars($row["Med_condition"]) ?></td>
                                <td><?= htmlspecialchars($row["Reservation"]) ?></td>
                                <td><?= htmlspecialchars($row["payment_method"]) ?></td>
                                <td>
                                    <a class="btn-update" href="edit-info.php?id=<?= urlencode($row['id']) ?>">Update</a>
                                    <a class="btn-delete" href="delete-info.php?id=<?= urlencode($row['id']) ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="15">No data found.</td></tr>
                    <?php endif; ?>
                </tbody>
    
    
            </table>
        </div>
    </div>

    <div class="cont">
        <div id="reservations-cont"></div>
    </div>

    <script>
        document.getElementById('back-btn').addEventListener('click', function() {
            window.location.href = "main.php"
        })
    </script>  
</body>
</html>

<?php
// Close
$stmt->close();
$conn->close();
?>
