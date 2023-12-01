<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;
    protected $table = "diagnostics";

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'treatment_date',
        'treatment_hour',
        'diagnostic',
        'observation',
        'user_id',
        'medicament_id',
       // 'treatment_id'
    ];
}
