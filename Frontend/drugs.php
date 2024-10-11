<?php
include "../Bakcend/Models/models.php";

$drugs = Model::get_drugs();

$drugDetails = null;
if (isset($_GET['view'])) {
    $drugId = $_GET['view'];
    $drugDetails = Model::get_drug_by_id($drugId); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drugs Store</title>
    <link rel="stylesheet" href="assets/style/drugs.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Drug Store</h1>
        </header>
        <table class="drug-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drugs as $drug): ?>
                <tr>
                    <td><img src="uploads/<?= htmlspecialchars($drug->image) ?>" alt="<?= htmlspecialchars($drug->name) ?>" width="100"></td>
                    <td><?= htmlspecialchars($drug->name) ?></td>
                    <td>$<?= htmlspecialchars(number_format($drug->price, 2)) ?></td>
                    <td>
                        <a href="?view=<?= $drug->id ?>" class="view-btn">View Details</a>
                        <button class="buy-btn" onclick="buyDrug(<?= $drug->id ?>)">Buy Now</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Drug Details Modal -->
        <?php if ($drugDetails): ?>
        <div class="drug-details" id="drug-details" style="display: flex;"> <!-- Ensure it's displayed -->
            <div class="details-content">
                <h2><?= htmlspecialchars($drugDetails->name) ?></h2>
                <img src="uploads/<?= htmlspecialchars($drugDetails->image) ?>" alt="<?= htmlspecialchars($drugDetails->name) ?>" width="150">
                <p><strong>Description:</strong> <?= htmlspecialchars($drugDetails->description) ?></p>
                <p><strong>Price:</strong> $<?= htmlspecialchars(number_format($drugDetails->price, 2)) ?></p>
                <p><strong>Manufacturer:</strong> <?= htmlspecialchars($drugDetails->manufacturer) ?></p>
                <p><strong>Expiration Date:</strong> <?= htmlspecialchars($drugDetails->expiration_date) ?></p>
                <button class="close-btn" onclick="closeModal()">Close</button>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
        function closeModal() {
            document.getElementById('drug-details').style.display = 'none'; // Hide modal on close
        }
    </script>
</body>
</html>
