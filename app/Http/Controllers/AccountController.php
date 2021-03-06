<?php

namespace App\Http\Controllers;

use App\Actions\Account\StoreAccount;
use App\Actions\Account\UpdateAccount;
use App\Actions\Account\DeleteAccount;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    public function create()
    {
        return Inertia::render('Account', ['is-new' => true]);
    }

    public function store(StoreAccount $action, Request $request, User $user)
    {
        $action->execute($request->all(), $user);

        return Inertia::render('Home', [
            'users' => user::all()
        ]);
    }

    public function edit(User $user)
    {
        $props = ['user' => $user];

        return Inertia::render('Account', $props);
    }

    public function update(UpdateAccount $action, Request $request, User $user)
    {
        $action->execute($request->all(), $user);

        return Redirect::route('home.index');
    }

    public function confirmation(User $user)
    {
        $props = [
            'user' => $user,
            'is-confirmation' => true
        ];

        return Inertia::render('Account', $props);
    }

    public function destroy(DeleteAccount $action, User $user)
    {
        $action->execute($user);

        return Redirect::route('home.index');
    }

}
