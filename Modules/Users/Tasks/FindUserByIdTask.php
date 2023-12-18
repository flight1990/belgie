<?php

namespace Modules\Users\Tasks;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;

class FindUserByIdTask
{
    public function run(int $id): Model|Collection|Builder|array|null
    {
        return User::query()
            ->where('id', '!=', 1)
            ->findOrFail($id);
    }
}
