<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    // Student information
    $studentAge = 19;
    $studentProgram = "CFIT";

    // Define the valid programs
    $validPrograms = array("CFIT", "DCSI", "DITN", "BITI", "BCSI", "MIT");

    // Check if student meets the age requirement
    if ($studentAge >= 18) {
        // Check if the program is in the list of valid programs
        if (in_array($studentProgram, $validPrograms)) {
            echo "The student is eligible to vote.\n\n";
        } else {
            echo "The student is not in a valid program.\n\n";
        }
    } else {
        echo "The student is not old enough to vote.\n\n";
    }

    function isEligibleToVote($age, $program)
    {
        $validPrograms = array("CFIT", "DCSI", "DITN", "BITI", "BCSI", "MIT");

        // Check if student meets the age requirement
        if ($age >= 18) {
            // Check if the program is in the list of valid programs
            if (in_array($program, $validPrograms)) {
                echo "The student is eligible to vote.\n\n";
            } else {
                echo "The student is not in a valid program.\n\n";
            }
        } else {
            echo "The student is not old enough to vote.\n\n";
        }
    }
    ///////////////////////////////////////////////////////////////////////

    // Set the number of copies
    $copies = 150;

    // Define the pricing scheme
    $cost = 0;

    if ($copies <= 100) {
        // For copies up to 100, charge 10 cents per copy
        $cost = $copies * 0.10;
    } else {
        // For the first 100 copies, charge 10 cents per copy
        $cost = 100 * 0.10;
        // For the additional copies beyond 100, charge 5 cents per copy
        $additionalCopies = $copies - 100;
        $cost += $additionalCopies * 0.05;
    }

    // Display the total cost
    echo "<br><br>Total cost for $copies copies is $" . number_format($cost, 2);

    function calculateCopyCost($copies)
    {
        $cost = 0;

        if ($copies <= 100) {
            // For copies up to 100, charge 10 cents per copy
            $cost = $copies * 0.10;
        } else {
            // For the first 100 copies, charge 10 cents per copy
            $cost = 100 * 0.10;
            // For the additional copies beyond 100, charge 5 cents per copy
            $additionalCopies = $copies - 100;
            $cost += $additionalCopies * 0.05;
        }

        // Display the total cost
        echo "Total cost for $copies copies is $" . number_format($cost, 2);
    }

    ///////////////////////////////////////////////////////////////////////

    // Set the current balance and the amount to withdraw
    $currentBalance = 500;  // You can change this value for testing
    $withdrawalAmount = 400;  // You can change this value for testing

    // Check if the withdrawal amount is greater than the current balance
    if ($withdrawalAmount > $currentBalance) {
        echo "<br><br>Withdrawal denied. You do not have enough balance.";
    } else {
        // Calculate the new balance
        $newBalance = $currentBalance - $withdrawalAmount;

        // Display the new balance
        echo "<br><br>Withdrawal successful. Your new balance is $" . number_format($newBalance, 2) . ".\n";

        // Check if the new balance is below $150
        if ($newBalance < 150) {
            echo "Warning: Balance below $150.";
        }
    }

    function withdrawalProcess($currentBalance, $withdrawalAmount)
    {
        if ($withdrawalAmount > $currentBalance) {
            echo "Withdrawal denied. You do not have enough balance.";
        } else {
            // Calculate the new balance
            $newBalance = $currentBalance - $withdrawalAmount;

            // Display the new balance
            echo "<br><br>Withdrawal successful. Your new balance is $" . number_format($newBalance, 2) . ".\n";

            // Check if the new balance is below $150
            if ($newBalance < 150) {
                echo "Warning: Balance below $150.";
            }
        }
    }

    ///////////////////////////////////////////////////////////////////////

    // Initial settings
    $initialBalance = 100.0;
    $annualRate = 8.0;

    // Compute monthly interest rate
    $monthlyRate = $annualRate / 1200.0;

    // Header for the table
    echo "<br><br><table border='1'>";
    echo "<tr><th>Month</th><th>Balance</th></tr>";

    // Compute balance for each month
    $currentBalance = $initialBalance;
    for ($month = 1; $month <= 12; $month++) {
        $interest = $currentBalance * $monthlyRate;
        $currentBalance += $interest;
        echo "<tr><td>" . $month . "</td><td>$" . number_format($currentBalance, 2) . "</td></tr>";
    }

    // Close the table
    echo "</table>";

    function interestTable($initialBalance, $annualRate)
    {
        // Compute monthly interest rate
        $monthlyRate = $annualRate / 1200.0;

        // Header for the table
        echo "<br><br><table border='1'>";
        echo "<tr><th>Month</th><th>Balance</th></tr>";

        // Compute balance for each month
        $currentBalance = $initialBalance;
        for ($month = 1; $month <= 12; $month++) {
            $interest = $currentBalance * $monthlyRate;
            $currentBalance += $interest;
            echo "<tr><td>" . $month . "</td><td>$" . number_format($currentBalance, 2) . "</td></tr>";
        }

        // Close the table
        echo "</table>";
    }

    ///////////////////////////////////////////////////////////////////////

    $x = 1; // Initialize the variable $x and set it to 1

    while ($x < 1000) { // Continue the loop as long as $x is less than 1000
        echo $x . "\n"; // Print the value of $x followed by a newline
        $x *= 5; // Multiply $x by 5
    }

    function exponentialGrowth($start, $factor, $limit)
    {
        $x = $start;
        $result = "";
        while ($x < $limit) {
            $result .= $x . "\n";
            $x *= $factor;
        }
        return $result;
    }


    echo "<br><br> " . isEligibleToVote(19, "CFIT");
    echo "<br><br>" . calculateCopyCost(150);
    echo "<br><br>" . withdrawalProcess(500, 400);
    echo "<br><br>" . interestTable(100.0, 8.0);
    echo "<pre>" . exponentialGrowth(1, 5, 1000) . "</pre>";

    ?>
</body>

</html>