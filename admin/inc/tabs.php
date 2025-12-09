<?php
// Minimal tabs component: only Dashboard button as requested
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$current = basename($_SERVER['PHP_SELF']);
$dashHref = 'index.php';
$logoutHref = 'logout.php';
$active = ($current === basename($dashHref)) ? 'active' : '';
?>
<nav class="admin-tabs-wrap">
  <div class="container admin-tabs-container">
    <div class="admin-tabs-left">
      <ul class="admin-tabs">
        <li class="tab <?php echo $active; ?>"><a href="<?php echo $dashHref; ?>">Dashboard</a></li>
      </ul>
    </div>
    <div class="admin-tabs-right">
      <a href="<?php echo $logoutHref; ?>" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
    </div>
  </div>
</nav>
