<?php
namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'productos';

    protected $fillable = [
        'codigo_producto',
        'nombre_producto',
        'precio',
        'fecha_creacion',
    ];
}
