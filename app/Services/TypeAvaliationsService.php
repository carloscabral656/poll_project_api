<?php

namespace App\Services;

use App\Models\TypeAvaliation;

class TypeAvaliationsService extends ServiceAbstract
{
    public function __construct(TypeAvaliation $typeAvaliation)
    {
        parent::__construct($typeAvaliation);
    }

    public static function getModel() : TypeAvaliation {
        return app(TypeAvaliation::class);
    }
}
