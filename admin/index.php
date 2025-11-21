<?php
require __DIR__ . '/auth.php';
require_admin();
// dashboard counts
$counts = [];
$tables = ['usuario','producto','servicio','contacto','testimonio'];
foreach($tables as $t){
    try{
        $row = $pdo->query("SELECT COUNT(*) as c FROM {$t}")->fetch();
        $counts[$t] = $row ? (int)$row['c'] : 0;
    } catch(Exception $e){ $counts[$t] = 0; }
}
// include minimal header (se eliminó el header compartido)
$title = 'Casa Bonsái - Panel Administrativo';
echo '<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>' . htmlspecialchars($title) . '</title>'
  . '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">'
  . '<link rel="stylesheet" href="inc/admin-min.css">'
  . '<link rel="stylesheet" href="inc/tabs.css">'
  . '</head><body>';
include __DIR__ . '/inc/tabs.php';
echo '<div class="container py-4">';
?>
      <div class="text-center mb-4">
        <h4 class="text-secondary mb-1">Panel de Control</h4>
        <h1 class="display-4 m-0"><span class="text-primary">Dashboard</span> Administrativo</h1>
      </div>


      <!-- Action cards -->

        <!-- Dynamic tables management -->
        <div class="row mt-3">
          <div class="col-12">
            <div class="bg-white rounded shadow p-4">
              <h5>Gestionar tablas </h5>
              <p class="muted-small">Para Crear Borrar</p>
              <div class="d-flex flex-wrap" style="gap:8px">
              <?php
                try {
                  $tbls = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN, 0);
                } catch (Exception $e) { $tbls = []; }
                if (count($tbls)) {
                  // friendly name map
                  $friendlyMap = [
                    'usuario' => 'Usuario',
                    'producto' => 'Producto',
                    'servicio' => 'Servicio',
                    'contacto' => 'Contacto',
                    'testimonio' => 'Testimonio',
                    'residente' => 'Residente',
                    'rol' => 'Rol',
                    'categoria_producto' => 'Categoria producto',
                    'producto_categoria' => 'Producto categoria',
                    'usuario_rol' => 'Usuario rol'
                  ];

                  foreach ($tbls as $t) {
                    $label = $friendlyMap[$t] ?? ucfirst(str_replace('_',' ',$t));
                    // prefer direct CRUD file when present
                    $crudPath = __DIR__ . '/../crud/' . $t . '.php';
                    if (file_exists($crudPath)) {
                      $href = '/../crud/' . $t . '.php';
                    } else {
                      $href = '/../admin/manage.php?table=' . urlencode($t);
                    }
                    echo '<a class="btn btn-outline-secondary btn-sm" href="' . $href . '">' . htmlspecialchars($label) . '</a>';
                  }
                } else {
                  echo '<span class="muted-small">No se detectaron tablas.</span>';
                }
              ?>
              </div>
            </div>
          </div>
        </div>

      <!-- Alerts & Quick Access removed per request -->

    </div>
  </div>

<?php echo '</div>'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>
<?php echo '</body></html>'; ?>