<?php
// Kiểm tra nếu form đã được gửi
$error = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Kiểm tra thông tin đăng nhập (giả sử username là 'admin' và password là 'password')
    if ($username === 'admin' && $password === 'password') {
        // Nếu thông tin đúng, chuyển hướng đến trang chính
        header('Location: dashboard.php');
        exit();
    } else {
        $error = true;  // Nếu thông tin sai, đặt biến $error là true
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Please log in</h1>

    <!-- Nếu có lỗi, hiển thị thông báo -->
    <?php if ($error): ?>
        <p style="color:red;">Incorrect username or password</p>
    <?php endif; ?>

    <!-- Form đăng nhập -->
    <form method="POST" action="login.php">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Log in</button>
    </form>
</body>
</html>
