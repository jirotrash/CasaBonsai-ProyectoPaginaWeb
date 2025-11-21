<?php
// Minimal tabs component: only Dashboard button as requested
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$current = basename($_SERVER['PHP_SELF']);
$dashHref = '/../admin/index.php';
$logoutHref = '/../admin/logout.php';
$active = ($current === basename(parse_url($dashHref, PHP_URL_PATH))) ? 'active' : '';
?>
<nav class="admin-tabs-wrap">
  <div class="container">
    <ul class="admin-tabs">
      <li class="tab <?php echo $active; ?>"><a href="<?php echo $dashHref; ?>">Dashboard</a></li>
      <li class="tab logout"><a href="<?php echo $logoutHref; ?>">Cerrar sesión</a></li>
    </ul>
  </div>
</nav>
