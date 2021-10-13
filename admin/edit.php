<?php

require_once '../includes/init.php';
session_start();
$logged = User::checkSession();

if (!empty($_GET['q'])) {
    $postid = $_GET['q'];
    !empty(Post::findByID($postid)) ? $selected = Post::findByID($postid) : header('Location: ../');
} else {
    header('Location: ../');
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Admin | Blog</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <script src="../../css/bootstrap.js"></script>
    <script src="../../css/script.js" defer></script>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<center>
<div id="formDiv" style="padding: 5px; margin: 5px;">
    <form id="deletepost" action="" method="POST">
        <div class="form-group container-md">
            <label class="col-form-label mt-4" for="posttitle">Post ID</label>
            <input type="number" class="form-control" placeholder="Example: 35" id="postid" name="postid" required>
        </div>
        <br>
        <button type="submit" id="deletepost" name="deletepost" style="margin:5px;"
                class="btn btn-outline-danger">Delete</button>
    </form>
    <?php Post::checkDelete(); ?>
</div>
</body>
</html>