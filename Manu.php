<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Explore Drugs - Green Layout</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background: #f4fff4;
    }

    .top-bar {
      background-color: #2e7d32;
      color: white;
      font-size: 14px;
      padding: 8px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .top-bar a {
      color: white;
      margin-left: 10px;
      text-decoration: none;
    }

    .logo-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: white;
    }

    .logo img {
      height: 60px;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 30px;
    }

    nav ul li a {
      text-decoration: none;
      color: #2e7d32;
      font-weight: bold;
      font-size: 16px;
    }

    .hero {
      background: url('pharmacy.jpg') no-repeat center center/cover;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .hero h1 {
      color: white;
      font-size: 48px;
      background-color: rgba(0, 128, 0, 0.6);
      padding: 20px 40px;
      border-radius: 10px;
    }

    h2 {
      text-align: center;
      margin: 40px 0 20px;
      color: #2e7d32;
    }

    .drug-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      padding: 0 20px 40px;
    }

    .drug-card {
      width: 220px;
      text-align: center;
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 12px;
      padding: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    .drug-card:hover {
      transform: scale(1.05);
    }

    .drug-image-wrapper {
      width: 180px;
      height: 180px;
      margin: 0 auto 10px;
      border-radius: 50%;
      overflow: hidden;
    }

    .drug-image-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .drug-label {
      font-size: 18px;
      font-weight: 600;
      color: #2e7d32;
    }

    .availability {
      font-size: 16px;
      color: #444;
      margin-top: 4px;
    }

    .social-icons {
      display: flex;
      gap: 10px;
    }

    .social-icons a {
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <div class="top-bar">
    <div>📞 011 1234567 | ✉️ info@mypharmacy.lk</div>
    <div class="social-icons">
      <a href="#">🌐</a>
      <a href="#">📘</a>
      <a href="#">🐦</a>
      <a href="#">📷</a>
    </div>
  </div>

  <div class="logo-nav">
    <div class="logo"><img src="logo.png" alt="Pharmacy Logo"></div>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Our Services</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </div>

  <div class="hero">
    <h1>Welcome to Our Pharmacy</h1>
  </div>

  <h2>Explore Available Drugs</h2>

  <div class="drug-container">
    <?php
      include 'fetch_Data.php';  
      $drugsData = fetchDrugsData();

      if (isset($drugsData['data'])) {
          foreach ($drugsData['data'] as $drug) {
              $id = $drug['druG_ID'];
              $name = $drug['druG_NAME'];
              $price = round($drug['druG_PRICE'] * 1.10, 2);
              $availability = ($drug['druG_QUANTITY'] > 0) ? "Available" : "Not Available";

              $imageSrc = "default.png";
              if (isset($drug['imagePaths']) && is_array($drug['imagePaths']) && count($drug['imagePaths']) > 0) {
                  $imageSrc = $drug['imagePaths'][0];
              }

              $encodedName = urlencode($name);
              echo "
              <div class='drug-card'>
                <a href='RequestDrugs.php?drug_id={$id}&name={$encodedName}&price={$price}'>
                  <div class='drug-image-wrapper'>
                    <img src='{$imageSrc}' alt='{$name}'>
                  </div>
                  <div class='drug-label'>{$name}</div>
                  <div class='availability'>{$availability}</div>
                  <div class='availability'>Rs. {$price}</div>
                </a>
              </div>
              ";
          }
      } else {
          echo "<p>No drugs found or invalid response.</p>";
      }
    ?>
  </div>

</body>
</html>
