<?php
require 'db.php';

// Lấy danh sách người dùng
$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();

// Xử lý form thêm mới
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];

    $sql = "INSERT INTO resumes (title, description, user_id) VALUES (:title, :description, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'description' => $description, 'user_id' => $user_id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Resume</title>
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
</head>
<body>
    <h1>Add New Resume</h1>
    <form method="POST" onsubmit="return validateForm()">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="user_id">User:</label><br>
        <select id="user_id" name="user_id" required>
            <?php foreach ($users as $user): ?>
            <option value="<?= $user['id'] ?>"><?= htmlentities($user['name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Add Resume</button>
    </form>
</body>
</html>
