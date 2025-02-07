<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de Clientes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

  <!-- Incluir el menú de navegación -->
  <?php include __DIR__ . '/../../partials/menu.php'; ?>

  <div class="container mt-4">
    <h2>Listado de Clientes</h2>
    <?php if(empty($clientes)): ?>
      <div class="alert alert-info" role="alert">
        No se encontraron clientes.
      </div>
    <?php else: ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($clientes as $cliente): ?>
          <tr>
            <td><?php echo htmlspecialchars($cliente['ID_Cliente']); ?></td>
            <td><?php echo htmlspecialchars($cliente['Nombre']); ?></td>
            <td><?php echo ($cliente['activo'] == 1) ? 'Activo' : 'Inactivo'; ?></td>
            <td>
              <a href="index.php?url=clientes/editar/<?php echo $cliente['ID_Cliente']; ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="index.php?url=clientes/cambiarEstado/<?php echo $cliente['ID_Cliente']; ?>" class="btn btn-info btn-sm">
                <?php echo ($cliente['activo'] == 1) ? 'Marcar Inactivo' : 'Marcar Activo'; ?>
              </a>
              <a href="index.php?url=clientes/eliminar/<?php echo $cliente['ID_Cliente']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">Eliminar</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
    <a href="index.php?url=clientes/crear" class="btn btn-primary">Crear Nuevo Cliente</a>
    <a href="index.php?url=clientes/inactivos" class="btn btn-secondary ml-2">Ver Clientes Inactivos</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
