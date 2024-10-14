<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

include "../Bakcend/Models/models.php";

$errors = [];
$viloyatlar = Model::get_viloyat();
$tumanlar = Model::get_tuman();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $viloyat_id = intval($_POST['viloyat_id']);
    $tuman_id = intval($_POST['tuman_id']);
    
    if (empty($name)) $errors[] = "Name is required";
    if (empty($surname)) $errors[] = "Surname is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
    if (empty($phone)) $errors[] = "Phone is required";
    if (empty($password)) $errors[] = "Password is required";

    if (count($errors) === 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $register = Model::register_patient($name, $surname, $email, $phone, $hashed_password, $viloyat_id, $tuman_id);
        
        if ($register === true) {
            header('location: main.php');
        } else {
            $errors[] = "Registration failed. Please try again.";
            // Log the error returned by the model
            error_log("Registration failed. Error: " . $register);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Patient Registration</h1>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Registration form -->
    <form action="registiration.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="viloyat_id">Viloyat:</label>
        <select name="viloyat_id" id="viloyat_id" required>
            <?php foreach ($viloyatlar as $v): ?>
                <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="tuman_id">Tuman:</label>
        <select name="tuman_id" id="tuman_id" required>
            <?php foreach ($tumanlar as $tuman): ?>
                <option value="<?= $tuman['id'] ?>"><?= htmlspecialchars($tuman['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>
