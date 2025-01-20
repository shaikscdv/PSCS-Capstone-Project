<?php
// Start the session
session_start();

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

// Delete offer if delete button is clicked
if (isset($_GET['delete'])) {
    $store_name = $_GET['delete']; // Get store_name from URL
    $store_name = $conn->real_escape_string($store_name); // Sanitize input to prevent SQL injection
    
    // Delete offer from database
    $delete_sql = "DELETE FROM offers WHERE store_name = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("s", $store_name);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Offer deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete offer.";
    }
    $stmt->close();
}

// Fetch offers from the database
$sql = "SELECT * FROM offers ORDER BY offer_timeline DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store offers in an array
    $offers = [];
    while($row = $result->fetch_assoc()) {
        $offers[] = $row;
    }
} else {
    $offers = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Offers</title>
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

        /* This will apply to the container holding all the user containers to display them side by side */
        .user-list-container {
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap to the next line if the screen is smaller */
            justify-content: space-around; /* Distribute the items evenly */
            gap: 20px; /* Add space between the user containers */
            margin: 20px;
        }

        .user-container {
            background-color: #3A5A72; /* Blue Ridge theme color */
            color: white;
            padding: 15px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            width: 280px; /* Set fixed width for each container */
            display: flex;
            flex-direction: column; /* Keep the user data in a vertical layout inside the container */
            justify-content: space-between;
        }

        .user-container:hover {
            background-color: #4B6B7A; /* Slightly darker blue on hover */
        }

        .user-container h4 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            font-weight: bold;
            padding-bottom: 8px;
            border-bottom: 2px solid #fff; /* Add a dividing line for clarity */
        }

        .user-container p {
            font-size: 1.1rem;
            margin: 10px 0;
        }

        .delete-btn {
            background-color: #E74C3C; /* Red color for delete button */
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 1rem;
        }

        .delete-btn:hover {
            background-color: #C0392B; /* Darker red when hovered */
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

        .message {
            text-align: center;
            background-color: #2C3E50;
            color: white;
            padding: 10px;
            margin: 20px;
            border-radius: 5px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    <div>
        <h3>Current Offers</h3>

        <!-- Display the message if set -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>

        <!-- Wrapper for the offer containers -->
        <div class="user-list-container">
            <?php if (count($offers) > 0): ?>
                <?php foreach ($offers as $offer): ?>
                    <div class="user-container">
                        <h4><?php echo htmlspecialchars($offer['store_name']); ?></h4>
                        <p><strong>Offer Percentage:</strong> <?php echo htmlspecialchars($offer['offer_percentage']); ?>%</p>
                        <p><strong>Offer Valid Until:</strong> <?php echo htmlspecialchars($offer['offer_timeline']); ?></p>
                        
                        <!-- Delete Button -->
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No offers available.</p>
            <?php endif; ?>
        </div>

    </div>

    <div class="footer">
        <p>&copy; 2024 CraftCove. All rights reserved.</p>
    </div>

</body>
</html>
