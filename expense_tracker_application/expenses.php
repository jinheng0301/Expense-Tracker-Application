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

$edit_row = null; // Variable to hold row data for editing

// Check if an edit request was made
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $edit_query = "SELECT * FROM expense WHERE id='$edit_id'";
    $edit_result = $conn->query($edit_query);
    if ($edit_result->num_rows > 0) {
        $edit_row = $edit_result->fetch_assoc();
    }
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

// Update expense
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_expense'])) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $details = $_POST['details'];
    $merchant = $_POST['merchant'];
    $amount = $_POST['amount'];
    $report_month = $_POST['report_month'];
    $status = $_POST['status'];

    $sql = "UPDATE expense SET date='$date', details='$details', merchant='$merchant', amount='$amount', 
            report_month='$report_month', status='$status' WHERE id='$id'";
    $conn->query($sql);
}

// Delete expense
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM expense WHERE id='$id'";
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
            width: 90px;
            height: 120px;
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
            font-size: 18px;
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

        .edit-btn, .delete-btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }

        .edit-btn {
            background-color: #4CAF50;
        }

        .edit-btn:hover {
            background-color: #45A049;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #e31e10;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="profile">
                <img src="lengzai2.jpg" alt="Profile Picture">
                <p>Jin Heng Fam</p>
            </div>
            <nav class="menu">
                <a href="home.php">Home</a>
                <a href="expenses.php" class="active">Expenses</a>
                <a href="trips.php">Trips</a>
                <a href="budget_and_reminders.php">Budgets & Reminders</a>
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
                    <!-- Add a hidden field for updating -->
                    <input type="hidden" name="id" value="<?= isset($edit_row) ? $edit_row['id'] : '' ?>">
                    <input type="date" name="date" value="<?= isset($edit_row) ? $edit_row['date'] : '' ?>" required>
                    <input type="text" name="details" placeholder="Details" value="<?= isset($edit_row) ? $edit_row['details'] : '' ?>" required>
                    <input type="text" name="merchant" placeholder="Merchant" value="<?= isset($edit_row) ? $edit_row['merchant'] : '' ?>" required>
                    <input type="number" step="0.01" name="amount" placeholder="Amount" value="<?= isset($edit_row) ? $edit_row['amount'] : '' ?>" required>
                    <input type="text" name="report_month" placeholder="Report Month" value="<?= isset($edit_row) ? $edit_row['report_month'] : '' ?>" required>
                    <select name="status" required>
                        <option value="Tuition fee" <?= isset($edit_row) && $edit_row['status'] == 'Tuition fee' ? 'selected' : '' ?>>Tuition fee</option>
                        <option value="Assignment" <?= isset($edit_row) && $edit_row['status'] == 'Assignment' ? 'selected' : '' ?>>Assignment/Project fee</option>
                        <option value="Pocket money" <?= isset($edit_row) && $edit_row['status'] == 'Pocket money' ? 'selected' : '' ?>>Pocket money</option>
                        <option value="Entertainment" <?= isset($edit_row) && $edit_row['status'] == 'Entertainment' ? 'selected' : '' ?>>Entertainment</option>
                        <option value="Nothing" <?= isset($edit_row) && $edit_row['status'] == 'Nothing' ? 'selected' : '' ?>>Nothing to spend</option>
                    </select>
                    <?php if (isset($edit_row)): ?>
                        <button type="submit" name="update_expense">Update Expense</button>
                    <?php else: ?>
                        <button type="submit" name="add_expense">Add Expense</button>
                    <?php endif; ?>
                </form>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Merchant</th>
                        <th>Amount</th>
                        <th>Report Month</th>
                        <th>Types of expenses</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['details'] ?></td>
                            <td><?= $row['merchant'] ?></td>
                            <td>RM<?= $row['amount'] ?></td>
                            <td><?= $row['report_month'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
                                <a href="?edit_id=<?= $row['id'] ?>" class="edit-btn">Edit</a> |
                                <a href="?delete_id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this expense?')" class="delete-btn">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </section>
        </main>
    </div>

</body>

</html>
<?php $conn->close(); ?>