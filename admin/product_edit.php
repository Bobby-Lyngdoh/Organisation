<?php
session_start();
include("connect.php");

// Fetch all products from the database
$sql = "SELECT * FROM product";
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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
        .table-container {
            width: 80%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .btn {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            text-align: center;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
        .btn-edit:hover {
            background-color: #45a049;
        }
        .btn-delete:hover {
            background-color: #e41e26;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="table-container">
        <div class="header">
            <h2>Manage Products</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price (Rs)</th>
                    <th>Quantity</th>
                    <th>Details</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['product_name']}</td>
                                <td>{$row['product_price']}</td>
                                <td>{$row['product_quantity']}</td>
                                <td>{$row['product_details']}</td>
                                <td><img src='../product/{$row['product_img']}' alt='{$row['product_name']}' style='width: 50px;'></td>
                                <td>
                                    <a href='product_edit_function.php?id={$row['id']}' class='btn btn-edit'>Edit</a>
                                    
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
$connect->close();
?>
