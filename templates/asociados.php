<?php
require_once '../src/utils/file.class.php';
require_once '../src/entity/asociado.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    try {
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
                    $logo = new File('logo', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php

                    $logo->saveUploadFile(Asociado::RUTA_IMAGENES_ASOCIADO);

                    $mensaje = 'Datos enviados';
                }
            } else {
                $mensaje = "";
                $errores[] = "Introduzca el código de seguridad";
            }
        }
    } catch (FileException $fileException) {
        $errores[] = $fileException->getMessage();
    }
} else {
    $errores = [];
    $nombre = "";
    $descripcion = "";
    $mensaje = "";
}

require_once "views/asociados.view.php";
