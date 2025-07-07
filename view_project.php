<?php
// view_project.php
include 'includes/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch();

$stmt = $pdo->prepare("SELECT * FROM project_files WHERE project_id = ?");
$stmt->execute([$id]);
$files = $stmt->fetchAll();

$start = new DateTime($project['start_date']);
$end = new DateTime($project['end_date']);
$interval = $start->diff($end);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($project['title']) ?></title>
</head>
<body>
<h2><?= htmlspecialchars($project['title']) ?></h2>
<p><strong>Category:</strong> <?= htmlspecialchars($project['category']) ?></p>
<p><strong>Role:</strong> <?= htmlspecialchars($project['role']) ?></p>
<p><strong>Tags:</strong> <?= htmlspecialchars($project['tags']) ?></p>
<p><strong>Duration:</strong> <?= $interval->days ?> days</p>
<p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($project['description'])) ?></p>
<p><strong>What I Learned:</strong><br><?= nl2br(htmlspecialchars($project['what_i_learned'])) ?></p>

<h3>Files:</h3>
<ul>
<?php foreach ($files as $file): ?>
    <li><a href="<?= $file['file_path'] ?>" download><?= htmlspecialchars($file['file_name']) ?></a></li>
<?php endforeach; ?>
</ul>

<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
