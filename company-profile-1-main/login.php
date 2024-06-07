<?php
// Include the database connection
include 'db.php';

// Start a session
session_start();

// Initialize variables
$username = $password = $error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the username and password match
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Authentication successful, set session variable
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        // Authentication failed, set error message
        $error = "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background-color: #000;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #fff;
            box-shadow: 0px 0px 20px 0px rgba(255, 255, 255, 0.1);
            max-width: 300px;
            width: 100%;
        }
        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 10px;
            margin: 5px 0px;
            border: none;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            border: 1px solid #fff;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            cursor: pointer;
            border: 1px solid #fff;
            transition: background-color 0.3s, color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #fff;
            color: #000;
        }
        .error {
            color: red;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="card">
        <h2 style="text-align: center;">Log In</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required value="<?php echo htmlspecialchars($username); ?>">
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        </form>
    </div>
</body>
</html>
