<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAvaliation extends Model
{
    use HasFactory;
    public $table = 'type_avaliations';
    public $fillable = [
        'title',
        'description'
    ];
    public static $createTypeAvaliation = [
        'title' => 'required',
        'description' => 'required'
    ];
    public static $updateTypeAvaliation = [
        'title' => 'required',
        'description' => 'required'
    ]; 
}
