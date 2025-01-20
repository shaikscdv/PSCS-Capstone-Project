<?php
// Start the session
session_start();

// Check if the user is logged in, else redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: signin.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "root"; // Update your DB password
$dbname = "finalyear";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from the database
$email = $_SESSION['email']; // Get the logged-in user's email from the session
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the user data
    $user = $result->fetch_assoc();
} else {
    echo "No user found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Overall page styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #EAF2F8;
            flex-direction: column; /* Keeps header at the top */
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
            margin-top: 80px; /* Space for the fixed header */
        }

        /* Sidebar (left) styling */
        .sidebar {
            width: 250px;
            background-color: #2C3E50;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            height: 100vh;
        }

        .sidebar h2 {
            color: #fff;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            margin: 5px 0;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #3C77B6;
        }

        /* Main content (right) styling */
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            overflow-y: auto;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .dashboard-container h1 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2C3E50;
            margin-bottom: 20px;
        }

        .user-info {
            font-size: 1rem;
            color: #2C3E50;
            margin-bottom: 20px;
            background-color: #f7f7f7;
            padding: 15px;
            border-radius: 5px;
            width: 100%;
        }

        .logout-btn {
            padding: 12px;
            background-color: #5D9CEC;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #3C77B6;
        }

        /* Hide user info when content is loaded */
        .hide-user-info .user-info {
            display: none;
        }

        .img1 {
            width: 30px;
            height: 25px;
            margin-right: 10px;
        }

        .name {
            display: flex;
        }

        /* Header styles */
        .header {
            background: linear-gradient(90deg, #274a78, #3c5d9b);
            color: #ffffff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed; /* Fixed header at the top */
            top: 0;
            left: 0; /* Ensures it sticks to the left */
            width: 100%; /* Takes the full width of the page */
            z-index: 1000; /* Keeps it above other content */
        }

        .header .logo {
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #ffffff;
        }

        .header a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .header a:hover {
            color: #d7e2ee;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="logo">CraftCove</div>
    <div>
        <a href="http://localhost/finalyear/mainpage/Home.php">HOME</a>
        <a href="signin.php">SIGN OUT</a>
    </div>
</div>
<div class="container">
    <!-- Sidebar with navigation links -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="uproducts.php" class="sidebar-link">Products</a> <!-- Link to Products -->
        <a href="cart-items.php" class="sidebar-link">Cart Items</a> <!-- Link to Cart Items -->
        <a href="purchased-items.php" class="sidebar-link">Items Purchased</a> <!-- Link to Purchased Items -->
        <a href="unewoffers.php" class="sidebar-link">New Offers</a> <!-- Link to New Offers -->
        <a href="ublog.php" class="sidebar-link">Blogs</a> <!-- Link to Blogs -->
        <a href="ublogadd.php" class="sidebar-link">Add Blog</a> 
        <a href="uerror.php" class="sidebar-link">Error Message</a><!-- Link to Add Blog -->
    </div>

    <!-- Main content section -->
    <div class="main-content">
        <div class="dashboard-container">
            <h1>Welcome to Your Dashboard</h1>
            <p class="name"><img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="img1"/><b>Hello</b>, <?php echo $user['name']; ?></p>
           
            <!-- Dynamic content loaded via AJAX -->
            <div id="dynamic-content">
                <!-- Initial Content can go here -->
                <p>Click a link in the sidebar to view the corresponding data.</p>
            </div>
        </div>
    </div>
</div>

<script>
// Function to load content dynamically using AJAX (if desired)
function loadContent(content) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', content + '.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Hide user info section when content is loaded
            document.querySelector('.dashboard-container').classList.add('hide-user-info');
            document.getElementById('dynamic-content').innerHTML = xhr.responseText;
        } else {
            document.getElementById('dynamic-content').innerHTML = 'Error loading content.';
        }
    }
    xhr.send();
}

// Event listeners for sidebar links (only if you're using AJAX loading)
document.querySelectorAll('.sidebar-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default link behavior
        const content = this.getAttribute('href').replace('.php', ''); // Load the corresponding content page
        loadContent(content); // Load corresponding content
    });
});
</script>

</body>
</html>