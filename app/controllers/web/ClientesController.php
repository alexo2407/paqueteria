<?php
// app/controllers/web/ClienteController.php

require_once __DIR__ . '/../../models/Cliente.php';

class ClientesController  {

    // Muestra el listado de clientes
      public function index() {
        // Obtiene todos los clientes de la base de datos
        $clientes = Cliente::getAll();

        // Incluye la vista que muestra el listado de clientes
        include __DIR__ . '/../../views/web/clientes/lista.php';
    }

    // Muestra el formulario para crear un nuevo cliente
    public function crear() {
        include __DIR__ . '/../../views/web/clientes/crear.php';
    }

    // Procesa el formulario para guardar un nuevo cliente
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

            if (!empty($nombre)) {
                $cliente = new Cliente(null, $nombre);
                $cliente->save();
                header("Location: index.php?url=clientes");
                exit;
            } else {
                echo "El nombre es obligatorio. Por favor, vuelve a intentarlo.";
            }
        } else {
            echo "Método no permitido.";
        }
    }

    // Muestra el formulario de edición para un cliente específico
    public function editar($id) {
        $cliente = Cliente::getById($id);
        if (!$cliente) {
            echo "Cliente no encontrado.";
            return;
        }
        include __DIR__ . '/../../views/web/clientes/editar.php';
    }

    // Procesa el formulario para actualizar un cliente existente
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['ID_Cliente']) ? $_POST['ID_Cliente'] : '';
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

            if (!empty($id) && !empty($nombre)) {
                $cliente = new Cliente($id, $nombre);
                $cliente->save();
                header("Location: index.php?url=clientes");
                exit;
            } else {
                echo "Todos los campos son obligatorios.";
            }
        } else {
            echo "Método no permitido.";
        }
    }

    public function cambiarEstado($id) {
        // Llama al método del modelo para alternar el estado del cliente
        Cliente::toggleEstado($id);
        // Redirige de nuevo al listado de clientes
        header("Location: index.php?url=clientes");
        exit;
    }

    public function inactivos() {
        $clientesInactivos = Cliente::getInactivos();
        include __DIR__ . '/../../views/web/clientes/inactivos.php';
    }
    

    // Elimina un cliente
    public function eliminar($id) {
        // En lugar de eliminar físicamente, se marca el cliente como inactivo.
        Cliente::delete($id);
        header("Location: index.php?url=clientes");
        exit;
    }
    
}
