<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLATASTIC</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("php_folder/img1.jpeg");
            background-color: #f5f5f5;
            background-repeat: no-repeat;
            background-size: cover;
        }
        header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-weight: bold;
        }
        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }
        .banner {
            text-align: center;
            margin-bottom: 40px;
        }
        .banner h1 {
            font-size: 36px;
            color: #333;
        }
        .banner p {
            font-size: 24px;
            color: #666;
        }
        .product-image {
            width: 100%;
            height: auto;
        }
        footer {
            padding: 20px;
            text-align: center;
        }
        .app-store,
        .google-play {
            display: inline-block;
            margin: 0 10px;
        }
        .social-media {
            margin-top: 20px;
        }
        .social-media img {
            width: 24px;
            height: 24px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="<?php echo 'path_to_logo.png'; ?>" alt="FLATASTIC Logo">
        </div>
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="Search">
            <button type="submit">Search</button>
        </form>
        <div class="user-profile">
            <!-- Potentially dynamic user content -->
        </div>
    </header>
    <main>
        <div class="banner">
            <h1>Seasonal Sale</h1>
            <p>Up to 70% OFF!</p>
            <a href="shop.php" class="button">Shop Now</a>
        </div>
        <div class="product-image">
            <img src="path_to_featured_product_image.png" alt="Featured Product">
        </div>
    </main>
    <footer>
        <div class="app-store">
            <a href="https://apps.apple.com/app/id123456789"><img src="app-store-badge.png" alt="App Store"></a>
        </div>
        <div class="google-play">
            <a href="https://play.google.com/store/apps/details?id=com.example.app"><img src="google-play-badge.png" alt="Google Play"></a>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/"><img src="instagram-icon.png" alt="Instagram"></a>
            <a href="https://twitter.com/"><img src="twitter-icon.png" alt="Twitter"></a>
        </div>
    </footer>
</body>
</html>
