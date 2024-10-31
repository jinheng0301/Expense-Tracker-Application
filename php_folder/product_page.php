<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Sale</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #FF5733; /* Orange header color */
            color: white;
            padding: 20px;
            text-align: center;
        }
        main {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
        }
        .product-section {
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
        }
        .product-section img {
            max-width: 100%;
            height: auto;
        }
        .product-section h3 {
            font-weight: bold;
        }
        .product-section p {
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <h1>Flash Sale!</h1>
    </header>
    <main>
        <?php
        $products = [
            [
                'image' => 'path_to_product1_image.png',
                'name' => 'Product 1',
                'original_price' => 199.99,
                'discounted_price' => 149.99
            ],
            [
                'image' => 'path_to_product2_image.png',
                'name' => 'Product 2',
                'original_price' => 299.99,
                'discounted_price' => 199.99
            ]
            // Add more products as needed
        ];
        foreach ($products as $product):
        ?>
            <div class="product-section">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p>RM<?php echo number_format($product['original_price'], 2); ?></p>
                <p>RM<?php echo number_format($product['discounted_price'], 2); ?></p>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
