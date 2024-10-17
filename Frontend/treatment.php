<?php
try {
    include '../Backend/Models/models.php';
} catch (Exception $e) {
    echo 'Error including models file: ' . $e->getMessage();
    exit;
}

try {
    include 'functions.php';
} catch (Exception $e) {
    echo 'Error including functions file: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treatment Page</title>
    <link rel="stylesheet" href="assets/style/treatment.css">
</head>
<body>
    <div class="container">
        <h1>Available Treatments</h1>
        <div class="treatment-list">
            <?php
            try {
                $treatments = Model::getTreatments();

                if (empty($treatments)) {
                    echo "<p>No treatments returned from Model::getTreatments()</p>";
                }

                echo "<pre>";
                print_r($treatments);
                echo "</pre>";

                if (count($treatments) > 0) {
                    foreach ($treatments as $treatment) {
                        echo "<div class='treatment-item'>";
                        echo "<h2>" . $treatment->name . "</h2>";
                        echo "<p>" . $treatment->description . "</p>";
                        echo "<p><strong>Cost:</strong> $" . $treatment->cost . "</p>";
                        echo "<p><strong>Duration:</strong> " . $treatment->duration . " minutes</p>";
                        echo "<p><strong>Doctor:</strong> " . $treatment->doctor_name . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No treatments available at the moment.</p>";
                }
            } catch (Exception $e) {
                echo 'Error getting treatments: ' . $e->getMessage();
                exit;
            }
            ?>
        </div>
    </div>
</body>
</html>