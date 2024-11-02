<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_tracker_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert new trip
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_trip'])) {
    $date = $_POST['date'];
    $location = $_POST['location'];
    $purpose = $_POST['purpose'];
    $amount = $_POST['amount'];
    $report_month = $_POST['report_month'];
    $status = $_POST['status'];

    $sql = "INSERT INTO trips (date, location, purpose, amount, report_month, status) 
            VALUES ('$date', '$location', '$purpose', '$amount', '$report_month', '$status')";
    $conn->query($sql);
}

// Fetch trips
$sql = "SELECT * FROM trips";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trips</title>
    <link rel="stylesheet" href="expenses_and_trips.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="profile">
                <img src="profile.jpg" alt="Profile Picture">
                <p>Jin Heng Fam</p>
            </div>
            <nav class="menu">
                <a href="home.php" class="active">Home</a>
                <a href="expenses.php">Expenses</a>
                <a href="trips.php">Trips</a>
                <a href="budget_and_reminders.php">Budgets & Reminders</a>
                <a href="#">Support</a>
            </nav>
            <footer>
                <p>EXPENSIO</p>
            </footer>
        </aside>

        <main class="main-content">
            <section class="top-section">
                <h1>Trips</h1>
                <form method="POST">
                    <input type="date" name="date" required>
                    <input type="text" name="location" placeholder="Location" required>
                    <input type="text" name="purpose" placeholder="Purpose" required>
                    <input type="number" step="0.01" name="amount" placeholder="Amount" required>
                    <input type="text" name="report_month" placeholder="Report Month" required>
                    <select name="status">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Not Approved">Not Approved</option>
                    </select>
                    <button type="submit" name="add_trip">Add Trip</button>
                </form>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Purpose</th>
                        <th>Amount</th>
                        <th>Report Month</th>
                        <th>Status</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['location'] ?></td>
                            <td><?= $row['purpose'] ?></td>
                            <td>RM<?= $row['amount'] ?></td>
                            <td><?= $row['report_month'] ?></td>
                            <td><?= $row['status'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </section>
        </main>
    </div>
</body>

</html>
<?php $conn->close(); ?>