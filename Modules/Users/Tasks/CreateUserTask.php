<?php

namespace Modules\Users\Tasks;

use Modules\Users\Models\User;

class CreateUserTask
{
    public function run(array $data)
    {

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->syncRoles($data['roles']);

        return $user;
    }
}
