<?php

namespace App\Http\Controllers\Users\DTO;

use App\interfaces\DTO;
use App\Models\User;

class UsersDTO implements DTO
{

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function encrypt(){
        return [
            'id'        => $this->user->id,
            'name'      => $this->user->name,
            'email'     => $this->user->email,
            'password'  => $this->user->password,
            'age'       => $this->user->age,  
            'birth_date' => $this->user->birth_date               
        ];
    }
}
