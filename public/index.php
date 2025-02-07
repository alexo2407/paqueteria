<?php
// public/index.php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Puedes incluir la configuración general si lo necesitas
$config = require_once '../config/config.php';

// Autocarga básica o incluye manualmente lo que necesites

// Incluir la clase Router
require_once __DIR__ . '/../app/core/Router.php';

// Instanciar el router y despachar la solicitud
$router = new Router();
$router->dispatch();
