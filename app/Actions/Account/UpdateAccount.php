<?php

namespace App\Actions\Account;
use App\Models\User;

class UpdateAccount {
  public function execute(array $inputs = [], User $user)
  {
    $user->update($inputs);
  }
}
