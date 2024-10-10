<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__ . '/../Bakcend/Models/models.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $user = Model::login($phone, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        header("Location: payment.php");
        exit;
    } else {
        $error = "Invalid phone number or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <main class="form-container">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST" class="login-form">
            <!-- Phone Input -->
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn">Login</button>
        </form>
    </main>
</body>
</html>
