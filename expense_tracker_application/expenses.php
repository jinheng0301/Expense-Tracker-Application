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

// Insert new expense
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_expense'])) {
    $date = $_POST['date'];
    $details = $_POST['details'];
    $merchant = $_POST['merchant'];
    $amount = $_POST['amount'];
    $report_month = $_POST['report_month'];
    $status = $_POST['status'];

    $sql = "INSERT INTO expense (date, details, merchant, amount, report_month, status) 
            VALUES ('$date', '$details', '$merchant', '$amount', '$report_month', '$status')";
    $conn->query($sql);
}

// Fetch expenses
$sql = "SELECT * FROM expense";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Expenses</title>
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

        <!--Main Content-->
        <main class="main-content">
            <section class="top-section">
                <h1>Expenses</h1>
                <form method="POST">
                    <input type="date" name="date" required>
                    <input type="text" name="details" placeholder="Details" required>
                    <input type="text" name="merchant" placeholder="Merchant" required>
                    <input type="number" step="0.01" name="amount" placeholder="Amount" required>
                    <input type="text" name="report_month" placeholder="Report Month" required>
                    <select name="status">
                        <option value="Not Submitted">Not Submitted</option>
                        <option value="Submitted">Submitted</option>
                    </select>
                    <button type="submit" name="add_expense">Add Expense</button>
                </form>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Merchant</th>
                        <th>Amount</th>
                        <th>Report Month</th>
                        <th>Status</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['details'] ?></td>
                            <td><?= $row['merchant'] ?></td>
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