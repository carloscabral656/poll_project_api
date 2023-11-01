<?php

namespace App\Http\Controllers\TypeAvaliation\DTO;

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
            'title' => $this->typeAvaliation->title,
            'description' => $this->typeAvaliation->description
        ];
    }
}
