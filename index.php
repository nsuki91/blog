<?php

require_once 'includes/init.php';

?>

<!DOCTYPE html>

<html>
<head>
    <title>Home | Blog</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="css/bootstrap.js"></script>
    <script src="css/script.js" defer></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
      </ul>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="admin">Admin</a>
        </li>
        </ul>
    </div>
  </div>
</nav>
<div class="container" style="padding:2em; margin: 2em;;"
     class="d-flex flex-wrap">
  <?php Post::listPosts(); ?>
</div>
</body>
</html>