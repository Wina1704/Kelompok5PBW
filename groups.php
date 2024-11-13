<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Menangani pembuatan kelompok baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['group_name'])) {
        $name = $_POST['group_name'];
        $description = $_POST['description'];

        // Insert ke tabel groups
        $stmt = $pdo->prepare("INSERT INTO groups (name, description) VALUES (?, ?)");
        $stmt->execute([$name, $description]);
        $lastGroupId = $pdo->lastInsertId();

        // Tambahkan pembuat ke tabel group_members
        $stmt_member = $pdo->prepare("INSERT INTO group_members (group_id, user_id) VALUES (?, ?)");
        $stmt_member->execute([$lastGroupId, $user_id]);

        // Jika tombol 'Simpan dan Lanjutkan' diklik, arahkan ke halaman 'tasks.php'
        if (isset($_POST['save_continue'])) {
            header("Location: tasks.php?group_id=$lastGroupId");
            exit;
        }
    }

    // Jika tombol 'Kembali ke Dashboard' diklik
    if (isset($_POST['back_to_dashboard'])) {
        header("Location: dashboard.php");
        exit;
    }
}

// Mendapatkan daftar kelompok
$stmt = $pdo->prepare("SELECT * FROM groups");
$stmt->execute();
$groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kelompok</title>
    <style>
        /* Reset dasar */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif; background-color: #f0f2f5;
            display: flex; justify-content: center; align-items: center;
            flex-direction: column; min-height: 100vh; padding: 20px;
        }
        h2, h3 { color: #4d79ff; margin-bottom: 20px; }
        form {
            background-color: #fff; padding: 20px; border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); margin-bottom: 30px;
            width: 100%; max-width: 400px;
        }
        input, textarea, button {
            width: 100%; padding: 10px; margin-top: 10px; border-radius: 5px; border: 1px solid #ddd;
        }
        button { background-color: #4d79ff; color: #fff; cursor: pointer; }
        button:hover { background-color: #365ec9; }
        ul { list-style: none; }
        li {
            background-color: #fff; padding: 15px; margin-bottom: 10px; border-radius: 8px;
            display: flex; justify-content: space-between; align-items: center;
        }
        li a {
            background-color: #4d79ff; color: #fff; padding: 8px 12px; border-radius: 5px;
            text-decoration: none; transition: background-color 0.3s;
        }
        li a:hover { background-color: #365ec9; }
        .back-button {
            background-color: #d9534f; padding: 10px; margin-top: 10px;
            text-decoration: none; border-radius: 5px; color: #fff;
        }
        .back-button:hover { background-color: #c9302c; }
    </style>
</head>
<body>
    <h2>Manajemen Kelompok</h2>

    <!-- Form untuk membuat kelompok baru -->
    <form method="POST">
        <label for="group_name">Nama Kelompok:</label>
        <input type="text" name="group_name" id="group_name" required><br>
        
        <label for="description">Deskripsi:</label>
        <textarea name="description" id="description" rows="4"></textarea><br>
        
        <button type="submit" name="save_continue">Simpan dan Lanjutkan</button>
    </form>

    <!-- Form terpisah untuk tombol Kembali ke Dashboard -->
    <form method="POST" style="margin-top: 20px;">
        <button type="submit" name="back_to_dashboard" class="back-button">Kembali ke Dashboard</button>
    </form>

    <h3>Daftar Kelompok</h3>
    <ul>
        <?php foreach ($groups as $group): ?>
            <li>
                <div>
                    <strong><?= htmlspecialchars($group['name']) ?></strong> - 
                    <?= htmlspecialchars($group['description']) ?>
                </div>
                <a href="tasks.php?group_id=<?= $group['group_id'] ?>">Lihat Tugas</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
