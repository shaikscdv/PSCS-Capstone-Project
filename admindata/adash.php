<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <style>
    /* Basic Reset */
    body, h3, p {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    /* Layout for Admin Page */
    .container {
      display: flex;
      height: 100vh;
    }

    .left-side {
      width: 250px;
      background-color: #2c3e50;
      color: white;
      padding: 20px;
      box-sizing: border-box;
    }

    .left-side ul {
      list-style-type: none;
      padding: 0;
    }

    .left-side li {
      padding: 15px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .left-side li:hover {
      background-color: #34495e;
    }

    /* Right Side - Content Display */
    .right-side {
      flex: 1;
      background-color: #ecf0f1;
      padding: 20px;
      box-sizing: border-box;
    }

    #right-content {
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h3 {
      color: #34495e;
    }

    p {
      color: #7f8c8d;
      font-size: 1.1em;
    }

    .header {
        background: linear-gradient(90deg, #274a78, #3c5d9b);
        color: #ffffff;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
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
  <script>
    // Function to display data on the right side when a left-side option is clicked
    function displayData(page) {
      const content = document.getElementById("right-content");

      // Using AJAX to load the content of the page dynamically into the right content area
      const xhr = new XMLHttpRequest();
      xhr.open("GET", page, true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          content.innerHTML = xhr.responseText; // Inject the loaded page content into the right side
        } else {
          content.innerHTML = "<h3>Error loading content</h3>";
        }
      };
      xhr.send();
    }
  </script>
</head>
<body>
<div class="header">
    <div class="logo">CraftCove</div>
    <div>
        <a href="blog.php">BLOG</a>
        <a href="http://localhost/finalyear/mainpage/Home.php">HOME</a>
        <a href="http://localhost/finalyear/admindata/alogin.php">SIGN OUT</a>
    </div>
</div>

  <div class="container">
    <!-- Left Side Menu -->
    <div class="left-side">
      <ul>
        <li onclick="displayData('userdetails.php')">Users Data</li>
        <li onclick="displayData('condata.php')">Messages Data</li>
        <li onclick="displayData('sellers.php')">Sellers Data</li>
        <li onclick="displayData('products.php')">Products Data</li>
        <li onclick="displayData('orders.php')">Orders Data</li>
        <li onclick="displayData('competition.php')">competition Data</li>
        <li onclick="displayData('workshop.php')">Workshop Data</li>
        <li onclick="displayData('aoffers.php')">Offers Data</li>
        <li onclick="displayData('aemp.php')">Add Employees Data</li>
        <li onclick="displayData('adisemp.php')">Display Employees Data</li>
      </ul>
    </div>

    <!-- Right Side Content Area -->
    <div class="right-side">
      <div id="right-content">
        <h3>Welcome Admin</h3>
        <p>Select an option from the left side to view data.</p>
      </div>
    </div>
  </div>

</body>
</html>
