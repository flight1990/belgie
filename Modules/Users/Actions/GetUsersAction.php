<?php

namespace Modules\Users\Actions;

use Modules\Users\Tasks\GetUsersTask;

class GetUsersAction
{
    public function run()
    {
        return app(GetUsersTask::class)->run();
    }
}
