<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Mendapatkan daftar kelompok yang diikuti oleh pengguna
$stmt_groups = $pdo->prepare("SELECT groups.* FROM groups 
    INNER JOIN group_members ON groups.group_id = group_members.group_id 
    WHERE group_members.user_id = ?");
$stmt_groups->execute([$user_id]);
$groups = $stmt_groups->fetchAll(PDO::FETCH_ASSOC);

// Mendapatkan daftar tugas yang ditugaskan kepada pengguna atau terkait dengan kelompok yang diikuti
$stmt_tasks = $pdo->prepare("
    SELECT tasks.*, groups.name AS group_name, users.name AS assignee 
    FROM tasks 
    LEFT JOIN groups ON tasks.group_id = groups.group_id 
    LEFT JOIN users ON tasks.assigned_to = users.user_id 
    WHERE tasks.group_id IN (SELECT group_id FROM group_members WHERE user_id = ?) 
    OR tasks.assigned_to = ?
");
$stmt_tasks->execute([$user_id, $user_id]);
$tasks = $stmt_tasks->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Reset dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
            color: #ffffff;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 28px;
            margin: 30px 0 15px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            max-width: 600px;
        }

        li {
            background-color: #ffffff;
            color: #333;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            color: #666;
        }

        a {
            text-decoration: none;
            background-color: #4d79ff;
            color: #ffffff;
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

        .button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4d79ff;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #365ec9;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
<h1>Dashboard</h1>

<!-- Menampilkan daftar kelompok -->
<h2>Kelompok Saya</h2>
<ul>
    <?php if (count($groups) > 0): ?>
        <?php foreach ($groups as $group): ?>
            <li>
                <strong><?= htmlspecialchars($group['name']) ?></strong> - <?= htmlspecialchars($group['description']) ?>
                <a href="tasks.php?group_id=<?= $group['group_id'] ?>">Lihat Tugas</a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Anda belum tergabung dalam kelompok apapun.</p>
    <?php endif; ?>
</ul>

<!-- Menampilkan daftar tugas -->
<h2>Tugas Saya</h2>
<ul>
    <?php if (count($tasks) > 0): ?>
        <?php foreach ($tasks as $task): ?>
            <li>
                <div>
                    <strong><?= htmlspecialchars($task['title']) ?></strong> 
                    - <?= htmlspecialchars($task['group_name']) ?> 
                    - Ditugaskan kepada: <?= htmlspecialchars($task['assignee'] ?: 'Tidak ditugaskan') ?>
                    <span>(Selesai pada: <?= htmlspecialchars($task['due_date']) ?>) - Status: <?= htmlspecialchars($task['status']) ?></span>
                </div>
                <a href="edit_task.php?task_id=<?= $task['task_id'] ?>">Edit</a>
                <a href="delete_task.php?task_id=<?= $task['task_id'] ?>" class="delete" onclick="return confirm('Yakin ingin menghapus tugas ini?')">Hapus</a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada tugas yang ditugaskan.</p>
    <?php endif; ?>
</ul>

<a href="groups.php" class="button">Kelola Kelompok</a><br>
<a href="logout.php" id="logoutBtn" class="button">Logout</a>

<script>
    // SweetAlert2 untuk konfirmasi logout
    document.getElementById('logoutBtn').addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: "Anda akan keluar dari sesi ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'logout.php';
            }
        });
    });
</script>
</body>
</html>
