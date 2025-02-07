<!-- app/views/web/clientes/lista.php -->
<?php
// Definir un título para la página (opcional)
$titulo = 'Listado de Clientes';
// Incluir el header (que a su vez incluye el menú)
include __DIR__ . '/../../partials/header.php';
?>


    <div class="container mt-5">
        <h1 class="mb-4">Crear Nuevo Cliente</h1>
        <!-- Formulario estilizado con clases de Bootstrap -->
        <form action="index.php?url=clientes/guardar" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre del cliente" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?url=clientes" class="btn btn-secondary ml-2">Volver al listado</a>
        </form>
    </div>

    <?php
// Incluir el footer
include __DIR__ . '/../../partials/footer.php';
?>