<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_tracker_app";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX for budget insertion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
    if ($_POST['action'] == 'add_budget') {
        $budget = $_POST['budget'];
        $reminder = $_POST['reminder'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Modify the SQL to insert into the combined budgets table
        $sql = "INSERT INTO budgets (amount, start_date, reminder, end_date) VALUES ('$budget', '$start_date', '$reminder', '$end_date')";
        if ($conn->query($sql)) {
            echo json_encode(['status' => 'success', 'message' => 'Budget and reminder added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add budget and reminder']);
        }
    }
    exit;
}

// Fetch budgets for initial load
$budget_results = $conn->query("SELECT * FROM budgets");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Settings</title>
    <link rel="stylesheet" href="budgets_and_reminders.css">
</head>

<body>
    <div class="container">
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

        <main class="content">
            <section class="top-section">
                <!-- Budget Settings Form -->
                <section id="budget-section">
                    <h1>Set Your Budget</h1>
                    <form id="budget-form" method="POST">
                        <label for="budget">Monthly Budget:</label>
                        <input type="number" name="budget" id="budget" required>
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" required>
                        <label for="date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" required>
                        <label for="reminder">Reminder:</label>
                        <input type="text" name="reminder" id="reminder" required>
                        <button type="submit" name="add_budget">Save Budget and Reminders</button>
                    </form>
                </section>

                <h2>Upcoming Reminders</h2>
                <div id="reminder-list">
                    <table>
                        <tr>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Budget</th>
                            <th>Reminder</th>
                        </tr>
                        <?php while ($row = $budget_results->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['start_date'] ?></td>
                                <td><?= $row['end_date'] ?></td>
                                <td><?= $row['amount'] ?></td>
                                <td><?= $row['reminder'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </section>
        </main>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const budgetForm = document.getElementById("budget-form");
                const reminderList = document.getElementById("reminder-list").querySelector("table");

                // Function to add a new row dynamically
                function addBudgetRow(startDate, budget, reminder, endDate) {
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `<td>${startDate}</td><td>${budget}</td><td>${reminder}</td><td>${endDate}</td>`;
                    reminderList.appendChild(newRow);
                }

                // AJAX for adding budget and reminder
                budgetForm.addEventListener("submit", (e) => {
                    e.preventDefault();
                    const formData = new FormData(budgetForm);
                    formData.append("ajax", true);
                    formData.append("action", "add_budget");

                    fetch("budget_and_reminders.php", {
                            method: "POST",
                            body: formData,
                        }).then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                const startDate = document.getElementById("start_date").value;
                                const endDate = document.getElementById("end_date").value;
                                const budget = document.getElementById("budget").value;
                                const reminder = document.getElementById("reminder").value;        
                                addBudgetRow(startDate, endDate, budget, reminder);
                                alert(data.message);
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => console.error("Error:", error));
                });
            });
        </script>
    </div>
</body>

</html>
<?php $conn->close(); ?>