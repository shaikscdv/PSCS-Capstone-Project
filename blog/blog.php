<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root"; // Update with your DB password
$dbname = "finalyear"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT title, content, username FROM blog_posts"; // Make sure the 'username' column exists in your table
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blue Ridge Blog Layout</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Merriweather:400,300,700');
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700');

    body {
      background: #e3f2fd;
      font-family: 'Merriweather', serif;
      font-size: 16px;
      color: #3c4a63;
    }

    h1, h4 {
      font-family: 'Montserrat', sans-serif;
    }

    .row {
      padding: 50px 0;
    }

    .seperator {
      margin-bottom: 30px;
      width: 35px;
      height: 3px;
      background: #2196f3;
      border: none;
    }

    .title {
      text-align: center;
    }

    .title h1 {
      text-transform: uppercase;
      color: #1e88e5;
    }

    .title .seperator {
      margin: 0 auto 10px;
    }

    .item {
      position: relative;
      margin-bottom: 30px;
      float: left;
      width: 100%;
      -webkit-backface-visibility: hidden;
    }

    .item-in {
      background: #fff;
      padding: 40px;
      position: relative;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .item-in:hover::before {
      width: 100%;
    }

    .item-in::before {
      content: "";
      position: absolute;
      bottom: 0;
      height: 2px;
      width: 0;
      background: #1976d2;
      right: 0;
      transition: width 0.4s;
    }

    .item h4 {
      font-size: 18px;
      margin-top: 25px;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #1565c0;
    }

    .item p {
      font-size: 14px;
      color: #546e7a;
    }

    .item a {
      font-family: 'Montserrat', sans-serif;
      font-size: 12px;
      text-transform: uppercase;
      color: #1e88e5;
      margin-top: 10px;
      text-decoration: none;
    }

    .item a i {
      opacity: 0;
      padding-left: 0;
      transition: 0.4s;
      font-size: 16px;
    }

    .item a:hover i {
      padding-left: 10px;
      opacity: 1;
    }

    .item .icon {
      position: absolute;
      top: 27px;
      left: -16px;
      cursor: pointer;
    }

    .item .icon a {
      font-family: 'Merriweather', serif;
      font-size: 14px;
      font-weight: 400;
      color: #1e88e5;
    }

    .item .icon svg {
      width: 32px;
      height: 32px;
      fill: #1565c0;
    }

    .item .icon-topic {
      opacity: 0;
      padding-left: 0;
      transition: 0.4s;
    }

    .item .icon:hover .icon-topic {
      opacity: 1;
      padding-left: 10px;
    }

    @media only screen and (max-width: 768px) {
      .item .icon {
        position: relative;
        top: 0;
        left: 0;
      }
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

        .header .search-bar {
            display: flex;
            align-items: center;
        }

        .header input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            outline: none;
            transition: all 0.3s ease;
        }

        .header input[type="text"]:focus {
            border-color: #80aee0;
            box-shadow: 0 0 5px rgba(128, 174, 224, 0.7);
        }

        .header button {
            padding: 8px 15px;
            font-size: 16px;
            border: none;
            background-color: #80aee0;
            color: white;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
            transition: background-color 0.3s ease;
        }

        .header button:hover {
            background-color: #5f90c2;
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
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            height: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative; /* To position the username in the top-right corner */
        }

        .username {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            color: #888;
        }

        .title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0056b3;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .separator {
            width: 1000px;
            height: 2px;
            background-color: #0056b3;
            margin: 8px 0;
        }

        .content {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
        }
  </style>
</head>
<body>
<div class="header">
    <div class="logo">KALAKRITI</div>
   
    <div>
        <a href="blog.php">BLOG</a>
       <a href="http://localhost/finalyear/mainpage/Home.php">HOME </a>
       
    </div>
</div>

 <div class="container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="item">
                    <div class="username">Posted by: <?php echo $row['username']; ?></div>
                    <div class="title"><?php echo $row['title']; ?></div>
                    <div class="separator"></div>
                    <div class="content"><?php echo $row['content']; ?></div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</html>
