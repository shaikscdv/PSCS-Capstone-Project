<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Updated CSS here (from above) */
        body {
    font-family: Arial, sans-serif;
    background-color: #E5F2FA;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 15px; /* Padding to prevent content from touching the edges */
}

/* Link Style */
a {
    text-decoration: none;
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    border-radius: 5px;
    margin-bottom: 20px;
    display: inline-block;
    font-size: 1.2rem;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #0056b3;
}

/* Product Display Container using Flexbox */
.product-container {
    display: flex;
    flex-wrap: wrap; /* Ensures items wrap onto the next line when necessary */
    justify-content: space-between; /* Distribute items evenly */
    gap: 20px; /* Space between items */
    margin-top: 20px;
}

/* Individual Product Card */
.product-card {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    flex: 1 1 280px; /* Allow cards to grow/shrink but maintain a minimum width */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
}

.product-card img {
    width: 100%; /* Ensure image fills the width of the card */
    height: 200px; /* Fixed height for consistency */
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

.product-card h3 {
    color: #2C3E50;
    font-size: 1.4rem;
    margin-bottom: 10px;
}

.product-card h4 {
    color: #7F8C8D;
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.product-card .price {
    color: #3498DB;
    font-size: 1.3rem;
    font-weight: bold;
}

/* Footer for the Dashboard link */
.footer-link {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #007BFF;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.2rem;
}

.footer-link:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>

    <a href="create.php">Add New</a> <!-- Button to add new product -->

    <div class="container">
        <?php
        include_once("connect.php");
        $query = "SELECT * FROM products1";
        $result = mysqli_query($conn, $query);

        // Check if the query returned any results
        if ($result->num_rows > 0) {
            echo "<div class='product-container'>"; // Start the grid container for products
            while ($row = mysqli_fetch_array($result)) {
                $product_name = $row["product_name"];
                $product_owner = $row["product_owner"];
                $price = $row["price"];
                $product_image = $row["image"];
                $imageUrl = "uploads/" . $product_image;

                // Product card
                echo "<div class='product-card'>";
                echo "<img src='$imageUrl' alt='$product_name'>";
                echo "<h3>$product_name</h3>";
                echo "<h4>Owner: $product_owner</h4>";
                echo "<p class='price'>Price: $$price</p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>No products found.</p>";
        }

        // Dashboard link as footer
        echo '<a href="sdash.php" class="footer-link">Go to Dashboard</a>';
        ?>

    </div>

</body>
</html>
