<?php
require_once __DIR__ . '/../database/QueryBuilder.class.php';
require_once __DIR__ . '/../entity/Imagen.class.php';
require_once 'CategoriasRepository.php';

class ImagenesRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table='imagenes', string $classEntity='Imagen')
    {
        parent::__construct($table, $classEntity);
    }

    /**
     * @param Imagen $imagenGaleria
     * @return Categoria
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getCategoria(Imagen $imagenGaleria): Categoria
    {
        $categoriaRepository = new CategoriasRepository();

        return $categoriaRepository->find($imagenGaleria->getCategoria());
    }

    public function guarda(Imagen $imagenGaleria)
    {
        $fnGuardaImagen = function () use ($imagenGaleria) {     // Creamos una función anónima que se llama como callable
            $categoria = $this->getCategoria($imagenGaleria);
            $categoriaRepository = new CategoriasRepository();
            $categoriaRepository->nuevaImagen($categoria);
            $this->save($imagenGaleria);
        };

        $this->executeTransaction($fnGuardaImagen);    // Se pasa un callable
    }
}
