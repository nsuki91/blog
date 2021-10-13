<?php

require_once '../includes/init.php';
session_start();
$logged = User::checkSession();

$HOME = false;
$TITLE = 'Change password';
?>

<!DOCTYPE html>

<html>
<?php include '../includes/header.php'; ?>
<body>
<?php include '../includes/navbar.php'; ?>
<center>
<div id="formDiv" style="padding: 5px; margin: 5px;">
    <form id="changePass" action="" method="POST">
        <div class="form-group container-md">
            <label class="col-form-label mt-4" for="posttitle">Current Password</label>
            <input type="password" class="form-control" placeholder="oldpassword5345" name="oldPass" required>
        </div>
        <div class="form-group container-md">
            <label class="col-form-label mt-4" for="posttitle">New Password</label>
            <input type="password" class="form-control" placeholder="newpassword4543632" name="newPass" required>
        </div>
        <br>
        <button type="submit" id="changepass" name="changePass" style="margin:5px;"
                class="btn btn-outline-primary">Change Password</button>
    </form>
    <?php User::checkPassword($logged); ?>
</div>
</body>
</html>