<?php
include('connect.php');

// If a POST request is made, update the status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update status in the database
    $sql = "UPDATE user SET status = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $status, $id);

    if ($stmt->execute()) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status";
    }

    $stmt->close();
    $connect->close();
}

// Fetch users for the table
$sql = "SELECT * FROM user";  // Replace 'user' with your table name
$result = $connect->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script>
    function toggleStatus(id, currentStatus) {
        var newStatus = (currentStatus == 0) ? 1 : 0; // Toggle status
        // Send AJAX request to update status
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "user_managament.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status == 200) {
                // After successful status update, reload the page to reflect the changes
                location.reload(); // Reload the page to get the updated data
            }
        };
        xhr.send("id=" + id + "&status=" + newStatus);
    }
    </script>

</head>
<body>

<div class="container mt-5">
    <h2>Users Table</h2>

    <!-- Table to display users -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Class</th>
                <th>Registration Number</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['class']; ?></td>
                    <td><?php echo $row['registration_number']; ?></td>
                    <td id="status-<?php echo $row['id']; ?>">
                        <?php echo ($row['status'] == 0) ? 'Active' : 'Inactive'; ?>
                    </td>
                    <td>
                        <!-- Toggle status button -->
                        <button class="btn btn-warning" id="toggle-btn-<?php echo $row['id']; ?>" 
                                onclick="toggleStatus('<?php echo $row['id']; ?>', <?php echo $row['status']; ?>)">
                            <?php echo ($row['status'] == 0) ? 'Deactivate' : 'Activate'; ?>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
