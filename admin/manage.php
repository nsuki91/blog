<?php

namespace nsuki;

require_once '/home/nsukotss/public_html/includes/init.php';
session_start();
$logged = User::checkSession();

$CSS = '../';
$HOME = false;
$TITLE = 'Manage Post';
?>

<!DOCTYPE html>

<html>
<?php include '/home/nsukotss/public_html/includes/header.php'; ?>
<body>
<?php include '/home/nsukotss/public_html/includes/navbar.php'; ?>
<center>
<div id="formDiv" style="padding: 5px; margin: 5px;">
    <form id="deletepost" action="" method="POST">
        <div class="form-group container-md">
            <label class="col-form-label mt-4" for="posttitle">Post ID</label>
            <input type="number" class="form-control" placeholder="Example: 35" id="q" name="q" required>
        </div>
        <br>
        <button type="submit" id="edit" name="edit" style="margin:5px;"
                class="btn btn-outline-danger">Edit</button>
    </form>
    <?php Post::verifyPost(); ?>
</div>
</body>
</html>