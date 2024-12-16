<!DOCTYPE html>
<html>
<head>
<style>
/* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    color: #495057;
    margin: 0;
    padding: 0;
}

/* Navigation Bar */
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #007BFF; /* Blue background */
    overflow: hidden;
    border-bottom: 3px solid #0056b3;
    display: flex;
    justify-content: center; /* Centering links */
}

li {
    margin: 0 15px;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
    font-size: 1.1em;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

li a:hover {
    background-color: #0056b3; /* Darker blue */
    transform: scale(1.05); /* Slight zoom effect on hover */
}

li a:active {
    background-color: #004085; /* Even darker blue for active link */
}

/* Main Content Container */
.container {
    width: 90%;
    max-width: 1100px;
    margin: 50px auto;
    padding: 40px;
    background-color: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

/* Header and Profile Information */
h1 {
    font-size: 2.6em;
    color: #007BFF;
    margin-bottom: 20px;
    font-weight: bold;
}

h2 {
    color: #333;
    margin-top: 30px;
    border-bottom: 2px solid #007BFF;
    padding-bottom: 10px;
    font-size: 1.5em;
}

p {
    font-size: 1.1em;
    line-height: 1.8;
    margin: 10px 0;
}

strong {
    color: #555;
}

/* Profile Image */
.profile-img {
    margin-top: 20px;
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
}

/* Button Container for Logout and Edit */
.button-container {
    margin-top: 30px;
    display: flex;
    gap: 15px;
}

.button-container input {
    padding: 12px 24px;
    font-size: 1.1em;
    cursor: pointer;
    margin: 10px 5px;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    background-color: #007BFF;
    color: white;
}

.button-container input:hover {
    background-color: #0056b3;
}

/* Logout Button */
.logout-btn {
    background-color: #DC3545; /* Red for logout */
}

.logout-btn:hover {
    background-color: #C82333;
}

/* Links (for example, the register products link) */
a {
    padding: 12px 24px;
    background-color:lightseagreen;
    color: white;
    border: 1px solid transparent;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.1em;
    display: inline-block;
    margin-top: 20px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

a:hover {
    background-color: #218838;
    transform: translateY(-2px); /* Subtle lift effect */
}

/* Fix the layout to prevent overlap */
.container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

/* Make links look good in mobile view */
@media (max-width: 768px) {
    ul {
        flex-direction: column;
        text-align: center;
    }

    li {
        margin: 5px 0;
    }

    .container {
        width: 95%;
        padding: 20px;
    }
    
    .container h1 {
        font-size: 2.2em;
    }
    
    .container p {
        font-size: 1em;
    }

    .button-container input {
        padding: 10px 18px;
        font-size: 1em;
    }
}
</style>
</head>
<body>

<ul>
  <li><a href="admin_edit.php">Edit/Update admin profile</a></li>
  <li><a href="admin_logout.php">Logout</a></li>
  <li><a href="user_list.php">User List</a></li>
  <li><a href="../display_product.php">Display Products</a></li>
  <li><a href="../product/details.php">Register Products</a></li>
  <li><a href="user_managament.php">user Management</a></li>
</ul>


</body>
</html>
