<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'afeccion',
        'medicamento',
        'forma_farmaceutica',
        'composicion',
        'tratamiento',
        'fecha_inicio',
        'hora_inicio',
        'fecha_fin',
        'hora_fin',
        'cada_24',
        'cada_12',
        'cada_8',
        'cada_6',
        'antes_almuerzo_cena',
        'despues_almuerzo_cena',
        'cuando_sea_necesario',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
