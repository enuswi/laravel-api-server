<?php
namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param array $params
     * @return User|bool
     */
    public function register(array $params): User|bool
    {
        try {
            DB::beginTransaction();

            $user = new User;
            $user->password = Hash::make($params['password']);
            $user->email = $params['email'];
            $user->name = $params['name'];
            $user->save();

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }

    }
}
