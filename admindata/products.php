

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Products</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F0F4F8; /* Light background */
            color: #333;
        }

        h3 {
            text-align: center;
            font-size: 2rem;
            margin-top: 50px;
            color: #2E3B4E;
        }

        /* This will apply to the container holding all the product containers to display them side by side */
        .product-container {
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap to the next line if the screen is smaller */
            justify-content: space-around; /* Distribute the items evenly */
            gap: 20px; /* Add space between the product containers */
            margin: 20px;
        }

        .product-card {
            background-color: #3A5A72; /* Blue Ridge theme color */
            color: white;
            padding: 15px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            width: 280px; /* Set fixed width for each container */
            display: flex;
            flex-direction: column; /* Keep the product data in a vertical layout inside the container */
            justify-content: space-between;
        }

        .product-card:hover {
            background-color: #4B6B7A; /* Slightly darker blue on hover */
        }

        .product-card h3 {
            font-size: 1.6rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .product-card h4 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .product-card .price {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            font-size: 1rem;
            color: #fff;
            background-color: #2A3D50;
            padding: 15px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <div>
        <h3>Product List</h3>

        <!-- Wrapper for the product containers -->
        <div class="product-container">
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "root"; // Update with your database password
            $dbname = "finalyear";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch products from the database
            $sql = "SELECT * FROM products1"; // Assuming products1 table contains product details
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Start the container for products
                while ($row = mysqli_fetch_array($result)) {
                    $product_name = $row["product_name"];
                    $product_owner = $row["product_owner"];
                    $price = $row["price"];
                    $product_image = $row["image"];
                    $imageUrl = "uploads/" . $product_image; // Get image URL

                    // Start product card
                    echo "<div class='product-card'>";
                    echo "<img src='$imageUrl' alt='$product_name'>"; // Display the product image
                    echo "<h3>$product_name</h3>"; // Product name
                    echo "<h4>Owner: $product_owner</h4>"; // Product owner
                    echo "<p class='price'>Price: $$price</p>"; // Price of the product
                    echo "</div>"; // End product card
                }
            } else {
                echo "<p>No products found.</p>"; // Message if no products exist
            }

            $conn->close();
            ?>
        </div>

    </div>

    <div class="footer">
        <p>&copy; 2024 CraftCove. All rights reserved.</p>
    </div>

</body>
</html>
