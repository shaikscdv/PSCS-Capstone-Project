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

// Fetch users from the database
$sql = "SELECT * FROM  data_analytics_reporting";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store users in an array
    $users = [];
    while($row = $result->fetch_assoc()) {
        $blog_posts [] = $row;
    }
} else {
    $users = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>
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
            font-size: 1.6rem;
            margin-bottom: 10px;
            font-weight: bold;
            padding-bottom: 8px;
            border-bottom: 2px solid #fff; /* Add a dividing line for clarity */
        }

        .user-container p {
            font-size: 1.1rem;
            margin: 8px 0;
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
        <h3>data_analytics_reporting List</h3>

        <!-- Wrapper for the user containers -->
        <div class="user-list-container">
            <?php if (count($blog_posts ) > 0): ?>
                <?php foreach ($blog_posts  as $user): ?>
                    <div class="user-container">
                        <h4><?php echo htmlspecialchars($user['report_title']); ?></h4>
                        <p><strong>Type:</strong> <?php echo htmlspecialchars($user['report_type']); ?></p>
                        <p><strong>date:</strong> <?php echo htmlspecialchars($user['created_date']); ?></p>
                        <p><strong>status:</strong> <?php echo htmlspecialchars($user['status']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No users found.</p>
            <?php endif; ?>
        </div>

    </div>

    <div class="footer">
        <p>&copy; 2024 CraftCove. All rights reserved.</p>
    </div>

</body>
</html>
