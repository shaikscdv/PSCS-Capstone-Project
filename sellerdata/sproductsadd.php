<?php
// Database connection
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "root";
$dbName = "finalyear";
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle image upload
if (isset($_POST["submit"])) {  // Check if the form has been submitted
    $productName = $_POST["product_name"];
    $productOwner = $_POST["product_owner"];
    $price = $_POST["price"];
    $fileName = str_replace(' ', '_', $_FILES["image"]["name"]);
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    $tempName = $_FILES["image"]["tmp_name"];
    $targetPath = "uploads/".$fileName;

    // Get current time for upload_time
    $uploadTime = date("Y-m-d H:i:s");

    if(in_array($ext, $allowedTypes)){
        if(move_uploaded_file($tempName, $targetPath)){
            // Insert data into database, including the upload time
            $query = "INSERT INTO products (product_name, product_owner, price, image, upload_time) 
                      VALUES ('$productName', '$productOwner', '$price', '$fileName', '$uploadTime')";
            if(mysqli_query($conn, $query)){
                header("Location: products_list.php");  // Redirect to product list page
            } else {
                echo "Something went wrong";
            }
        } else {
            echo "File is not uploaded";
        }
    } else {
        echo "Your file type is not allowed";
    }
}

// Fetch images from the database
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E5F2FA;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-container h2 {
            color: #2C3E50;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #3498DB;
            color: #FFFFFF;
            font-size: 1.1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #2980B9;
        }

        .success-message {
            color: green;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .blog2 {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Product Upload</h2>

        <!-- Upload Form -->
        <form action="sproductsadd.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="text" name="product_name" placeholder="Enter Product Name:" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="product_owner" placeholder="Enter Product Owner Name:" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="price" placeholder="Enter Price:" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="file" name="image" required>
            </div>
            <button type="submit" name="submit">Upload Product</button>
        </form>
    </div>

    <!-- Display Products (Optional) -->
    <!-- This part can be included if you want to show uploaded products directly here -->
</div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
