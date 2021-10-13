<?php

require_once '../includes/init.php';
session_start();
User::checkSession();

?>

<!DOCTYPE html>

<html>
<head>
    <title>Admin Login | Blog</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../css/bootstrap.js"></script>
    <script src="../css/script.js" defer></script>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<center>
<div style="padding: 5px; margin: 5px;">
    <form id="login" action="" method="POST">
        <label class="col-form-label mt-4">Username</label>
        <input style="width: 25em;" id="username" name="username" type="text"
            class="form-control" placeholder="Username" required>
        <label class="col-form-label mt-4">Password</label>
        <input style="width: 25em;" id="password" name="password" type="password"
            class="form-control" placeholder="Password" required>
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