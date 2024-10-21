<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // reCAPTCHA validation
    $recaptcha_secret = '6LdwdGcqAAAAAK42y_rweJ8Rs5fmRCcZi3oonEaM';  // Replace with your secret key
    $recaptcha_response = $_POST['g-recaptcha-response'];
    
    // Verify reCAPTCHA response
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $result_json = json_decode($result);
    
    // Check if reCAPTCHA is successful
    if ($result_json->success) {
        // Continue with registration
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
       
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            echo "<div class='success-message'>User registered successfully!</div>";
        } else {
            echo "<div class='error-message'>Error: " . $mysqli->error . "</div>";
        }
    } else {
        echo "<div class='error-message'>Please complete the CAPTCHA.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
   <style>
    /* General reset for all elements */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #1e3c72, #2a5298); /* Cool blue gradient */
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
    }

    /* Container styling */
    .container {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    /* Heading styling */
    h2 {
        font-size: 2em;
        margin-bottom: 20px;
        color: #4CAF50; /* Bright green heading */
    }

    /* Form styling */
    form {
        display: flex;
        flex-direction: column;
    }

    form label {
        text-align: left;
        font-size: 0.9em;
        color: #333;
        margin-bottom: 5px;
    }

    form input {
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 25px;
        font-size: 1em;
        transition: border-color 0.3s;
    }

    form input:focus {
        border-color: #4CAF50;
        outline: none;
    }

    /* Form button styling */
    form button {
        padding: 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 1em;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    form button:hover {
        background-color: #45a049;
    }

    /* Login button as a link */
    .login-button {
        background-color: #008CBA;
        margin-top: 15px;
        text-align: center;
        padding: 12px;
        border-radius: 25px;
        display: inline-block;
        color: white;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .login-button:hover {
        background-color: #007BB5;
    }

    /* Error and success messages */
    .error-message, .success-message {
        font-size: 0.9em;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .error-message {
        background-color: #f8d7da;
        color: #721c24;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
    }

    /* reCAPTCHA styling */
    .g-recaptcha {
        margin: 20px 0;
    }

    /* Media query for mobile responsiveness */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h2 {
            font-size: 1.8em;
        }

        form input, form button {
            font-size: 0.9em;
        }
    }

   </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div class="container">
    <h2>Create an Account</h2>
    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <!-- reCAPTCHA widget -->
        <div class="g-recaptcha" data-sitekey="6LdwdGcqAAAAACu7CZ8lYbiB4fZQcRLM56T67lc0"></div>

        <button type="submit">Register</button>

        <!-- Login Button -->
        <a href="login.php" class="login-button">Login</a>
    </form>
</div>

</body>
</html>

