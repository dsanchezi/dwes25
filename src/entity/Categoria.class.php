<?php
require_once 'IEntity.php';

class Categoria implements IEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var int
     */
    private $numImagenes;

    /**
     * @param string $nombre
     * @param int $numImagenes

     */
    public function __construct(string $nombre="", int $numImagenes=0)
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Categoria
     */
    public function setNombre(string $nombre): Categoria
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumImagenes(): int
    {
        return $this->numImagenes;
    }

    /**
     * @param int $numImagenes
     * @return Categoria
     */
    public function setNumImagenes(int $numImagenes): Categoria
    {
        $this->numImagenes = $numImagenes;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'numImagenes' => $this->getNumImagenes()
        ];
    }
}