<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function celsiusToFahrenheit($celsius){
        return ($celsius * 9 / 5) + 32;
    }

    function fahrenheitToCelsius($fahrenheit){
        return ($fahrenheit - 32) * 5 / 9;
    }

    echo "Temperature Conversion\n";
    echo "1. Fahrenheit to Celsius\n";
    echo "2. Celsius to Fahrenheit\n";
    $choice = readline("Enter your choice (1 / 2): ");

    if ($choice == '1') {
        $fahrenheit = readline("Enter temperature in Fahrenheit: ");
        $celsius = fahrenheitToCelsius($fahrenheit);
        echo "Temperature in Celsius: " . number_format($celsius, 2) . "°C\n";
        echo "Conversion: $fahrenheit = " . number_format($celsius, 2) . "°C\n";
    } elseif ($choice == '2') {
        $celsius = readline("Enter temperature in Celsius: ");
        $fahrenheit = celsiusToFahrenheit($celsius);
        echo "Temperature in Fahrenheit: " . number_format($fahrenheit, 2) . "°F\n";
        echo "Conversion: $celsius = " . number_format($fahrenheit, 2) . "°F\n";
    } else {
        echo "Choose again. There are only 1 and 2 selection can be selected.\n";
    }
    ?>
</body>

</html>