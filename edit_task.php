<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$task_id = $_GET['task_id'];
$user_id = $_SESSION['user_id'];

// Mendapatkan data tugas berdasarkan task_id
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE task_id = ?");
$stmt->execute([$task_id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    echo "Tugas tidak ditemukan.";
    exit;
}

// Menangani pembaruan tugas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, due_date = ?, status = ? WHERE task_id = ?");
    $stmt->execute([$title, $description, $due_date, $status, $task_id]);

    echo "<script>alert('Tugas berhasil diperbarui!'); window.location.href='tasks.php?group_id=" . $task['group_id'] . "';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; padding: 20px; }
        form { background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); }
        input, textarea, select { width: 100%; padding: 10px; margin-top: 10px; border-radius: 5px; }
        button { background-color: #4d79ff; color: #fff; padding: 10px; border: none; cursor: pointer; }
        button:hover { background-color: #365ec9; }
    </style>
</head>
<body>
    <h2>Edit Tugas</h2>
    <form method="POST">
        <label>Judul:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>

        <label>Deskripsi:</label>
        <textarea name="description" rows="4"><?= htmlspecialchars($task['description']) ?></textarea>

        <label>Tanggal Selesai:</label>
        <input type="date" name="due_date" value="<?= htmlspecialchars($task['due_date']) ?>" required>

        <label>Status:</label>
        <select name="status">
            <option value="Belum Selesai" <?= $task['status'] === 'Belum Selesai' ? 'selected' : '' ?>>Belum Selesai</option>
            <option value="Selesai" <?= $task['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
        </select>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
