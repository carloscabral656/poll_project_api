<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    public $table = 'polls';
    public $fillable = [
        'title',
        'description',
        'begin_at',
        'finish_at'
    ];

    public function questions(){
        return $this->hasMany(
            Question::class,
            'id_poll',
            'id'
        );
    }
}
