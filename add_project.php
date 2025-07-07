<?php
// add_project.php
include 'includes/auth.php';
checkLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Project</title>
</head>
<body>
<h2>Add New Project</h2>
<form action="store_project.php" method="POST" enctype="multipart/form-data">
    Title: <input name="title" required><br>
    Category: <input name="category"><br>
    Start Date: <input type="date" name="start_date" required><br>
    End Date: <input type="date" name="end_date" required><br>
    Role: <input name="role"><br>
    Tags: <input name="tags"><br>
    Description:<br><textarea name="description"></textarea><br>
    What I Learned:<br><textarea name="what_i_learned"></textarea><br>
    Files: <input type="file" name="files[]" multiple><br>
    <input type="submit" value="Save">
</form>
</body>
</html>