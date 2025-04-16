<?php
// .ht.router.php

// Este archivo permite a Laravel capturar correctamente las rutas amigables
// cuando usas el servidor embebido de PHP (como con `php -S` en Railway)

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Ruta completa del archivo solicitado
$file = __DIR__ . '/public' . $uri;

// Si el archivo existe físicamente (CSS, JS, imágenes, etc.), se sirve directamente
if ($uri !== '/' && file_exists($file)) {
    return false;
}

// Si no, Laravel maneja la solicitud (rutas dinámicas, controladores, etc.)
require_once __DIR__ . '/public/index.php';
