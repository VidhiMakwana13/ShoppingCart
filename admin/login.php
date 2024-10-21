<?php
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded username and password
    $default_username = "admin"; 
    $default_password = "admin123";

    // Check if entered credentials match the hardcoded ones
    if ($username === $default_username && $password === $default_password) {
        $_SESSION['admin'] = $username; // Store admin session
        header("Location: dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        // Invalid login message
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5); /* Soft gradient background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 30px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); /* Deeper shadow for a floating effect */
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.05); /* Subtle zoom-in on hover */
        }

        h1 {
            font-size: 2em;
            color: #ff6b6b; /* Bright coral color */
            margin-bottom: 20px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .login-form label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            background: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #4CAF50; /* Highlight the field on focus */
            outline: none;
        }

        .login-form button {
            padding: 12px 20px;
            background: linear-gradient(135deg, #42a5f5, #478ed1); /* Gradient button */
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s, box-shadow 0.3s; /* Smooth transitions */
        }

        .login-form button:hover {
            background: linear-gradient(135deg, #2196F3, #1e88e5); /* Darker gradient on hover */
            box-shadow: 0 8px 20px rgba(33, 150, 243, 0.5); /* Glowing shadow effect */
        }

        .error-message {
            color: #e74c3c; /* Red for error messages */
            margin-top: 15px;
            font-size: 16px;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .container {
                margin: 0 20px;
            }

            h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form method="POST" action="login.php" class="login-form">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" name="login">Login</button>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?= $error_message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>

