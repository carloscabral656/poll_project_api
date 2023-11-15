<?php

namespace App\Services;

use App\Models\User;

class UsersService extends ServiceAbstract
{
    /**
     * 
    */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * 
    */
    public static function getModel() : User {
        return app(User::class);
    }

}
