<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliation extends Model
{
    use HasFactory;
    public $table = 'avaliations';
    public $fillable = [
        'id_type_avaliation',
        'value',
        'description'
    ];
}
