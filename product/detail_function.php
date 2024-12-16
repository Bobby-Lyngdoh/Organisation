<?php
session_start();
include("connect.php");

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $product_name = mysqli_real_escape_string($connect, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($connect, $_POST['product_price']);
    $product_quantity = mysqli_real_escape_string($connect, $_POST['product_quantity']);
    $product_details = mysqli_real_escape_string($connect, $_POST['product_details']);

    // Handle image upload
    $target_dir = "uploads/"; // Define the uploads directory

    // Check if the uploads directory exists, if not, create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    // Define the target file path
    $target_file = $target_dir . basename($_FILES["product_img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is a valid image
    if (getimagesize($_FILES["product_img"]["tmp_name"]) !== false) {
        // Check if file already exists
        if (!file_exists($target_file)) {
            // Check file size (for example, 5MB limit)
            if ($_FILES["product_img"]["size"] <= 5000000) {
                // Allow certain file formats (e.g., JPG, PNG, JPEG, GIF)
                if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                    // Attempt to move the uploaded file
                    if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {
                        // Insert data into database
                        $sql = "INSERT INTO product (product_name, product_price, product_quantity, product_details, product_img)
                                VALUES ('$product_name', '$product_price', '$product_quantity', '$product_details', '$target_file')";

                        if ($connect->query($sql) === TRUE) {
                            echo "Product added successfully!";
                        } else {
                            echo "Error: " . $sql . "<br>" . $connect->error;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
                }
            } else {
                echo "Sorry, your file is too large.";
            }
        } else {
            echo "Sorry, file already exists.";
        }
    } else {
        echo "File is not an image.";
    }
}

$connect->close();
?>
