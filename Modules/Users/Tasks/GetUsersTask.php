<?php

namespace Modules\Users\Tasks;

use Illuminate\Database\Eloquent\Collection;
use Modules\Users\Models\User;

class GetUsersTask
{
    public function run(): Collection|array
    {
        return User::query()
            ->where('id', '!=', 1)
            ->select(['id', 'name', 'email', 'created_at', 'updated_at'])
            ->get();
    }
}
