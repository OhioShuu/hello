<?php
require 'db.php';

// Xóa lý lịch
$id = $_GET['id'];
$sql = "DELETE FROM resumes WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: index.php");
exit();
?>
