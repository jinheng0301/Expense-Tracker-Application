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
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #1b1b1b;
            color: #FFFFFF;
        }

        .container {
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 200px;
            background-color: #1b1b1b;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            overflow-y: auto;
            position: fixed;
            border-right: 1px solid #333;
        }

        .profile {
            text-align: left;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 20px;
            border-bottom: 1px solid #333;
        }

        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #888;
            transition: transform 0.3s;
        }

        .profile img:hover {
            transform: scale(1.1);
        }

        .menu a {
            display: block;
            padding: 12px 15px;
            color: #a5c9ff;
            text-decoration: none;
            margin: 5px 0;
            border-radius: 5px;
            font-size: 14px;
            transition: background 0.3s, color 0.3s;
        }

        .menu a.active {
            background-color: #2d2d2d;
            color: #fff;
        }

        .menu a:hover {
            background-color: #2d2d2d;
        }

        .footer {
            text-align: center;
            color: #888;
            font-weight: bold;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 200px;
            flex: 1;
            padding: 20px;
            background-color: #1b1b1b;
        }

        h1 {
            font-size: 24px;
            color: #00C6FF;
            text-align: center;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        input,
        select,
        button {
            padding: 10px;
            border-radius: 10px;
            border: none;
        }

        button {
            background-color: #00C6FF;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #00A5D6;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        th {
            background-color: #2d2d2d;
            color: #888;
            font-weight: normal;
            font-size: 20px;
        }

        td {
            color: #fff;
            font-size: 19px;
        }

        tr:hover {
            background-color: #333;
        }

        /* Footer Styling */
        footer {
            text-align: center;
            color: #888;
            font-weight: bold;
            padding: 20px 0;
        }
    </style>
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