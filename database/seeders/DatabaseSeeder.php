<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ConnectionTypes\Database\Seeders\ConnectionTypesDatabaseSeeder;
use Modules\Operators\Database\Seeders\OperatorsDatabaseSeeder;
use Modules\Roles\Database\Seeders\RolesDatabaseSeeder;
use Modules\Servers\Database\Seeders\ServersDatabaseSeeder;
use Modules\Standards\Database\Seeders\StandardsDatabaseSeeder;
use Modules\WebResources\Database\Seeders\WebResourcesDatabaseSeeder;
use Modules\Tests\Database\Seeders\TestsDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesDatabaseSeeder::class,
            ConnectionTypesDatabaseSeeder::class,
            OperatorsDatabaseSeeder::class,
            StandardsDatabaseSeeder::class,
            ServersDatabaseSeeder::class,
            WebResourcesDatabaseSeeder::class,
//            TestsDatabaseSeeder::class
        ]);
    }
}
