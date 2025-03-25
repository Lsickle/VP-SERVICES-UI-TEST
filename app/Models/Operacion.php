<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'operaciones';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'bodega',
    ];

    /**
     * Relación: Una operación puede tener muchos usuarios asociados.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
