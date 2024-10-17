<?php

include "../../Bakcend/Models/models.php";


$users = Model::get_patients();

$drugs = Model::get_drugs()

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/admin.css"> <!-- Link to external CSS file -->
</head>
<body>
    <?php include "../helpers/navbar.php"  ?>

    <!-- <div class="container mt-5">
        <h1 class="text-center">Welcome, <?= $_SESSION['user']['name'] ?></h1> -->

        <section id="manage-users" class="mt-5 ml-5 mr-5 mb-5">
            <h2>Manage Users</h2>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['surname'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section id="manage-tasks" class="mt-5 ml-5 mr-5">
            <h2>Drugs</h2>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Manufacturer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($drugs as $drug): ?>
                    <tr>
                        <td><?= $drug['id'] ?></td>
                        <td><?= $drug['name'] ?></td>
                        <td><?= $drug['description'] ?></td>
                        <td>$<?= $drug['price'] ?></td>
                        <td><?= $drug['manufacturer'] ?></td>
                        <td>
                            <a href="edit_task.php?id=<?= $task['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_task.php?id=<?= $task['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
