<?php

namespace App\Http\Controllers;

use App\Actions\Account\StoreAccount;
use App\Actions\Account\UpdateAccount;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

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

        return Inertia::render('Home', [
            'users' => user::all()
        ]);
    }
}
