<?php

namespace App\Http\Controllers\Avaliations\DTOs;

use App\interfaces\DTO;
use App\Models\Avaliation;

class AvaliationsDTO implements DTO
{
    public Avaliation $avaliation;

    public function __construct(Avaliation $avaliation)
    {
        $this->avaliation = $avaliation;
    }

    public function encrypt(){
        return [
            'value'       => $this->avaliation->value,
            'description' => $this->avaliation->description
        ];
    }
}
