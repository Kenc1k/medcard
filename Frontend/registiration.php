<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../Bakcend/Models/models.php";

$viloyatlar = Model::get_viloyat();

$selectedViloyat = isset($_POST['viloyat']) ? $_POST['viloyat'] : '';
$selectedTuman = isset($_POST['tuman']) ? $_POST['tuman'] : '';

$tumanlar = [];
if ($selectedViloyat) {
    $tumanlar = Model::get_tuman_by_viloyat($selectedViloyat);
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    
    $viloyat_id = $selectedViloyat; 
    $tuman_id = $selectedTuman; 

    if (empty($viloyat_id) || empty($tuman_id)) {
        $error = "Please select both Viloyat and Tuman.";
    } else {
        $registrationSuccess = Model::register_patient($name, $surname, $email, $phone, $password, $viloyat_id, $tuman_id);

        if ($registrationSuccess) {
            header("Location: login.php"); 
            exit;
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Patient</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <main class="form-container">
        <h1>Ro'yxatdan o'tish</h1>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="" method="POST" class="register-form">
            <!-- Name Input -->
            <div class="form-group">
                <label for="name">Ism:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <!-- Surname Input -->
            <div class="form-group">
                <label for="surname">Familiya:</label>
                <input type="text" id="surname" name="surname" required>
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Phone Input -->
            <div class="form-group">
                <label for="phone">Telefon:</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <!-- Viloyat Dropdown -->
            <div class="form-group">
                <label for="viloyat">Viloyat:</label>
                <select id="viloyat" name="viloyat" onchange="this.form.submit()" required>
                    <option value="">Viloyatni tanlang</option>
                    <?php foreach ($viloyatlar as $viloyat): ?>
                        <option value="<?= $viloyat['id'] ?>" <?= $viloyat['id'] == $selectedViloyat ? 'selected' : '' ?>>
                            <?= htmlspecialchars($viloyat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tuman Dropdown -->
            <div class="form-group">
                <label for="tuman">Tuman:</label>
                <select id="tuman" name="tuman" required>
                    <option value="">Tumanni tanlang</option>
                    <?php if ($selectedViloyat): ?>
                        <?php foreach ($tumanlar as $tuman): ?>
                            <option value="<?= $tuman['id'] ?>" <?= $tuman['id'] == $selectedTuman ? 'selected' : '' ?>>
                                <?= htmlspecialchars($tuman['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Parol:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn">Ro'yxatdan o'tish</button>
        </form>
    </main>
</body>
</html>
