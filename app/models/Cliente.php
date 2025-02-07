<?php
// app/models/Cliente.php

require_once __DIR__ . '/../helpers/Database.php';

class Cliente
{
    public $ID_Cliente;
    public $Nombre;

    public function __construct($ID_Cliente = null, $Nombre = null)
    {
        $this->ID_Cliente = $ID_Cliente;
        $this->Nombre = $Nombre;
    }

    // Obtiene todos los clientes
    public static function getAll()
    {
        $db = Database::getInstance()->getConnection();
        // Selecciona solo clientes activos
        $stmt = $db->query("SELECT * FROM Clientes WHERE activo = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene un cliente por su ID
    public static function getById($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM Clientes WHERE ID_Cliente = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Guarda (inserta o actualiza) un cliente
    public function save()
    {
        $db = Database::getInstance()->getConnection();
        if ($this->ID_Cliente === null) {
            // Inserción
            $stmt = $db->prepare("INSERT INTO Clientes (Nombre, ID_Usuario) VALUES (:nombre, :id_usuario)");
            // Para simplificar, asignamos un ID_Usuario fijo (por ejemplo, 1) o lo podrías obtener dinámicamente
            $stmt->execute(['nombre' => $this->Nombre, 'id_usuario' => 1]);
            $this->ID_Cliente = $db->lastInsertId();
        } else {
            // Actualización
            $stmt = $db->prepare("UPDATE Clientes SET Nombre = :nombre WHERE ID_Cliente = :id");
            $stmt->execute(['nombre' => $this->Nombre, 'id' => $this->ID_Cliente]);
        }
    }

    public static function toggleEstado($id) {
        $db = Database::getInstance()->getConnection();
        // Obtener el estado actual del cliente
        $stmt = $db->prepare("SELECT activo FROM Clientes WHERE ID_Cliente = :id");
        $stmt->execute(['id' => $id]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$cliente) {
            return false; // Si no se encontró el cliente
        }
        
        // Determinar el nuevo estado: si es activo (1) se marca como inactivo (0), y viceversa.
        $nuevoEstado = ($cliente['activo'] == 1) ? 0 : 1;
        
        // Actualizar el estado en la base de datos
        $stmt2 = $db->prepare("UPDATE Clientes SET activo = :nuevoEstado WHERE ID_Cliente = :id");
        $stmt2->execute(['nuevoEstado' => $nuevoEstado, 'id' => $id]);
        
        return $nuevoEstado;
    }
    
    public static function getInactivos() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM Clientes WHERE activo = 0");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Elimina (marca inactivo) un cliente por su ID
    public static function delete($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE Clientes SET activo = 0 WHERE ID_Cliente = :id");
        $stmt->execute(['id' => $id]);
    }
}
