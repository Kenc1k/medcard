<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../Bakcend/Models/models.php";

if (isset($_POST['viloyat_id'])) {
    $viloyat_id = $_POST['viloyat_id'];
    $tumanlar = Model::get_tuman_by_viloyat($viloyat_id);
    
    if ($tumanlar) {
        foreach ($tumanlar as $tuman) {
            echo '<option value="' . $tuman['id'] . '">' . htmlspecialchars($tuman['name']) . '</option>';
        }
    } else {
        echo '<option value="">Tumanlar mavjud emas</option>';
    }
} else {
    echo '<option value="">Tumanni tanlang</option>';
}

$error = '';

$viloyatlar = Model::get_viloyat();

$selectedViloyat = isset($_POST['viloyat']) ? $_POST['viloyat'] : '';
$selectedTuman = isset($_POST['tuman']) ? $_POST['tuman'] : '';

$tumanlar = [];
if ($selectedViloyat) {
    $tumanlar = Model::get_tuman_by_viloyat($selectedViloyat);
}

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
</head>
<body>
    <main class="form-container">
        <h1>Ro'yxatdan o'tish</h1>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form id="register-form" action="" method="POST" class="register-form">
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
<!-- Viloyat Dropdown -->
<div class="form-group">
    <label for="viloyat">Viloyat:</label>
    <select id="viloyat" name="viloyat" required onchange="this.form.submit()">
        <option value="">Viloyatni tanlang</option>
        <?php foreach ($viloyatlar as $viloyat): ?>
            <option value="<?= $viloyat['id'] ?>" <?= $viloyat['id'] == $selectedViloyat ? 'selected' : '' ?>>
                <?= htmlspecialchars($viloyat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


            <!-- Tuman Dropdown -->
<!-- Tuman Dropdown -->
<div class="form-group">
    <label for="tuman">Tuman:</label>
    <select id="tuman" name="tuman" required>
        <option value="">Tumanni tanlang</option>
        <?php if (!empty($tumanlar)): ?>
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

    <script>
$(document).ready(function() {
    $('#viloyat').on('change', function() {
        var viloyatId = $(this).val();
        if (viloyatId) {
            $.ajax({
                type: 'POST',
                url: 'get_tuman.php',
                data: { viloyat_id: viloyatId },
                success: function(response) {
                    $('#tuman').html(response);
                },
                error: function() {
                    alert('Error loading Tumans. Please try again.');
                }
            });
        } else {
            $('#tuman').html('<option value="">Tumanni tanlang</option>');
        }
    });
});
    </script>
</body>
</html>
