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

// Store the data in an array for JavaScript
$expenseData = [];
$expensesTableData = [];  // This will store data for the table
while ($row = $result1->fetch_assoc()) {
    $expenseData[] = [
        "details" => $row['details'],
        "amount" => $row['amount'],
        "date" => $row['date']
    ];
    $expensesTableData[] = $row;  // Copy row data to another array for table rendering
}

// Fetch recent trips data for JavaScript
$tripData = [];
$tripTableData = [];
while ($row = $result2->fetch_assoc()) {
    $tripData[] = [
        "date" => $row['date'],
        "location" => $row['location'],
        "amount" => $row['amount']
    ];
    $tripTableData[] = $row;
}
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

        .chart canvas {
            background-color: wheat;
            border-radius: 10px;
        }

        .chart h3 {
            color: #FFC107;
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        /* Updated dialog overlay style for a soft background blur effect */
        .dialog-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(5px);
            /* Adds a soft blur to the background */
            transition: opacity 0.3s ease;
            /* Fade-in effect for overlay */
        }

        /* Dialog box style with gradient background and enhanced shadow */
        .dialog-box {
            background: linear-gradient(135deg, #3f51b5, #2196f3);
            /* Gradient background */
            color: #ffffff;
            padding: 30px;
            width: 80%;
            max-width: 500px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.5);
            /* Stronger shadow for depth */
            opacity: 0;
            transform: scale(0.9);
            animation: dialogFadeIn 0.4s forwards;
            /* Scale-up animation */
        }

        /* Animation for dialog appearance */
        @keyframes dialogFadeIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Enhanced heading style */
        .dialog-box h3 {
            margin-top: 0;
            font-size: 1.5em;
            font-weight: bold;
            color: #ffeb3b;
            /* Light yellow to add contrast */
        }

        /* Button style with hover and focus effects */
        .dialog-box button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff5722;
            /* Accent color for the button */
            color: #ffffff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1em;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .dialog-box button:hover {
            background-color: #e64a19;
            /* Darker shade on hover */
            transform: scale(1.05);
            /* Slight scale-up on hover */
        }

        .dialog-box button:focus {
            outline: none;
            box-shadow: 0 0 8px rgba(255, 87, 34, 0.5);
            /* Glow effect on focus */
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
                <a href="home.php" class="active">Home</a>
                <a href="expenses.php">Expenses</a>
                <a href="trips.php">Trips</a>
                <a href="budget_and_reminders.php">Budgets & Reminders</a>
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
                            <?php foreach ($tripTableData as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['date']) ?></td>
                                    <td><?= htmlspecialchars($row['location']) ?></td>
                                    <td><?= htmlspecialchars($row['purpose']) ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td>RM<?= htmlspecialchars($row['amount']) ?></td>
                                </tr>
                            <?php endforeach; ?>
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
                            <?php foreach ($expensesTableData as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['date']) ?></td>
                                    <td><?= htmlspecialchars($row['details']) ?></td>
                                    <td><?= htmlspecialchars($row['merchant']) ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td>RM<?= htmlspecialchars($row['amount']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Quick Access -->
            <section class="quick-access">
                <button onclick="document.location='expenses.php'">+ New Expense</button>
                <button onclick="document.location='trips.php'">+ Create Trip</button>
                <button onclick="openReportDialog()">+ Create Report</button>
            </section>

            <!-- Monthly Report -->
            <section class="monthly-report">
                <div class="chart">
                    <h3>Recent trips chart</h3>
                    <canvas id="recentTripsChart"></canvas>
                </div>
                <div class="chart">
                    <h3>Expenses chart</h3>
                    <canvas id="dailyExpensesChart"></canvas>
                </div>
            </section>
        </main>
    </div>

    <!-- Report Dialog Box -->
    <div id="reportDialog" class="dialog-overlay" style="display: none;">
        <div class="dialog-box">
            <h3>Expense Summary Report</h3>
            <div id="reportContent">
                <!-- Report content will be dynamically generated -->
            </div>
            <button onclick="closeReportDialog()">Close</button>
        </div>
    </div>


    <script>
        // Convert PHP array to JavaScript for chart data
        const tripData = <?php echo json_encode($tripData); ?>;
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
            const amounts = data.map(item => parseFloat(item.amount));
            const labels = data.map(item => new Date(item.date).toLocaleDateString("en-GB"));

            // Calculate dimensions for bars
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

                // Add label below each bar (date)
                ctx.fillStyle = "#000";
                ctx.font = "12px Arial";
                ctx.textAlign = "center";
                ctx.fillText(labels[index], x + barWidth / 2, canvas.height - 5);

                // Display amount at the top of each bar
                ctx.fillText("RM" + value, x + barWidth / 2, y - 5);
            });
        }

        function drawTripBarChart(canvasId, data) {
            const canvas = document.getElementById(canvasId);
            const ctx = canvas.getContext("2d");

            // Clear previous drawings
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Resize canvas to its container
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;

            // Extract amounts and labels
            const amounts = data.map(item => parseFloat(item.amount));
            const labels = data.map(item => item.location);

            // Bar width and scale calculations
            const barWidth = Math.floor((canvas.width - 60) / amounts.length) - 10;
            const maxValue = Math.max(...amounts) || 1; // Prevent division by zero
            const scale = (canvas.height - 40) / maxValue;

            // Colors for bars
            const colors = ["#FF5722", "#FF9800", "#FFC107", "#FFEB3B", "#CDDC39"];

            // Draw each bar
            amounts.forEach((value, index) => {
                const barHeight = value * scale;
                const x = 30 + (index * (barWidth + 10));
                const y = canvas.height - barHeight - 20;

                // Create gradient for each bar
                const gradient = ctx.createLinearGradient(x, y, x, y + barHeight);
                gradient.addColorStop(0, colors[index % colors.length]);
                gradient.addColorStop(1, colors[(index + 1) % colors.length]);

                ctx.fillStyle = gradient;
                ctx.fillRect(x, y, barWidth, barHeight);

                // Labels below each bar
                ctx.fillStyle = "#000";
                ctx.font = "12px Arial";
                ctx.textAlign = "center";
                ctx.fillText(labels[index], x + barWidth / 2, canvas.height - 5);

                // Display amount at top of each bar
                ctx.fillText("RM" + value, x + barWidth / 2, y - 5);
            });
        }

        function openReportDialog() {
            // Populate the report with summary data
            const reportContent = document.getElementById('reportContent');

            // Calculate total expenses and number of categories
            let totalAmount = expenseData.reduce((sum, item) => sum + parseFloat(item.amount), 0);
            let categories = {};
            expenseData.forEach(item => {
                if (!categories[item.details]) {
                    categories[item.details] = 0;
                }
                categories[item.details] += parseFloat(item.amount);
            });

            // Generate the HTML content
            let contentHtml = `<p><strong>Total Expenses:</strong> RM${totalAmount.toFixed(2)}</p>`;
            contentHtml += `<h4>Expenses by Category:</h4><ul>`;
            for (const category in categories) {
                contentHtml += `<li>${category}: RM${categories[category].toFixed(2)}</li>`;
            }
            contentHtml += `</ul>`;

            // Insert the content into the dialog
            reportContent.innerHTML = contentHtml;

            // Show the dialog
            document.getElementById('reportDialog').style.display = 'flex';
        }

        function closeReportDialog() {
            document.getElementById('reportDialog').style.display = 'none';
        }


        // Draw the charts when the page loads
        document.addEventListener("DOMContentLoaded", function() {
            drawExpenseBarChart("dailyExpensesChart", expenseData);
            drawTripBarChart("recentTripsChart", tripData);
        });

        // Redraw the charts on window resize
        window.addEventListener('resize', function() {
            drawExpenseBarChart("dailyExpensesChart", expenseData);
            drawTripBarChart("recentTripsChart", tripData);
        });
    </script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>