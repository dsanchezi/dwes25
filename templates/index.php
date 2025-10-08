<?php

require_once __DIR__ . '/../src/entity/imagen.class.php';

$imagenesHome[]= new Imagen ('1.jpg','descripción imagen 1',1,456,610,140);
$imagenesHome[]= new Imagen ('2.jpg','descripción imagen 2',1,56,650,136);
$imagenesHome[]= new Imagen ('3.jpg','descripción imagen 3',1,2456,210,730);
$imagenesHome[]= new Imagen ('4.jpg','descripción imagen 4',1,45,917,138);
$imagenesHome[]= new Imagen ('5.jpg','descripción imagen 5',1,436,60,140);
$imagenesHome[]= new Imagen ('6.jpg','descripción imagen 6',1,446,818,380);
$imagenesHome[]= new Imagen ('7.jpg','descripción imagen 7',1,486,615,138);
$imagenesHome[]= new Imagen ('8.jpg','descripción imagen 8',1,155,219,73);
$imagenesHome[]= new Imagen ('9.jpg','descripción imagen 9',1,859,812,539);
$imagenesHome[]= new Imagen ('10.jpg','descripción imagen 10',1,51,816,1303);
$imagenesHome[]= new Imagen ('11.jpg','descripción imagen 11',1,855,418,637);
$imagenesHome[]= new Imagen ('12.jpg','descripción imagen 12',1,352,13,32);

require_once __DIR__ . '/views/index.view.php';
