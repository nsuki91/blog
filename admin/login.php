<?php

namespace nsuki;

require_once '/home/nsukotss/public_html/includes/init.php';
session_start();
User::checkSession();

$URL = 'admin/';
$CSS = '../';
$HOME = False;
$TITLE = 'Login';

?>

<!DOCTYPE html>

<html>
<?php include '/home/nsukotss/public_html/includes/header.php'; ?>
<body>
<?php include '/home/nsukotss/public_html/includes/navbar.php'; ?>
<center>
<div style="padding: 5px; margin: 5px;">
    <form id="login" action="" method="POST">
        <label class="col-form-label mt-4">Username</label>
        <input style="width: 25em;" id="username" name="username" type="text"
            class="form-control" placeholder="Username" required>
        <label class="col-form-label mt-4">Password</label>
        <input style="width: 25em;" id="password" name="password" type="password"
            class="form-control" placeholder="Password" required>
        <label class="col-form-label mt-4"><a href='reset'>Can't you remember your password?</a></label>
        <br>
            <button type="submit" id="login" name="login" style="margin:5px;"
            class="btn btn-outline-primary">Save</button>
    </form>
    <p class='text-danger'><?php echo User::checkLogin(); ?></p>
</div>
</form>
</form>
</body>
</html>