<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function calculateCopyCost(
        $unit_price,
        $amount_used_in_advertisement,
        $unit_cost,
        $fixed_cost
    ) {
        $units_sold = 0.5 * $amount_used_in_advertisement;

        $income = $units_sold * $unit_price;

        $expenses = $unit_cost * $units_sold + $fixed_cost;

        $profit = $income - $expenses;

        echo "Unit Price: $" . $unit_price . "<br />";
        echo "Amount Used in Advertisement: $" . $amount_used_in_advertisement . "<br />";
        echo "Unit Cost: $" . $unit_cost . "<br />";
        echo "Fixed Cost: $" . $fixed_cost . "<br />";
        echo "Units Sold: " . $units_sold . "<br />";
        echo "Income: $" . $income . "<br />";
        echo "Expenses: $" . $expenses . "<br />";
        echo "Profit: $" . $profit . "<br />";
    }

    calculateCopyCost(20, 45, 15, 100);
    ?>
</body>

</html>