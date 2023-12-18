<?php

namespace Modules\Users\Actions;

use Modules\Users\Tasks\DeleteUserTask;

class DeleteUserAction
{
    public function run(int $id)
    {
        return app(DeleteUserTask::class)->run($id);
    }
}
