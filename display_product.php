  <style>


/* Style for the grid container */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Responsive grid */
    gap: 30px; /* Increased gap for more breathing space */
    padding: 40px; /* More padding around the grid */
    max-width: 1200px;
    margin: 0 auto; /* Center the grid */
}

/* Style for individual product cards */
.product-card {
    border: 1px solid #e1e1e1;
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Deeper shadow for more depth */
    background-color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover */
    overflow: hidden; /* Ensure the image and card contents stay within bounds */
}

/* Hover effect to scale the card and add shadow */
.product-card:hover {
    transform: translateY(-10px); /* Subtle lift on hover */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Enhanced shadow on hover */
}

/* Style for the product image */
.product-img {
    width: 100%; /* Ensure the image fits within the container */
    height: 200px; /* Fixed height for uniform images */
    object-fit: cover; /* Maintain aspect ratio and cover the area */
    border-radius: 12px;
    margin-bottom: 20px; /* Increased bottom margin */
}

/* Style for product name */
.product-name {
    font-size: 1.4em;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333; /* Darker color for better readability */
}

/* Style for price and quantity */
.product-price,
.product-quantity {
    font-size: 1.1em;
    margin-bottom: 12px;
    color: #333;
    font-weight: 500; /* Slightly bolder for emphasis */
}

/* Style for product details */
.product-details {
    font-size: 0.95em;
    color: #777;
    margin-top: 10px;
    line-height: 1.5; /* Increased line height for better readability */
}

/* Add a gradient background to the product card hover effect */
.product-card:hover {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(0, 0, 0, 0.05));
}

/* Style for buttons (e.g., Add to Cart, Buy Now) */
.product-card button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    font-size: 1.1em;
    margin-top: 15px;
    transition: background-color 0.3s ease;
}

.product-card button:hover {
    background-color: #0056b3;
}

/* Style for product card when in mobile view */
@media (max-width: 768px) {
    .product-grid {
        padding: 20px; /* Less padding for smaller screens */
    }

    .product-card {
        padding: 15px; /* Reduced padding for small screens */
    }
}




  </style>
  
  
  
  
  
  <?php
session_start();
include("connect.php");


// Fetch product data from the database
$sql = "SELECT id, product_name, product_price, product_quantity, product_details, product_img FROM product";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="product-grid">';
    
    // Loop through each product and display it
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<img src="product/' . $row['product_img'] . '" alt="' . $row['product_name'] . '" class="product-img">';
        echo '<h3 class="product-name">' . $row['product_name'] . '</h3>';
        echo '<p class="product-price">Price: $' . $row['product_price'] . '</p>';
        echo '<p class="product-quantity">Quantity: ' . $row['product_quantity'] . '</p>';
        echo '<p class="product-details">' . $row['product_details'] . '</p>';
        echo '</div>';
    }

    echo '</div>';
} else {
    echo "No products found.";
}

$connect->close();
?>
