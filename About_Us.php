<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - Pharmacy System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #e6f2e6;
      color: #2d402d;
    }

    .container {
      max-width: 900px;
      margin: 50px auto;
      padding: 40px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(34, 139, 34, 0.2);
    }

    h1 {
      color: #228B22;
      font-size: 36px;
      margin-bottom: 10px;
    }

    h2 {
      color: #2d6b2d;
      font-size: 24px;
      margin-top: 30px;
    }

    p {
      font-size: 16px;
      line-height: 1.7;
      margin-bottom: 20px;
    }

    ul {
      padding-left: 20px;
      margin-bottom: 20px;
    }

    li {
      margin-bottom: 10px;
    }

    .social-links {
      margin-top: 10px;
    }

    .social-links a {
      text-decoration: none;
      color: #2e8b57;
      font-weight: bold;
      margin: 0 10px;
      transition: color 0.3s ease;
    }

    .social-links a:hover {
      color: #006400;
    }

    footer {
      text-align: center;
      margin-top: 40px;
      color: #5a7f5a;
      font-size: 14px;
    }

    @media (max-width: 600px) {
      .container {
        margin: 20px;
        padding: 20px;
      }

      h1 {
        font-size: 28px;
      }

      h2 {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>About Us</h1>
    <p>Welcome to our Pharmacy Management System! We are dedicated to modernizing the way pharmacies operate by providing a user-friendly and efficient platform that connects pharmacies, suppliers, and customers seamlessly.</p>

    <h2>Our Mission</h2>
    <p>To empower pharmacies with reliable digital solutions that simplify order management, inventory tracking, and customer interaction, while ensuring safe and timely access to essential medications.</p>

    <h2>What We Do</h2>
    <p>Our system offers a range of features such as:</p>
    <ul>
      <li>Online stock management</li>
      <li>Supplier integration and stock request</li>
      <li>Pharmacy login and authentication</li>
      <li>Real-time product image previews</li>
      <li>Secure data handling through a .NET backend API</li>
    </ul>

    <h2>Why Choose Us?</h2>
    <p>We prioritize user experience, security, and transparency. Our goal is to support pharmacy professionals with tools that save time and help improve patient care.</p>

    <h2>Connect with Us</h2>
    <p>Follow us on social media for the latest updates and support:</p>
    <div class="social-links">
      <a href="https://www.facebook.com/YourPharmacyPage" target="_blank">Facebook</a> |
      <a href="https://www.twitter.com/YourPharmacyPage" target="_blank">Twitter</a> |
      <a href="https://www.instagram.com/YourPharmacyPage" target="_blank">Instagram</a> |
      <a href="mailto:info@yourpharmacy.com">Email Us</a>
    </div>

    <footer>
      &copy; <?php echo date("Y"); ?> Pharmacy System. All rights reserved.
    </footer>
  </div>

</body>
</html>
