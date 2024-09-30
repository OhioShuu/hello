<?php
// Thông tin kết nối cơ sở dữ liệu
$host = 'localhost';
$dbname = 'resume_db';
$username = 'root';
$password = '';

try {
    // Tạo kết nối PDO đến cơ sở dữ liệu
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}
?>
