<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$task_id = $_GET['task_id'];

// Hapus tugas berdasarkan task_id
$stmt = $pdo->prepare("DELETE FROM tasks WHERE task_id = ?");
$stmt->execute([$task_id]);

echo "<script>alert('Tugas berhasil dihapus!'); window.history.back();</script>";
?>
