<?php

namespace nsuki;

require_once '/home/nsukotss/public_html/includes/init.php';
session_start();
$logged = User::checkSession();

$CSS = '';
$URL = 'admin/';
$TITLE = 'Home';
$HOME = True;

?>

<!DOCTYPE html>

<html>
<?php include '/home/nsukotss/public_html/includes/header.php'; ?>
<body>
<?php include '/home/nsukotss/public_html/includes/navbar.php'; ?>
<div class="container" style="padding:2em; margin: 2em;;"
     class="d-flex flex-wrap">
  <?php Post::listPosts(); ?>
</div>
</body>
</html>