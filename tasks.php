<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$group_id = $_GET['group_id'];

// Menangani pembuatan tugas baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $assigned_to = $_POST['assigned_to'];

    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, due_date, group_id, created_by, assigned_to) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $due_date, $group_id, $user_id, $assigned_to]);
    echo "<script>alert('Tugas berhasil ditambahkan!');</script>";
}

// Mendapatkan daftar tugas
$stmt = $pdo->prepare("SELECT tasks.*, users.name AS assignee FROM tasks LEFT JOIN users ON tasks.assigned_to = users.user_id WHERE group_id = ?");
$stmt->execute([$group_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Tugas</title>
    <style>
        /* Reset dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            padding: 20px;
        }

        h2, h3 {
            color: #4d79ff;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            width: 100%;
            max-width: 500px;
        }

        form label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        form input, form textarea, form button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        form input:focus, form textarea:focus {
            outline: none;
            border-color: #4d79ff;
        }

        form button {
            background-color: #4d79ff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #365ec9;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li div {
            flex-grow: 1;
        }

        li span {
            display: block;
            font-size: 14px;
            color: #888;
        }

        a {
            text-decoration: none;
            background-color: #4d79ff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            background-color: #365ec9;
        }

        a {
        text-decoration: none;
        background-color: #4d79ff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        margin-right: 10px;
        transition: background-color 0.3s;
        }

        a:hover {
            background-color: #365ec9;
        }

        a.delete {
            background-color: #d9534f;
        }

        a.delete:hover {
            background-color: #c9302c;
        }

    </style>
</head>
<body>
    <h2>Manajemen Tugas</h2>
    <form method="POST">
        <label for="title">Judul:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Deskripsi:</label>
        <textarea name="description" id="description" rows="4"></textarea>

        <label for="due_date">Tanggal Selesai:</label>
        <input type="date" name="due_date" id="due_date" required>

        <label for="assigned_to">Ditugaskan Kepada (User ID):</label>
        <input type="number" name="assigned_to" id="assigned_to" required>

        <button type="submit">Tambah Tugas</button>
    </form>

    <h3>Daftar Tugas</h3>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <div>
                <strong><?= htmlspecialchars($task['title']) ?></strong> - <?= htmlspecialchars($task['assignee']) ?>
                <span>(Selesai pada: <?= htmlspecialchars($task['due_date']) ?>) - Status: <?= htmlspecialchars($task['status']) ?></span>
            </div>
            <a href="edit_task.php?task_id=<?= $task['task_id'] ?>">Edit</a>
            <a href="delete_task.php?task_id=<?= $task['task_id'] ?>" onclick="return confirm('Yakin ingin menghapus tugas ini?')">Hapus</a>
        </li>
    <?php endforeach; ?>
</ul>


    <a href="groups.php">Kembali ke Kelompok</a>
</body>
</html>
