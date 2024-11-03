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

// Fetch recent expenses
$sql = "SELECT details, merchant, amount, status, date FROM expense ORDER BY date";
$result1 = $conn->query($sql);

// Fetch recent trips
$sql = "SELECT date, location, purpose, amount, status FROM trips ORDER BY date";
$result2 = $conn->query($sql);

// // Prepare data for JavaScript (to be used for the chart)
// $expenseData = [];
// while ($row = $result1->fetch_assoc()) {
//     $expenseData[] = [
//         'details' => $row['details'],
//         'amount' => $row['amount'],
//         'date' => $row['date']
//     ];
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home_style.css">
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

        /* Main Content Styles */
        .main-content {
            margin-left: 200px;
            flex: 1;
            padding: 20px;
            background-color: #1b1b1b;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .main-content>p {
            color: #888;
            margin-bottom: 30px;
        }

        .top-section {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .recent-trips,
        .recent-expenses {
            flex: 1;
            background-color: #2d2d2d;
            border-radius: 8px;
            padding: 20px;
        }

        .recent-trips h3,
        .recent-expenses h3 {
            color: #fff;
            margin-bottom: 15px;
            font-size: 16px;
            /* Same font size for headings */
        }

        .recent-trips table,
        .recent-expenses table {
            width: 100%;
            /* Ensure both tables take full width */
            border-collapse: collapse;
            /* Same collapsing style */
        }

        .recent-trips th,
        .recent-expenses th {
            text-align: left;
            padding: 8px;
            color: #888;
            font-weight: normal;
            font-size: 16px;
            /* Same font size for table headers */
        }

        .recent-trips td,
        .recent-expenses td {
            padding: 8px;
            color: #fff;
            font-size: 14px;
            /* Same font size for table data */
        }


        /* Quick Access Buttons */
        .quick-access {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .quick-access button {
            flex: 1;
            padding: 12px;
            background-color: #2d2d2d;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .quick-access button:hover {
            background-color: #3d3d3d;
        }

        /* Charts Section */
        .monthly-report {
            display: flex;
            gap: 20px;
        }

        .chart {
            flex: 1;
            background-color: #2d2d2d;
            border-radius: 8px;
            padding: 20px;
        }

        .chart h3 {
            color: #fff;
            margin-bottom: 15px;
            font-size: 16px;
        }

        canvas {
            width: 100%;
            height: 200px;
        }

        footer {
            margin-top: auto;
            text-align: center;
            padding: 20px 0;
        }

        footer p {
            color: #888;
            font-weight: bold;
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

        <!-- Main Content -->
        <main class="main-content">
            <h1>Welcome to the Expense Tracker</h1>
            <p>Track your expenses, set budgets, and manage your finances effectively.</p>

            <!-- Top Section -->
            <section class="top-section">
                <div class="recent-trips">
                    <!-- <h3>Pending Tasks</h3>
                    <ul>
                        <li>Pending Approvals <span>5</span></li>
                        <li>New Trips Registered <span>1</span></li>
                        <li>Unreported Expenses <span>4</span></li>
                        <li>Upcoming Expenses <span>0</span></li>
                        <li>Unreported Advances <span>RM0.00</span></li>
                    </ul> -->
                    <h3>Recent Trips</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Spent Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result2->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['date']) ?></td>
                                    <td><?= htmlspecialchars($row['location']) ?></td>
                                    <td><?= htmlspecialchars($row['purpose']) ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td>RM<?= htmlspecialchars($row['amount']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                </div>

                <div class="recent-expenses">
                    <h3>Recent Expenses</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Detail</th>
                                <th>Merchant</th>
                                <th>Types of Expense</th>
                                <th>Spent Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result1->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['date']) ?></td>
                                    <td><?= htmlspecialchars($row['details']) ?></td>
                                    <td><?= htmlspecialchars($row['merchant']) ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td>RM<?= htmlspecialchars($row['amount']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Quick Access -->
            <section class="quick-access">
                <button onclick="document.location='expenses.php'">+ New Expense</button>
                <button onclick="document.location='trips.php'">+ Create Trip</button>
                <button>+ Add Receipt</button>
                <button>+ Create Report</button>
            </section>

            <!-- Monthly Report -->
            <section class="monthly-report">
                <div class="chart">
                    <h3>Team Spending Trend</h3>
                    <canvas id="teamTrendChart"></canvas>
                </div>
                <div class="chart">
                    <h3>Day-to-Day Expenses</h3>
                    <canvas id="dailyExpensesChart"></canvas>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Convert PHP array to JavaScript for chart data
        const expenseData = <?php echo json_encode($expenseData); ?>;

        // Function to dynamically draw the bar chart
        function drawExpenseBarChart(canvasId, data) {
            const canvas = document.getElementById(canvasId);
            const ctx = canvas.getContext("2d");

            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Set canvas size
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;

            // Data extraction
            const amounts = data.map(item => item.amount);
            const labels = data.map(item => item.details);

            const barWidth = Math.floor((canvas.width - 60) / amounts.length) - 10;
            const maxValue = Math.max(...amounts);
            const scale = (canvas.height - 40) / maxValue;

            // Colors for bars
            const colors = ["#E91E63", "#9C27B0", "#3F51B5", "#2196F3", "#00BCD4"];

            // Draw bars
            amounts.forEach((value, index) => {
                const barHeight = value * scale;
                const x = 30 + (index * (barWidth + 10));
                const y = canvas.height - barHeight - 20;

                ctx.fillStyle = colors[index % colors.length];
                ctx.fillRect(x, y, barWidth, barHeight);

                // Add label below each bar
                ctx.fillStyle = "#000";
                ctx.font = "12px Arial";
                ctx.textAlign = "center";
                ctx.fillText(labels[index], x + barWidth / 2, canvas.height - 5);
            });
        }

        // Draw the chart when the page loads
        document.addEventListener("DOMContentLoaded", function() {
            drawExpenseBarChart("teamTrendChart", expenseData);
        });

        // Redraw the chart on window resize
        window.addEventListener('resize', function() {
            drawExpenseBarChart("teamTrendChart", expenseData);
        });
    </script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>