<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark" style="background-color: #0033A0;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <?php if(isset($_SESSION['login_id'])): ?>
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
    </li>
  <?php endif; ?>
    <li>
      <a class="nav-link text-white" href="./" role="button"><large><b>Graviton Event Registration and Attendance System</b></large></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
