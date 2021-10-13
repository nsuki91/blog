<?php

require_once '../includes/init.php';
session_start();
$logged = User::checkSession();
?>

<!DOCTYPE html>

<html>
<head>
    <title>Admin | Blog</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../css/bootstrap.js"></script>
    <script src="../css/script.js" defer></script>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<center>

</body>
</html>