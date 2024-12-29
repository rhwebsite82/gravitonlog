<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
  <!-- Centered Title and Logo -->
  <div class="container d-flex justify-content-center align-items-center">
    <div class="d-flex align-items-center">
      <img src="logo1.png" alt="Logo" style="height: 50px; width: auto; margin-right: 15px;"> <!-- Adjusted logo size -->
      <span class="text-white" style="font-size: 1.5rem; font-weight: bold;">Graviton Event Log</span>
    </div>
  </div>

  <!-- Right navbar links -->
  <div class="ml-auto d-flex">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link nav-home" href="./">
          <b>Events</b>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
          <span>
            <div class="d-flex badge-pill">
              <span class="fa fa-user mr-2"></span>
              <span><b><?php echo ucwords($_SESSION['login_firstname']) ?></b></span>
              <span class="fa fa-angle-down ml-2"></span>
            </div>
          </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
          <a class="dropdown-item" href="signup.php" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
          <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<style>
  .cart-img {
    width: calc(25%);
    max-height: 13vh;
    overflow: hidden;
    padding: 3px;
  }
  .cart-img img {
    width: 100%;
  }
  .cart-qty {
    font-size: 14px;
  }
</style>
<!-- /.navbar -->
<script>
  $(document).ready(function(){
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    if($('.nav-link.nav-'+page).length > 0){
      $('.nav-link.nav-'+page).addClass('active')
      if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
        $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
      }
      if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
        $('.nav-link.nav-'+page).parent().addClass('menu-open')
      }
    }
    $('.manage_account').click(function(){
      uni_modal('Manage Account','manage_user.php?id='+$(this).attr('data-id'))
    })
  });
</script>
