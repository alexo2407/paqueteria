<!-- app/views/partials/menu.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php?url=clientes">Mi App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <!-- Clientes Activos -->
      <li class="nav-item <?php echo (isset($_GET['url']) && strpos($_GET['url'], 'clientes') === 0 && $_GET['url'] !== 'clientes/inactivos') ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?url=clientes">Clientes Activos</a>
      </li>
      <!-- Clientes Inactivos -->
      <li class="nav-item <?php echo (isset($_GET['url']) && $_GET['url'] == 'clientes/inactivos') ? 'active' : ''; ?>">
      <a class="nav-link" href="index.php?url=clientes/inactivos">Clientes Inactivos</a>

      </li>
      <!-- Otros enlaces, por ejemplo: Pedidos -->
      <li class="nav-item <?php echo (isset($_GET['url']) && strpos($_GET['url'], 'pedidos') === 0) ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?url=pedidos">Pedidos</a>
      </li>
      <!-- Productos, etc. -->
      <li class="nav-item <?php echo (isset($_GET['url']) && strpos($_GET['url'], 'productos') === 0) ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?url=productos">Productos</a>
      </li>
    </ul>
  </div>
</nav>
