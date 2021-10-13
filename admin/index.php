<?php

require_once '../includes/init.php';
session_start();
$logged = User::checkSession();

$HOME = false;
$TITLE = 'Add post';
?>

<!DOCTYPE html>

<html>
<?php include '../includes/header.php'; ?>
<body>
<?php include '../includes/navbar.php'; ?>
<center>
<div id="formDiv">
    <form id="newpost" action="" method="POST">
        <div class="form-group container-md">
            <label class="col-form-label mt-4" for="title">Title</label>
            <input type="text" class="form-control" placeholder="Example title" id="title" name="title" required>
        </div>
        <div class="form-group container-md">
            <label for="exampleTextarea" class="form-label mt-4">Context</label>
            <textarea style="height: 20em" class="form-control" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." name="context" rows="3" required></textarea>
        </div>
        <br>
        <button type="submit" id="newpost" name="newpost" style="margin:5px;"
                class="btn btn-outline-success">Save</button>
    </form>
    <?php Post::checkPost(); ?>
</div>
</body>
</html>