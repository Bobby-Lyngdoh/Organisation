<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <style>
        /* General reset for margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            padding: 0;
            margin: 0;
        }

        /* Header styling */
        header {
            background-color: #3498db; /* Blue background for the header */
            padding: 20px 0;
            text-align: center;
            color: white;
            font-size: 30px;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add subtle shadow */
        }

        /* Navigation Bar */
        nav {
            background-color: #2c3e50; /* Dark background for the nav */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); /* Shadow effect */
        }

        /* List styling */
        ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
            width: 100%;
            padding: 0;
        }

        li {
            margin: 0 20px;
        }

        /* Anchor tag styling */
        li a {
            color: white;
            text-align: center;
            padding: 12px 25px;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
        }

        /* Hover effect for anchor tags */
        li a:hover {
            background-color: #1abc9c; /* Greenish hover effect */
            color: white;
            transform: scale(1.1); /* Slightly scale the button */
        }

        /* Active link effect */
        li a:active {
            background-color: #16a085; /* Darker greenish on active */
        }

        /* Responsive Design for smaller screens */
        @media (max-width: 768px) {
            nav {
                flex-direction: column; /* Stack the items vertically */
            
            }

            ul {
                flex-direction: column;
                align-items: center;
            }

            li {
                margin: 10px 0;
            }
        }


        
        
    </style>
</head>
<body>

    <!-- Header Section -->
  
    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>

    <!-- Footer Section (Optional) -->
  

</body>
</html>
