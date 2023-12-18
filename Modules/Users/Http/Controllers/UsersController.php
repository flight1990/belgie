<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Roles\Actions\GetRolesAction;
use Modules\Roles\Transformers\RoleResource;
use Modules\Users\Actions\CreateUserAction;
use Modules\Users\Actions\DeleteUserAction;
use Modules\Users\Actions\FindUserByIdAction;
use Modules\Users\Actions\GetUsersAction;
use Modules\Users\Actions\UpdateUserAction;
use Modules\Users\Http\Requests\CreateUserRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Transformers\UserResource;

class UsersController extends Controller
{

    public function index(): Response
    {
        $users = app(GetUsersAction::class)->run();

        return Inertia::render('Users::Index/Page', [
            'users' => UserResource::collection($users)
        ]);
    }


    public function create(): Response
    {
        $roles = app(GetRolesAction::class)->run();

        return Inertia::render('Users::Edit/Page', [
            'roles' => RoleResource::collection($roles)
        ]);
    }


    public function store(CreateUserRequest $request): RedirectResponse
    {
        app(CreateUserAction::class)->run($request->validated());

        return redirect()->route('users.index')->with('message', [
            'message' => 'Запись успешно создана.',
            'type' => 'success'
        ]);
    }


    public function edit(int $id): Response
    {
        $user = app(FindUserByIdAction::class)->run($id);
        $roles = app(GetRolesAction::class)->run();

        $userRoles = $user->roles->where('id', '!=', 1)->pluck('id')->toArray();

        return Inertia::render('Users::Edit/Page', [
            'user' => new UserResource($user),
            'roles' => RoleResource::collection($roles),
            'userRoles' => $userRoles
        ]);
    }


    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        app(UpdateUserAction::class)->run($request->validated(), $id);

        return redirect()->route('users.index')->with('message', [
            'message' => 'Запись успешно обновлена.',
            'type' => 'success'
        ]);
    }


    public function destroy(int $id): RedirectResponse
    {
        app(DeleteUserAction::class)->run($id);

        return redirect()->route('users.index')->with('message', [
            'message' => 'Запись успешно удалена.',
            'type' => 'success'
        ]);
    }
}
