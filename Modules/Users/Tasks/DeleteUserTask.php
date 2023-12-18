<?php

namespace Modules\Users\Tasks;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;

class DeleteUserTask
{
    public function run(int $id): Model|Collection|Builder|array|null
    {
        $user = User::query()->findOrFail($id);
        $user->delete();

        return $user;
    }

}
