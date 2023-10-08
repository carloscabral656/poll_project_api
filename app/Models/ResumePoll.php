<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollPerson extends Model
{
    use HasFactory;
    public $table = 'resume_poll';
    public $fillable = [
        'id_user',
        'id_poll',
        'responded_poll',
        'qty_attempts_poll'
    ];
}
