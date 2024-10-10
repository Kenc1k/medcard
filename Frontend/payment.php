<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <div class="container">
        <h1>Ilovadan foydalanish uchun to'lov</h1>
        <p>Obuna to'langan sanadan boshlab 1 yil amal qiladi</p>
        
        <div class="subscription-card">
            <h2>Obuna narxi</h2>
            <p>3,900 so'm</p>
            <p>Amal qilish muddati</p>
            <p>18.07.2024 - 17.07.2025</p>
        </div>

        <h2>To'lov turini tanlang</h2>
        <form action="process_payment.php" method="POST">
            <div class="payment-option">
                <input type="radio" id="payme" name="payment_method" value="payme" required>
                <label for="payme">Payme orqali to'lash</label>
            </div>
            <div class="payment-option">
                <input type="radio" id="click" name="payment_method" value="click" required>
                <label for="click">Click orqali to'lash</label>
            </div>

            <button type="submit" class="pay-button">To'lov qilish</button>
        </form>
    </div>
</body>
</html>
