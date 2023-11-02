<?php

namespace App\Http\Controllers\TypeAvaliations\DTO;

use App\interfaces\DTO;
use App\Models\TypeAvaliation;

class TypeAvaliationDTO implements DTO
{
    public TypeAvaliation $typeAvaliation;

    public function __construct(TypeAvaliation $typeAvaliation)
    {
        $this->typeAvaliation = $typeAvaliation;
    }

    public function encrypt() : array {
        return [
            'avaliations' =>  $this->typeAvaliation->avaliations
        ];
    }
}
