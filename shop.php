<?php
// Sample PHP Code for a DC Comics-inspired merchandise shop page

// Dummy data for products (static array)
$products = [
    ['id' => 1, 'name' => 'Batman Statue', 'price' => 79.99, 'image' => 'path/to/batman-statue.jpg', 'category' => 'Statues'],
    ['id' => 2, 'name' => 'Superman Poster', 'price' => 19.99, 'image' => 'path/to/superman-poster.jpg', 'category' => 'Posters'],
    ['id' => 3, 'name' => 'Wonder Woman Comic Book', 'price' => 14.99, 'image' => 'path/to/wonderwoman-comic.jpg', 'category' => 'Comics'],
    ['id' => 4, 'name' => 'Flash T-Shirt', 'price' => 24.99, 'image' => 'path/to/flash-tshirt.jpg', 'category' => 'Clothes'],
    // Add more products as needed...
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DC Comics Merchandise Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1e1e1e; /* Dark background for a comic feel */
            color: #ffffff; /* White text for contrast */
        }
        header {
            background-color: #0056b3; /* DC Comics Blue */
            padding: 20px 0;
            text-align: center;
        }
        header h1 {
            font-size: 32px;
            margin: 0;
            font-weight: 700;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #282828; /* Slightly lighter background for contrast */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        .filter {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .filter select {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
            background-color: #343a40; /* Darker background for dropdown */
            color: #ffffff;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .product {
            border: 1px solid #444;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            background-color: #3a3a3a; /* Dark gray background for product card */
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }
        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.8);
        }
        .product img {
            width: 100%;
            height: auto;
            transition: transform 0.3s;
        }
        .product img:hover {
            transform: scale(1.05);
        }
        .product h2 {
            font-size: 18px;
            margin: 10px 0;
            color: #eaeaea;
        }
        .product p {
            font-size: 16px;
            margin: 5px 0;
            color: #cccccc;
        }
        .product .price {
            font-weight: bold;
            font-size: 20px;
            color: #ffcc00; /* Gold color for price */
        }
        .product button {
            background-color: #ff5722; /* Bright action color */
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
            margin-bottom: 10px;
        }
        .product button:hover {
            background-color: #e64a19; /* Darker shade on hover */
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<header>
    <h1>DC Comics Merchandise Shop</h1>
</header>

<div class="container">
    <div class="filter">
        <div>
            <label for="category">Filter by Category:</label>
            <select id="category">
                <option value="all">All</option>
                <option value="statues">Statues</option>
                <option value="posters">Posters</option>
                <option value="comics">Comics</option>
                <option value="clothes">Clothes</option>
            </select>
        </div>
        <div>
            <label for="sort">Sort by:</label>
            <select id="sort">
                <option value="popular">Most Popular</option>
                <option value="price_low">Price: Low to High</option>
                <option value="price_high">Price: High to Low</option>
            </select>
        </div>
    </div>

    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h2><?php echo $product['name']; ?></h2>
                <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                <button>Add to Cart</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
