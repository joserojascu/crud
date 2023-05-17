<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    public function factulineas()
    {
        return $this->hasMany(Factulineas::class, 'id_producto');
    }
}