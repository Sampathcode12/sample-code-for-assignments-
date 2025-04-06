<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Explore Drugs</title>
  <link rel="stylesheet" href="styles.css"> <!-- Optional -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 20px;
    }

    h2 {
      text-align: center;
      margin-bottom: 40px;
    }

    .drug-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .drug-card {
      width: 200px;
      text-align: center;
    }

    .drug-card a {
      text-decoration: none;
      color: inherit;
      display: block;
    }

    .drug-image-wrapper {
      width: 200px;
      height: 200px;
      margin: 0 auto 10px;
      background-color: #fff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 20px 8px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .drug-image-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .drug-label {
      font-size: 14px;
      font-weight: 500;
    }

    .availability {
      font-size: 12px;
      color: #888;
      margin-top: 4px;
    }
  </style>
</head>
<body>

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
