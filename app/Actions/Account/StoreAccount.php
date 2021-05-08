<?php

namespace App\Actions\Account;
use App\Models\User;

class StoreAccount
{
  public function execute(array $inputs = [], User $user)
  {
    $user->create($inputs);
  }
}
