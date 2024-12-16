<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information Form</title>
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
            background-color: #ffffff;
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

        .btn-submit {
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

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Enter Product Information</h2>
        <form action="detail_function.php" method="post" enctype="multipart/form-data">
    <label for="product_name">Product Name</label>
    <input type="text" id="product_name" name="product_name" required>

    <label for="product_price">Product Price (Rs)</label>
    <input type="number" id="product_price" name="product_price" required>

    <label for="product_quantity">Product Quantity</label>
    <input type="number" id="product_quantity" name="product_quantity" required>

    <label for="product_details">Product Details</label>
    <textarea id="product_details" name="product_details" required></textarea>

    <label for="product_img">Product Image</label>
    <input type="file" id="product_img" name="product_img" accept="image/*" required>

    <button type="submit" class="btn-submit">Submit</button>

    <a href='../display_product.php'   style="margin-left: 40%; padding:10px;">Display product </a>
</form>


       
    </div>

</body>
</html>
