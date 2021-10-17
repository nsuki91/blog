<?php

namespace nsuki;

require_once('/home/nsukotss/public_html/includes/init.php');

session_start();
$logged = User::checkSession();

if (!empty($_GET['q'])) {
    $postid = $_GET['q'];
    !empty(Post::findByID($postid)) ? $selected = Post::findByID($postid) : header('Location: ../');
} else {
    header('Location: ../');
}

$TITLE = $selected->title;
$HOME = True;
?>

<!DOCTYPE html>

<html>
<?php include '/home/nsukotss/public_html/includes/header.php'; ?>

<body>
<?php include '/home/nsukotss/public_html/includes/navbar.php'; ?>

<br>
<div class="container">
    <div class="col-8">
        <h3><?php echo $selected->title; ?></h3>
        <i>Written by <?php echo $selected->author; ?> | <?php echo $selected->date; ?></i>
        <br>
        <p><?php echo $selected->context; ?>
    </div>
</div>
</body>
</html>