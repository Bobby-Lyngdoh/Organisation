<?php
session_start();
include("connect.php");
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Fetch the product from the database
    $sql = "SELECT * FROM product WHERE id = $product_id";
    $result = $connect->query($sql);
    $product = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission to update product details
        if (isset($_POST['update'])) {
            // Sanitize and retrieve form data
            $product_name = mysqli_real_escape_string($connect, $_POST['product_name']);
            $product_price = mysqli_real_escape_string($connect, $_POST['product_price']);
            $product_quantity = mysqli_real_escape_string($connect, $_POST['product_quantity']);
            $product_details = mysqli_real_escape_string($connect, $_POST['product_details']);

            // Handle image upload
            if ($_FILES['product_img']['name']) {
                $target_dir = "uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $target_file = $target_dir . basename($_FILES["product_img"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                if (getimagesize($_FILES["product_img"]["tmp_name"]) !== false) {
                    if ($_FILES["product_img"]["size"] <= 5000000) {
                        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                            if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {
                                // Update the product in the database
                                $sql = "UPDATE product SET product_name='$product_name', product_price='$product_price', 
                                        product_quantity='$product_quantity', product_details='$product_details', 
                                        product_img='$target_file' WHERE id=$product_id";
                            }
                        }
                    }
                }
            } else {
                // If no new image, just update text data
                $sql = "UPDATE product SET product_name='$product_name', product_price='$product_price', 
                        product_quantity='$product_quantity', product_details='$product_details' WHERE id=$product_id";
            }

            if ($connect->query($sql) === TRUE) {
                echo "Product updated successfully!";
                header("Location: product_edit.php");
            } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
            }
        }
        
        // Handle delete request
        if (isset($_POST['delete'])) {
            // Delete the product record from the database
            $sql = "DELETE FROM product WHERE id = $product_id";
        
            // Check if image exists and delete
            $image_path = "../product/" . $product['product_img'];
            if (file_exists($image_path)) {
                unlink($image_path); // Remove image file from server
            }
        
            if ($connect->query($sql) === TRUE) {
                echo "Product deleted successfully!";
                // header("Location: product_edit.php");
            } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
            }
        }}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Delete Product</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9f9f9;
            color: #333;
        }
        textarea {
            resize: vertical;
            min-height: 120px;
        }
        .btn-submit, .btn-delete {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
            transition: background-color 0.3s;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn-delete:hover {
            background-color: #e41e26;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Edit or Delete Product</h2>
        <form action="product_edit_function.php?id=<?php echo $product['id']; ?>" method="post" enctype="multipart/form-data">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>

            <label for="product_price">Product Price (Rs)</label>
            <input type="number" id="product_price" name="product_price" value="<?php echo $product['product_price']; ?>" required>

            <label for="product_quantity">Product Quantity</label>
            <input type="number" id="product_quantity" name="product_quantity" value="<?php echo $product['product_quantity']; ?>" required>

            <label for="product_details">Product Details</label>
            <textarea id="product_details" name="product_details" required><?php echo $product['product_details']; ?></textarea>

            <label for="product_img">Product Image</label>
            <input type="file" id="product_img" name="product_img" accept="image/*">

            <div class="btn-container">
                <button type="submit" name="update" class="btn-submit">Update Product</button>
                <button type="submit" name="delete" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete Product</button>
            </div>
        </form>
    </div>

</body>
</html>

<?php
$connect->close();
?>
