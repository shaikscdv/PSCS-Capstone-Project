<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // default username for XAMPP MySQL
$password = "root"; // default password for XAMPP MySQL (empty)
$dbname = "finalyear"; // the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$messageSent = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Insert data into the database
    $sql = "INSERT INTO contact_form (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        $messageSent = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Why Choose Us?</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e3e9f2;
        }
        .why-choose-us {
            background-color: #cad3e0;
            padding: 40px 20px;
            text-align: center;
        }
        .why-choose-us h2 {
            margin: 0 0 20px;
            color: #274a78;
        }
        .why-choose-us p {
            color: #274a78;
            margin-bottom: 40px;
        }
        .features {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .feature-box {
            background-color: #9fb3cf;
            border-radius: 8px;
            padding: 20px;
            width: 280px;
            text-align: center;
        }
       
        .feature-box h3 {
            margin-bottom: 10px;
            color: #274a78;
        }
        .feature-box p {
            color: #274a78;
        }
        .about-us {
            display: flex;
            gap: 20px;
            padding: 40px 20px;
            align-items: center;
            background-color: #d7e2ee;
        }
        .about-us img {
            width: 45%;
            border-radius: 8px;
        }
        .about-us-text {
            width: 50%;
            color: #333;
        }
        .about-us-text h2 {
            color: #274a78;
            margin-bottom: 20px;
        }
        .about-us-text p {
            line-height: 1.6;
        }
        .about-us-extra {
            background-color: #c2d4e8;
            padding: 40px 20px;
            text-align: center;
        }
        .about-us-extra h2 {
            color: #213c62;
            margin-bottom: 20px;
        }
        .about-us-extra p {
            line-height: 1.8;
            color: #314b6c;
        }
        .get-in-touch {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .get-in-touch h2 {
            font-size: 24px;
            color: #274a78;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .get-in-touch p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }
        .contact-details p {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #333;
            margin: 10px 0;
        }
        .contact-details img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
        .contact-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            margin-top: 30px;
        }
        .contact-image {
            max-width: 240px;
            margin-right: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .contact-form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 350px;
        }
        .contact-form input, 
        .contact-form textarea {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
        }
        .contact-form button {
            padding: 10px;
            background-color: #274a78;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .contact-form button:hover {
            background-color: #365c8f;
        }
        @media (max-width: 768px) {
            .about-us {
                flex-direction: column;
            }
            .about-us img {
                width: 100%;
                margin-bottom: 20px;
            }
            .about-us-text {
                width: 100%;
            }
            .contact-container {
                flex-direction: column;
            }
            .contact-image {
                margin-bottom: 20px;
                max-width: 100%;
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
        /* Reset some default styles */
body, h3, p {
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Basic layout */
body {
  background-color: #f0f8ff; /* Light Blue Background */
  color: #333;
  padding: 20px;
}

.container {
  display: flex;
  justify-content: space-around;
  gap: 20px;
  padding: 40px;
  flex-wrap: wrap; /* Allow blocks to wrap on smaller screens */
}

.block {
  width: 280px;
  padding: 20px;
  border-radius: 12px;
  text-align: center;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  background-color: #ffffff;
}

.block h3 {
  font-size: 1.6em;
  margin-bottom: 15px;
  color: #1e3d58; /* Deep blue */
}

.block p {
  font-size: 1em;
  margin-bottom: 20px;
  color: #4b6b8b; /* Muted blue-gray */
}

button {
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  background-color: #5c8b8b; /* Blue Ridge Color */
  color: white;
  cursor: pointer;
  font-size: 1em;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #3a5c5c; /* Darker shade of Blue Ridge */
}

/* Specific styles for different blocks */
.admin {
  border-left: 5px solid #3a5c5c; /* Darker blue border */
  background-color: #e0eff6; /* Light blue background */
}

.user {
  border-left: 5px solid #5c8b8b; /* Medium blue border */
  background-color: #e1f3f3; /* Light teal background */
}

.seller {
  border-left: 5px solid #4f7e96; /* Muted blue border */
  background-color: #cde4f1; /* Soft blue background */
}

/* Hover effect on blocks */
.block:hover {
  transform: translateY(-10px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
  .container {
    flex-direction: column;
    align-items: center;
  }
}
.mainimg{
    width: 200px;
            height: 200px;
        
}
.marquee-container {
        background-color: #f1f1f1;
        padding: 20px;
        margin-top: 40px;
        text-align: center;
    }

    .marquee {
        display: flex;
        animation: marquee 30s linear infinite;
        justify-content: center;
        gap: 20px;
    }

    .marquee-item {
        flex: 0 0 auto;
    }

    .marquee-item a button {
        padding: 12px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #274a78;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .marquee-item a button:hover {
        background-color: #365c8f;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100%);
        }
    }
    </style>
</head>
<body>
    
<div class="header">
    <div class="logo">CraftCove</div>
   
    <div>
        <a href="http://localhost/finalyear/blog/blog.php">BLOG</a>
     
    </div>
</div>
    <!-- Why Choose Us Section -->
     <!-- Marquee Container -->
<div class="marquee-container">
    <div class="marquee">
        <div class="marquee-item">
            <a href="http://localhost/finalyear/events/events1.php" target="_blank"><button>competition 1</button></a>
        </div>
        <div class="marquee-item">
            <a href="http://localhost/finalyear/events/events2.php"  target="_blank"><button>competition 2</button></a>
        </div>
        <div class="marquee-item">
            <a href="http://localhost/finalyear/events/event3.php" target="_blank"><button>Workshop 1</button></a>
        </div>
        <div class="marquee-item">
            <a href="http://localhost/finalyear/events/event4.php" target="_blank"><button>Workshop 2</button></a>
        </div>
    </div>
</div>

    <div class="why-choose-us">
        <h2>Why Choose Us?</h2>
        <p>We offer a shared platform for the production, marketing, and sale of high-quality handicrafts products where we promote the Indian handicraft industry globally.</p>
        <div class="features">
            <div class="feature-box">
                <img src="https://cdn-icons-png.flaticon.com/512/10982/10982442.png" class="mainimg" alt="Wide Variety">
                <h3>Wide Variety</h3>
                <p>We offer a wide variety of different artifacts offered by a range of sellers.</p>
            </div>
            <div class="feature-box">
                <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/crafts-man-2854597-2376617.png" class="mainimg" alt="Rich Quality">
                <h3>Rich Quality</h3>
                <p>Feel and experience the quality of our wide range of products.</p>
            </div>
            <div class="feature-box">
                <img src="https://static.thenounproject.com/png/4786407-200.png" class="mainimg" alt="Easy Payments">
                <h3>Easy Payments</h3>
                <p>Buy the products with ease with a wide variety of different payment options.</p>
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <div class="about-us">
        <img src="https://static.vecteezy.com/system/resources/previews/020/537/815/non_2x/man-cuts-paper-with-scissors-one-line-drawing-handicraft-concept-scrapbooking-collage-handmade-craft-hobby-vector.jpg" alt="About Us">
        <div class="about-us-text">
            <h2>About Us</h2>
            <p>CraftCove is an E-commerce platform that seeks to improve the online market for small-town and rural handicrafts companies. By offering a shared platform for the production, marketing, and sale of high-quality handicrafts and products, this application seeks to promote the Indian handicraft industry globally.</p>
            <p>India's artisan legacy is both real and intangible, and when combined with its regional distinctiveness, it gives the nation a competitive worldwide advantage. With the correct assistance and a conducive business environment, the Indian craft market has the potential to grow to be a billion-dollar industry. Access to new markets will be increased by creating a systematic strategy that fosters the intrinsic worth of craft skills and creates opportunities for product design and manufacturing. In addition, as the industry develops and receives more traction, leveraging e-commerce for online visibility and operational efficiencies will show to be a crucial success factor.</p>
        </div>
    </div>

    <!-- Additional About Us Section -->
    <div class="about-us-extra">
        <h2>Our Vision</h2>
        <p>We strive to empower small-town artisans by providing them a global platform to showcase their unique, handcrafted creations. Through our commitment to innovation, sustainability, and cultural preservation, we aim to bridge the gap between traditional craftsmanship and modern e-commerce solutions, ensuring these timeless traditions thrive for future generations.</p>
    </div>
    
  <div class="container">
    <!-- Admin Block -->
    <div class="block admin">
      <h3>Admin</h3>
      <p>This is the admin block. Admin has full control over the system.</p>
      <a href="http://localhost/finalyear/admindata/alogin.php">
        <button>Admin Action</button>
      </a>
    </div>

    <!-- User Block -->
    <div class="block user">
      <h3>User</h3>
      <p>This is the user block. Users can view and interact with the content.</p>
      <a href="http://localhost/finalyear/userdata/signin.php">
        <button>User Action</button>
      </a>
    </div>

    <!-- Seller Block -->
    <div class="block seller">
      <h3>Seller</h3>
      <p>This is the seller block. Sellers can manage their products and sales.</p>
      <a href="http://localhost/finalyear/sellerdata/slogin.php">
        <button>Seller Action</button>
      </a>
    </div>
    <div class="block seller">
      <h3>Employee</h3>
      <p>This is the Employee block. Emplopyee can manage their products and sales.</p>
      <a href="http://localhost/finalyear/employeedata/esignin.php">
        <button>Emplopyee Action</button>
      </a>
    </div>
  </div>

    <!-- Get in Touch Section -->
    <div class="get-in-touch">
        <h2>GET IN TOUCH</h2>
        <p>If you have any questions or just want to get in touch, ping us via the form. We look forward to hearing from you!</p>
        <div class="contact-details">
            <p><img src="https://cdn-icons-png.flaticon.com/512/666/666162.png" alt="Email Icon"> EMAIL:Thahershaik32@gmail.com</p>
            <p><img src="https://cdn-icons-png.flaticon.com/256/5969/5969020.png" alt="Twitter Icon"> TWITTER: shop.kalakriti</p>
            <p><img src="https://cdn2.iconfinder.com/data/icons/black-white-social-media/32/instagram_online_social_media_photo-512.png" alt="Instagram Icon"> INSTAGRAM: shop.kalakriti</p>
        </div>
        <?php if ($messageSent): ?>
            <div class="success-message" style="color: green;">
                Your message has been sent successfully! We'll get back to you shortly.
            </div>
        <?php endif; ?>
        <div class="contact-container">
        <img src="https://thumbs.dreamstime.com/b/thread-spokes-hand-drawn-sketch-icon-outline-doodle-sewing-vector-illustration-print-web-mobile-infographics-isolated-113609675.jpg" alt="Get in Touch Visual" class="contact-image">
        
        <!-- Success Message Display -->
        

        <!-- Contact Form -->
        <form class="contact-form" method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="subject" placeholder="Subject">
            <textarea name="message" placeholder="Your message here..." required></textarea>
            <button type="submit">SEND MESSAGE</button>
        </form>
    </div>
    </div>
</body>
</html>
