<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Class Timetable</title>
</head>

<body>
    <?php
    // Define the 2D array for a weekly timetable
    $timetable = [
        'Monday' => ['Math', 'English', 'Science', 'History'],
        'Tuesday' => ['Physics', 'Chemistry', 'Math', 'Physical Education'],
        'Wednesday' => ['Biology', 'Geography', 'English', 'Art'],
        'Thursday' => ['History', 'Math', 'Science', 'Computer Science'],
        'Friday' => ['English', 'Music', 'Biology', 'Math'],
    ];

    // Display the timetable
    echo "<h2>Weekly Class Timetable</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>Day</th><th>Period 1</th><th>Period 2</th><th>Period 3</th><th>Period 4</th></tr>";

    foreach ($timetable as $day => $classes) {
        echo "<tr>";
        echo "<td><strong>$day</strong></td>";
        foreach ($classes as $class) {
            echo "<td>$class</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    ?>

</body>

</html>