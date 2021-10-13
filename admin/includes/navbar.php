<?php ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MyBlog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        </ul>
        <ul class="navbar-nav ml-auto">
        <?php if (isset($logged)) { ?>
        <li class="nav-item">
          <a class="nav-link" href="../admin">New post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage">Manage posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="newuser">Create user</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="../">Back to homepage</a>
        </li>
        <?php if (isset($logged)) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hey, <?php echo $logged->username; ?></a>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="settings">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout">Log out</a>
          </div>
        </li>
        <?php } ?>
        </ul>
    </div>
  </div>
</nav>