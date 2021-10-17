<?php

namespace nsuki;

require_once '/home/nsukotss/public_html/includes/init.php';
$URL = "admin/";
$TITLE = 'Recovery';

if (!empty($_GET['q'])) {
    $hash = $_GET['q'];
    $selectedHash = Recovery::findByHash($hash);
    !empty($selectedHash) ? $selected = User::findByID($selectedHash->userid) : header('Location: ../');
    $return = User::checkRecovery($selected, $selectedHash);
} else {
    header('Location: ../');
    $return = '';
}
?>

<!DOCTYPE html>

<html>
<?php include '/home/nsukotss/public_html/includes/header.php'; ?>
<body>
<?php include '/home/nsukotss/public_html/includes/navbar.php'; ?>
<center>
<div id="formDiv" style="padding: 5px; margin: 5px;">
    <form id="recovery" action="" method="POST">
        <div class="form-group container-md">
            <label class="col-form-label mt-4" for="posttitle">New Password</label>
            <input type="password" class="form-control" placeholder="newpassword4543632" name="pass1" required>
        </div>
        <div class="form-group container-md">
            <label class="col-form-label mt-4" for="posttitle">New Password (type again)</label>
            <input type="password" class="form-control" placeholder="newpassword4543632" name="pass2" required>
        </div>
        <br>
        <button type="submit" name="recovery" style="margin:5px;"
                class="btn btn-outline-primary">Change Password</button>
    </form>
    <?php echo $return; ?>
</div>
</body>
</html>