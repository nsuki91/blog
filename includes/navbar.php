<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">MyBlog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        </ul>
        <ul class="navbar-nav ml-auto">
        <?php if (isset($logged)) { ?>
        <li class="nav-item">
          <a class="nav-link" href="/admin">New post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/manage">Manage posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/newuser">Create user</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hey, <?php echo $logged->username; ?></a>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="/admin/password">Change password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/admin/logout">Log out</a>
          </div>
        </li>
        <?php } else { ?>
          <li class="nav-item">
          <a class="nav-link" href="/admin/login">Login</a>
        </li>
        <?php } ?>
        </ul>
    </div>
  </div>
</nav>