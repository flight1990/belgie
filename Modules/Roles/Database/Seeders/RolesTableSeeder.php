<?php

namespace Modules\Roles\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesTableSeeder extends Seeder
{

    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            [
                'name' => 'roles.index',
                'module' => 'Roles',
                'description' => 'Просмотр ролей'
            ],
            [
                'name' => 'roles.create',
                'module' => 'Roles',
                'description' => 'Создание роли'
            ],
            [
                'name' => 'roles.edit',
                'module' => 'Roles',
                'description' => 'Редактирование роли'
            ],
            [
                'name' => 'roles.destroy',
                'module' => 'Roles',
                'description' => 'Удаление роли'
            ],
            [
                'name' => 'users.index',
                'module' => 'Users',
                'description' => 'Просмотр пользователей'
            ],
            [
                'name' => 'users.create',
                'module' => 'Users',
                'description' => 'Создание пользователя'
            ],
            [
                'name' => 'users.edit',
                'module' => 'Users',
                'description' => 'Редактирование пользователя'
            ],
            [
                'name' => 'users.destroy',
                'module' => 'Users',
                'description' => 'Удаление пользователя'
            ],
            [
                'name' => 'statistics.index',
                'module' => 'Statistics',
                'description' => 'Просмотр статистики'
            ],
            [
                'name' => 'maps.towers.index',
                'module' => 'Maps',
                'description' => 'Просмотр карты вышека'
            ],
            [
                'name' => 'maps.tests.index',
                'module' => 'Maps',
                'description' => 'Просмотр карты тестов'
            ],
            [
                'name' => 'operators.index',
                'module' => 'Operators',
                'description' => 'Просмотр операторов'
            ],
            [
                'name' => 'operators.create',
                'module' => 'Operators',
                'description' => 'Создание оператора'
            ],
            [
                'name' => 'operators.edit',
                'module' => 'Operators',
                'description' => 'Редактирование оператора'
            ],
            [
                'name' => 'operators.destroy',
                'module' => 'Operators',
                'description' => 'Удаление оператора'
            ],
            [
                'name' => 'servers.index',
                'module' => 'Servers',
                'description' => 'Просмотр серверов'
            ],
            [
                'name' => 'servers.create',
                'module' => 'Servers',
                'description' => 'Создание сервера'
            ],
            [
                'name' => 'servers.edit',
                'module' => 'Servers',
                'description' => 'Редактирование сервера'
            ],
            [
                'name' => 'servers.destroy',
                'module' => 'Servers',
                'description' => 'Удаление сервера'
            ],
            [
                'name' => 'towers.index',
                'module' => 'Towers',
                'description' => 'Просмотр вышек'
            ],
            [
                'name' => 'towers.create',
                'module' => 'Towers',
                'description' => 'Создание вышки'
            ],
            [
                'name' => 'towers.edit',
                'module' => 'Towers',
                'description' => 'Редактирование вышки'
            ],
            [
                'name' => 'towers.destroy',
                'module' => 'Towers',
                'description' => 'Удаление вышки'
            ],
            [
                'name' => 'standards.index',
                'module' => 'Standards',
                'description' => 'Просмотр стандартов'
            ],
            [
                'name' => 'standards.create',
                'module' => 'Standards',
                'description' => 'Создание стандарта'
            ],
            [
                'name' => 'standards.edit',
                'module' => 'Standards',
                'description' => 'Редактирование стандарта'
            ],
            [
                'name' => 'standards.destroy',
                'module' => 'Standards',
                'description' => 'Удаление стандарта'
            ],
            [
                'name' => 'web-resources.index',
                'module' => 'Web Resources',
                'description' => 'Просмотр web ресурсов'
            ],
            [
                'name' => 'web-resources.create',
                'module' => 'Web Resources',
                'description' => 'Создание web ресурса'
            ],
            [
                'name' => 'web-resources.edit',
                'module' => 'Web Resources',
                'description' => 'Редактирование web ресурса'
            ],
            [
                'name' => 'web-resources.destroy',
                'module' => 'Web Resources',
                'description' => 'Удаление web ресурса'
            ],
            [
                'name' => 'connection-types.index',
                'module' => 'Connection Types',
                'description' => 'Просмотр технологий'
            ],
            [
                'name' => 'connection-types.create',
                'module' => 'Connection Types',
                'description' => 'Создание технологии'
            ],
            [
                'name' => 'connection-types.edit',
                'module' => 'Connection Types',
                'description' => 'Редактирование технологии'
            ],
            [
                'name' => 'connection-types.destroy',
                'module' => 'Connection Types',
                'description' => 'Удаление технологии'
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        $permissions = Permission::all();

        $roles = [
            [
                'name' => 'Super Admin',
            ],
            [
                'name' => 'Admin',
            ]
        ];

        foreach ($roles as $role) {
           $role =  Role::create($role);
            $role->syncPermissions($permissions);
        }

        $users = [
            [
                'name' => 'Борисюк Владимир',
                'email' => 'vladimirborisiuk@gmail.com',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
            ]
        ];

        foreach ($users as $user) {
            $user = User::factory()->create($user);
            $user->assignRole($role);
        }
    }
}
