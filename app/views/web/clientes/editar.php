<!-- app/views/web/clientes/lista.php -->
<?php
// Definir un título para la página (opcional)
$titulo = 'Listado de Clientes';
// Incluir el header (que a su vez incluye el menú)
include __DIR__ . '/../../partials/header.php';
?>

    <div class="container mt-5">
        <h1 class="mb-4">Editar Cliente</h1>
        <!-- El formulario envía los datos mediante POST a la acción "actualizar" del controlador -->
        <form action="index.php?url=clientes/actualizar" method="post">
            <!-- Campo oculto para el ID del cliente -->
            <input type="hidden" name="ID_Cliente" value="<?php echo $cliente['ID_Cliente']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($cliente['Nombre']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php?url=clientes" class="btn btn-secondary ml-2">Volver al listado</a>
        </form>
    </div>
    
  
<?php
// Incluir el footer
include __DIR__ . '/../../partials/footer.php';
?>