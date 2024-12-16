<?php
include('connect.php');


$sql = "SELECT * FROM user";  // Replace 'users' with your table name
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
    function openEditModal(id, name, gender, phone, email, class_name, registration_number) {
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editGender').value = gender;
        document.getElementById('editPhone').value = phone;
        document.getElementById('editEmail').value = email;
        document.getElementById('editClass').value = class_name;
        document.getElementById('editRegistration').value = registration_number;

        // Bootstrap 5 Modal API
        var myModal = new bootstrap.Modal(document.getElementById('editModal'));
        myModal.show();
    }

    function openDeleteModal(id) {
        document.getElementById('deleteId').value = id;
        var myDeleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        myDeleteModal.show();
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
                  
                    <td>
                        <button class="btn btn-primary" onclick="openEditModal(
                            '<?php echo $row['id']; ?>',
                            '<?php echo $row['name']; ?>',
                            '<?php echo $row['gender']; ?>',
                            '<?php echo $row['phone']; ?>',
                            '<?php echo $row['email']; ?>',
                            '<?php echo $row['class']; ?>',
                            '<?php echo $row['registration_number']; ?>',
                            
                        )">Edit</button>
                        <button class="btn btn-danger" onclick="openDeleteModal('<?php echo $row['id']; ?>')">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="user_edit.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editGender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="editGender" name="gender" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="editPhone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editClass" class="form-label">Class</label>
                        <input type="text" class="form-control" id="editClass" name="class" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRegistration" class="form-label">Registration Number</label>
                        <input type="text" class="form-control" id="editRegistration" name="registration_number" required>
                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="delete_user.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="deleteId" name="id">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
