<?php

namespace Modules\Users\Actions;

use Modules\Users\Tasks\CreateUserTask;

class CreateUserAction
{
    public function run(array $data)
    {
        return app(CreateUserTask::class)->run($data);
    }
}
