<?php

namespace App\Services;

use App\Models\Avaliation;

class AvaliationsService extends ServiceAbstract
{
    public function __construct(Avaliation $avaliation)
    {
        parent::__construct($avaliation);
    }

    public static function getModel() : Avaliation {
        return app(Avaliation::class);
    }
}
