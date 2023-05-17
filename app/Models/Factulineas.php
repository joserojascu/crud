<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factulineas extends Model
{
    use HasFactory;
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
    
}