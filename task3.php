<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly class timetable</title>
</head>

<body>
    <?php
    // Initialize the restaurant layout
    // 0 = empty table, 1 = reserved table
    $restaurant = [
        [0, 0, 1, 0],
        [0, 0, 0, 0],
        [1, 0, 0, 1],
        [0, 1, 0, 0]
    ];

    // Function to display the restaurant layout
    function displayLayout($restaurant)
    {
        echo "Restaurant Layout:<br>";
        echo "⬛ = Empty,  = Reserved<br>";
        foreach ($restaurant as $row) {
            foreach ($row as $table) {
                echo ($table == 0) ? "⬛" : "⬜";
            }
            echo "<br>";
        }
        echo "<br>";
    }

    // Function to reserve a table
    function reserveTable(&$restaurant, $row, $col)
    {
        if ($row < 0 || $row >= count($restaurant) || $col < 0 || $col >= count($restaurant[0])) {
            echo "Error: Invalid table number.<br>";
            return;
        }

        if ($restaurant[$row][$col] == 1) {
            echo "Sorry, table at row " . ($row + 1) . ", column " . ($col + 1) . " is already reserved.<br>";
        } else {
            $restaurant[$row][$col] = 1;
            echo "Table at row " . ($row + 1) . ", column " . ($col + 1) . " has been reserved.<br>";
        }
    }

    // Function to find an available table for a given party size
    function findAvailableTable($restaurant, $partySize)
    {
        $availableTables = [];
        for ($i = 0; $i < count($restaurant); $i++) {
            for ($j = 0; $j < count($restaurant[$i]); $j++) {
                if ($restaurant[$i][$j] == 0) {
                    $availableTables[] = [$i, $j];
                }
            }
        }

        if (empty($availableTables)) {
            echo "Sorry, no tables are available at the moment.<br>";
        } else {
            $randomTable = $availableTables[array_rand($availableTables)];
            echo "We have an available table for your party of $partySize at row " . ($randomTable[0] + 1) . ", column " . ($randomTable[1] + 1) . ".<br>";
        }
    }

    // Display initial layout
    displayLayout($restaurant);

    // Make some reservations
    reserveTable($restaurant, 0, 1);
    reserveTable($restaurant, 2, 2);
    reserveTable($restaurant, 0, 2); // This should fail as it's already reserved

    // Display updated layout
    displayLayout($restaurant);

    // Find available tables for different party sizes
    findAvailableTable($restaurant, 2);
    findAvailableTable($restaurant, 4);

    // Display final layout
    displayLayout($restaurant);
    ?>
</body>

</html>