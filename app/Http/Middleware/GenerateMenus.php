<?php

namespace App\Http\Middleware;

use Menu;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenerateMenus
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user) {
            Menu::make('menu', function ($menu) use ($user) {

                $menu->add('Профиль', route('profile.edit'))->nickname('profile');
                $menu->add('Тесты', route('tests.index'))->nickname('tests');

                if ($user->hasAnyPermission(['statistics.index'])) {
                    $menu->add('Статистика', route('statistics.index'))->nickname('statistics');
                }

                $menu->add('Карты', ['disableActivationByURL' => true])->nickname('maps');

                if ($user->hasAnyPermission(['maps.towers.index'])) {
                    $menu->item('maps')->add('Карта вышека', route('maps.towers.index'))->active('maps/towers/*');
                }

                if ($user->hasAnyPermission(['maps.tests.index'])) {
                    $menu->item('maps')->add('Карта тестов', route('maps.tests.index'))->active('maps/tests/*');
                }

                $menu->add('Роли и пользователи', ['disableActivationByURL' => true])->nickname('acl');

                if ($user->hasAnyPermission(['users.index', 'users.create', 'users.edit', 'users.destroy'])) {
                    $menu->item('acl')->add('Пользователи', route('users.index'))->active('users/*');
                }

                if ($user->hasAnyPermission(['roles.index', 'roles.create', 'roles.edit', 'roles.destroy'])) {
                    $menu->item('acl')->add('Роли', route('roles.index'))->active('roles/*');
                }

                $menu->add('Администрирование', ['disableActivationByURL' => true])->nickname('administration');

                if ($user->hasAnyPermission(['operators.index', 'operators.create', 'operators.edit', 'operators.destroy'])) {
                    $menu->item('administration')->add('Операторы', route('operators.index'))->active('administration/operators/*');
                }

                if ($user->hasAnyPermission(['towers.index', 'towers.create', 'towers.edit', 'towers.destroy'])) {
                    $menu->item('administration')->add('Вышки', route('towers.index'))->active('administration/towers/*');
                }

                if ($user->hasAnyPermission(['servers.index', 'servers.create', 'servers.edit', 'servers.destroy'])) {
                    $menu->item('administration')->add('Серверы', route('servers.index'))->active('administration/servers/*');
                }

                if ($user->hasAnyPermission(['standards.index', 'standards.create', 'standards.edit', 'standards.destroy'])) {
                    $menu->item('administration')->add('Стандарты', route('standards.index'))->active('administration/standards/*');
                }

                if ($user->hasAnyPermission(['web-resources.index', 'web-resources.create', 'web-resources.edit', 'web-resources.destroy'])) {
                    $menu->item('administration')->add('Web ресурсы', route('web-resources.index'))->active('administration/web-resources/*');
                }

                if ($user->hasAnyPermission(['connection-types.index', 'connection-types.create', 'connection-types.edit', 'connection-types.destroy'])) {
                    $menu->item('administration')->add('Технологии', route('connection-types.index'))->active('administration/connection-types/*');
                }
            });
        }

        return $next($request);
    }
}
