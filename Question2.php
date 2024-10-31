<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function displayProductDetails()
    {
        $product_name1 = "Tesla Model S Plaid";
        $product_price1 = 68000;
        $discount_percentage1 = 10;

        $product_name2 = "Tesla Model 3 Performance";
        $product_price2 = 46000;
        $discount_percentage2 = 20;

        $discounted_price1 = $product_price1 - ($product_price1 * $discount_percentage1) / 100;
        $discounted_price2 = $product_price2 - ($product_price2 * $discount_percentage2) / 100;

        echo "Product 1 name: " . $product_name1 . '<br>';
        echo "Original price 1: " . $product_price1 . '<br>';
        echo "Discount percentage 1: " . $discount_percentage1 . '% <br>';
        echo "Discounted price 1: " . $discounted_price1 . '<br>';

        echo "Product 2 name: " . $product_name2 . '<br>';
        echo "Original price 2: " . $product_price2 . '<br>';
        echo "Discount percentage 2: " . $discount_percentage2 . '% <br>';
        echo "Discounted price 2: " . $discounted_price2 . '<br>';
    }

    displayProductDetails();
    ?>
</body>

</html>