<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker Home</title>
    <link rel="stylesheet" href="home_style.css">
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
            <!-- Pending Tasks and Recent Expenses -->
            <section class="top-section">
                <div class="pending-tasks">
                    <h3>Pending Tasks</h3>
                    <ul>
                        <li>Pending Approvals: <span>5</span></li>
                        <li>New Trips Registered: <span>1</span></li>
                        <li>Unreported Expenses: <span>4</span></li>
                        <li>Upcoming Expenses: <span>0</span></li>
                        <li>Unreported Advances: <span>€0.00</span></li>
                    </ul>
                </div>
                <div class="recent-expenses">
                    <h3>Recent Expenses</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Employee</th>
                                <th>Team</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Office Supplies</td>
                                <td>John Smith</td>
                                <td>Marketing</td>
                                <td>€150.00</td>
                            </tr>
                            <tr>
                                <td>Business Lunch</td>
                                <td>Sarah Jade</td>
                                <td>Sales</td>
                                <td>€75.50</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Quick Access -->
            <section class="quick-access">
                <button>+ New Expense</button>
                <button>+ Add Receipt</button>
                <button>+ Create Report</button>
                <button>+ Create Trip</button>
            </section>

            <!-- Monthly Report -->
            <section class="monthly-report">
                <div class="chart">
                    <h3>Team Spending Trend</h3>
                    <!-- Placeholder for Chart -->
                    <canvas id="teamTrendChart"></canvas>
                </div>
                <div class="chart">
                    <h3>Day-to-Day Expenses</h3>
                    <!-- Placeholder for Chart -->
                    <canvas id="dailyExpensesChart"></canvas>
                </div>
            </section>
        </main>
    </div>
    <script>
        // JavaScript code for generating simple bar charts on Canvas

        function drawSimpleBarChart(canvasId, data, colors) {
            const canvas = document.getElementById(canvasId);
            if (canvas.getContext) {
                const ctx = canvas.getContext("2d");
                const width = 50;
                const x = 20;
                data.forEach((value, index) => {
                    ctx.fillStyle = colors[index];
                    ctx.fillRect(x + (index * (width + 10)), canvas.height - value, width, value);
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            drawSimpleBarChart("teamTrendChart", [80, 60, 90, 70, 50, 100], ["#4CAF50", "#2196F3", "#FF9800", "#E91E63", "#9C27B0", "#00BCD4"]);
            drawSimpleBarChart("dailyExpensesChart", [100, 60, 80, 40, 20], ["#673AB7", "#3F51B5", "#FF5722", "#FFC107", "#8BC34A"]);
        });
    </script>
</body>

</html>