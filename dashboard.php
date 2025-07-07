<?php
// dashboard.php

include 'includes/auth.php';
include 'includes/db.php';
checkLogin();

$projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
<h2>Admin Dashboard</h2>
<a href="add_project.php">Add New Project</a>
<table border="1">
    <tr>
        <th>Title</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($projects as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['title']) ?></td>
            <td><a href="view_project.php?id=<?= $p['id'] ?>">View</a></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>