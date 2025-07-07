<?php
// store_project.php
include 'includes/db.php';

$title = $_POST['title'];
$category = $_POST['category'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$role = $_POST['role'];
$tags = $_POST['tags'];
$description = $_POST['description'];
$what_i_learned = $_POST['what_i_learned'];

$stmt = $pdo->prepare("INSERT INTO projects (title, category, start_date, end_date, role, tags, description, what_i_learned) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$title, $category, $start_date, $end_date, $role, $tags, $description, $what_i_learned]);
$project_id = $pdo->lastInsertId();

foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
    $filename = $_FILES['files']['name'][$key];
    $target_path = "uploads/" . basename($filename);
    move_uploaded_file($tmp_name, $target_path);
    $stmt = $pdo->prepare("INSERT INTO project_files (project_id, file_name, file_path) VALUES (?, ?, ?)");
    $stmt->execute([$project_id, $filename, $target_path]);
}

header("Location: dashboard.php");
exit();
?>