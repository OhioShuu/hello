<?php
require 'db.php';

// Lấy danh sách lý lịch
$sql = "SELECT resumes.id, resumes.title, resumes.description, users.name AS user_name 
        FROM resumes 
        JOIN users ON resumes.user_id = users.id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resumes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Database</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Resume List</h1>
    <a href="add.php">Add New Resume</a>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resumes as $resume): ?>
            <tr>
                <td><?= htmlentities($resume['title']) ?></td>
                <td><?= htmlentities($resume['description']) ?></td>
                <td><?= htmlentities($resume['user_name']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $resume['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $resume['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
