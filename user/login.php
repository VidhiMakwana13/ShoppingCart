<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    // Bind parameters
    $stmt->bind_param("s", $email);
    // Execute the statement
    $stmt->execute();
    // Get the result
    $result = $stmt->get_result();
    // Fetch the user data
    $user = $result->fetch_assoc();

    // Verify password and start session if valid
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['id'];
        header("Location: category.php");
        exit(); // Stop the script after redirect
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Shopping Cart</title>
    <style>
        /* Reset margin and padding for all elements */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f093fb, #f5576c); /* Vivid pink gradient */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        /* Container for the login form */
        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Header style */
        h1 {
            text-align: center;
            color: #673AB7; /* Deep purple */
            font-size: 2em;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* Form styles */
        .login-form {
            display: flex;
            flex-direction: column;
        }

        /* Input fields styles */
        .login-form input {
            padding: 15px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 30px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        /* Focus effect on input fields */
        .login-form input:focus {
            border-color: #673AB7; /* Highlight border on focus */
            outline: none;
        }

        /* Button styles */
        .login-form button {
            padding: 15px;
            background-color: #FF6B6B; /* Coral button */
            color: white;
            font-size: 1.2em;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        /* Hover effect on button */
        .login-form button:hover {
            background-color: #FF4D4D; /* Darker coral */
            transform: translateY(-3px); /* Lift the button on hover */
        }

        /* Error message styles */
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        /* Centered paragraph styles */
        p {
            text-align: center;
            font-size: 0.9em;
        }

        /* Link styles */
        p a {
            color: #673AB7; /* Deep purple */
            text-decoration: none;
            font-weight: bold;
        }

        /* Hover effect for links */
        p a:hover {
            text-decoration: underline;
        }

        /* Responsive design */
        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.8em;
            }

            .login-form input, .login-form button {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" class="login-form">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>

