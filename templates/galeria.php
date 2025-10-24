<?php
require_once '../src/utils/file.class.php';
require_once '../src/entity/Imagen.class.php';
require_once '../src/entity/Categoria.class.php';
require_once '../src/database/Connection.class.php';
require_once '../src/repository/ImagenesRepository.php';
require_once '../src/repository/CategoriasRepository.php';
require_once '../src/exceptions/CategoriaException.class.php';
require_once '../src/exceptions/FileException.class.php';

$errores = [];
$imagenes = [];
$titulo = "";
$descripcion = "";
$mensaje = "";

try {
    $config = require_once __DIR__ . '/../app/config.php';
    App::bind('config', $config); // Guardamos la configuración en el contenedor de servicios

    $imagenRepository = new ImagenesRepository();
    $categoriaRepository = new CategoriasRepository();
    $categorias = $categoriaRepository->findAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = trim(htmlspecialchars($_POST['titulo'] ?? ""));
        $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ""));
        $categoria = trim(htmlspecialchars($_POST['categoria']));
        if (empty($categoria))
            throw new CategoriaException;

        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php

        $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

        $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion,$categoria);
        $imagenRepository->guarda($imagenGaleria);

        $mensaje = "Se ha guardado la imagen correctamente";
    }
    $imagenes = $imagenRepository->findAll();
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
} catch (CategoriaException) {
    $errores[] = "No se ha seleccionado una categoría válida";
}



require_once "views/galeria.view.php";
