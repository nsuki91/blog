<?php

require_once 'includes/init.php';
session_start();
$logged = User::checkSession();

$URL = 'admin/';
$TITLE = 'Home';
$HOME = True;

?>

<!DOCTYPE html>

<html>
<?php include 'includes/header.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container" style="padding:2em; margin: 2em;;"
     class="d-flex flex-wrap">
  <?php Post::listPosts(); ?>
</div>
</body>
</html>