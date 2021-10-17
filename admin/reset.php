<?php

namespace nsuki;

require_once '/home/nsukotss/public_html/includes/init.php';

$CSS = '../';
$HOME = false;
$TITLE = 'Reset Password';
?>

<!DOCTYPE html>

<html>
<?php include '/home/nsukotss/public_html/includes/header.php'; ?>
<body>
<?php include '/home/nsukotss/public_html/includes/navbar.php'; ?>
<center>
<div class="container" style="padding: 5px; margin: 5px;">
    <form id="deletepost" action="" method="POST">
        <div class="form-group container-md">
            <label class="col-form-label mt-4" for="posttitle">Email</label>
            <input type="email" class="form-control" placeholder="your@mail.com" name="email" required>
        </div>
        <br>
        <button type="submit" name="resetpass" style="margin:5px;"
                class="btn btn-outline-danger">Submit</button>
    </form>
    <?php Recovery::resetPass(); ?>
</div>
</body>
</html>