<?php

namespace Modules\Users\Actions;

use Modules\Users\Tasks\FindUserByIdTask;

class FindUserByIdAction
{
    public function run(int $id)
    {
        return app(FindUserByIdTask::class)->run($id);
    }
}
