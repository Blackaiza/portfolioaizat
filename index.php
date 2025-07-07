<?php
// index.php

include 'includes/db.php';
include 'includes/header.php';

$projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
?>
<h2>Recent Projects</h2>
<div class="projects">
<?php foreach ($projects as $p): ?>
    <div class="project-card">
        <h3><?= htmlspecialchars($p['title']) ?></h3>
        <p><strong>Tags:</strong> <?= htmlspecialchars($p['tags']) ?></p>
        <p><strong>Start:</strong> <?= $p['start_date'] ?> | <strong>End:</strong> <?= $p['end_date'] ?></p>
        <a href="view_project.php?id=<?= $p['id'] ?>">View Details</a>
    </div>
<?php endforeach; ?>
</div>
<?php include 'includes/footer.php'; ?>