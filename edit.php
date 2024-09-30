<?php
require 'db.php';

// Lấy lý lịch hiện tại
$id = $_GET['id'];
$sql = "SELECT * FROM resumes WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$resume = $stmt->fetch();

// Lấy danh sách người dùng
$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();

// Xử lý form chỉnh sửa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];

    $sql = "UPDATE resumes SET title = :title, description = :description, user_id = :user_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'description' => $description, 'user_id' => $user_id, 'id' => $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Resume</h1>
    <form method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?= htmlentities($resume['title']) ?>" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required><?= htmlentities($resume['description']) ?></textarea><br><br>

        <label for="user_id">User:</label><br>
        <select id="user_id" name="user_id" required>
            <?php foreach ($users as $user): ?>
            <option value="<?= $user['id'] ?>" <?= $user['id'] == $resume['user_id'] ? 'selected' : '' ?>>
                <?= htmlentities($user['name']) ?>
            </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Update Resume</button>
    </form>
</body>
</html>
