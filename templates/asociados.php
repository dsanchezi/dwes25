<?php
require_once '../src/utils/file.class.php';
require_once '../src/entity/asociado.class.php';
require_once '../src/database/Connection.class.php';
require_once '../src/repository/AsociadosRepository.php';

$errores = [];
$nombre = "";
$descripcion = "";
$mensaje = "";

try {
    $config = require_once __DIR__ . '/../app/config.php';
    App::bind('config', $config); // Guardamos la configuración en el contenedor de servicios

    $asociadoRepository = new AsociadosRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $nombre = trim(htmlspecialchars($_POST['nombre'] ?? ""));
        $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ""));

        if ($nombre == "") {
            $mensaje = "";
            $errores[] = "El nombre no debe estar vacío";
        } else {
            $captcha = $_POST['captcha'] ?? "";
            if ($captcha != "") {
                if ($_SESSION['captchaGenerado'] != $captcha) {
                    $mensaje = "";
                    $errores[] = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo";
                } else { // Todo correcto y se guardan los datos
                    $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
                    $logo = new File('logo', $tiposAceptados); // El nombre 'logo' es el que se ha puesto en el formulario de asociados.view.php

                    $logo->saveUploadFile(Asociado::RUTA_IMAGENES_ASOCIADO);

                    $asociado = new Asociado($nombre, $logo->getFileName(), $descripcion);
                    $asociadoRepository->save($asociado);

                    $descripcion = "";
                    $mensaje = "Se ha guardado el asociado correctamente";
                }
            }
        }
    }
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
}

require_once "views/asociados.view.php";
