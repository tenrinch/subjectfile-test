<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach($users as $user)
        {
            $user->roles()->sync([3]);
        }
        User::findOrFail(1)->roles()->sync([1,2,3]);
    }
}
