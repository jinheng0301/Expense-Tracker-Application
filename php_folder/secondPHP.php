<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price calculation</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .result {
            margin-top: 20px;
        }

        .result span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    $cost_price = 100;

    $wholesale_price = $cost_price * 0.25;

    $retail_price = $wholesale_price * 0.2;

    echo "The retail price is: RM" . $retail_price
    ?>
</body>

</html>