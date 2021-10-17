<?php

namespace nsuki;

require_once '/home/nsukotss/public_html/includes/init.php';
$TITLE = 'Edit Post';
session_start();
$logged = User::checkSession();

if (!empty($_GET['q'])) {
    $postid = $_GET['q'];
    !empty(Post::findByID($postid)) ? $selected = Post::findByID($postid) : header('Location: /');
} else {
    header('Location: /');
}
?>

<!DOCTYPE html>

<html>
<?php include '/home/nsukotss/public_html/includes/header.php'; ?>
<body>
<?php include '/home/nsukotss/public_html/includes/navbar.php'; ?>
<center>
<div id="formDiv" style="padding: 5px; margin: 5px;">
<form id="update" action="" method="POST">
        <div class="form-group container-md">
            <label class="col-form-label mt-4" for="title">Title</label>
            <input type="text" class="form-control" placeholder="Example title" id="title" name="title" value="<?php echo $selected->title; ?>" required>
        </div>
        <div class="form-group container-md">
            <label for="exampleTextarea" class="form-label mt-4">Context</label>
            <textarea style="height: 20em" class="form-control" name="context" rows="3" required><?php echo $selected->context; ?></textarea>
        </div>
        <br>
        <button type="submit" id="update" name="update" style="margin:5px;"
                class="btn btn-outline-success">Update</button>
    </form>
    <?php Post::checkUpdate($selected); ?>
</div>
</body>
</html>