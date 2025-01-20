<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "root"; // Update your DB password
$dbname = "finalyear"; // Use your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ''; // To store success or failure message

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $store_name = $_POST['store_name'];
    $offer_percentage = $_POST['offer_percentage'];
    $offer_timeline = $_POST['offer_timeline'];

    // Insert the offer into the database
    $sql = "INSERT INTO offers (store_name, offer_percentage, offer_timeline) 
            VALUES ('$store_name', '$offer_percentage', '$offer_timeline')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='success-message'>Offer added successfully!</div>";
    } else {
        $message = "<div class='error-message'>Error: " . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Offer</title>
    <style>
        /* Blue Ridge theme styling */
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
        .form-container input[type="date"] {
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

        /* Success and Error Messages */
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
        .blog2{
        margin-top: 10px;
    }
    </style>
</head>
<body>

<div class="form-container">
    <h2>New Offer Form</h2>

    <?php echo $message; ?> <!-- Display success or error message -->

    <form action="snewoffers.php" method="POST">
        <label for="store_name">Store Name</label>
        <input type="text" id="store_name" name="store_name" placeholder="Enter store name" required>

        <label for="offer_percentage">Offer Percentage (%)</label>
        <input type="number" id="offer_percentage" name="offer_percentage" placeholder="Enter offer percentage" step="0.01" required>

        <label for="offer_timeline">Offer Timeline</label>
        <input type="date" id="offer_timeline" name="offer_timeline" required>

        <button type="submit">Submit Offer</button>
        <button type="submit" class="blog2" action="sdash.php">dashboard</button>
    </form>
</div>

</body>
</html>
