<?php

namespace App\Actions\Account;
use App\Models\User;

class DeleteAccount
{
  public function execute(User $user)
  {
    $user->delete();
  }
}
