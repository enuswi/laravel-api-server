<?php
namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $params)
    {
        try {
            DB::beginTransaction();

            $user = new User;
            $user->password = Hash::make($params['password']);
            $user->email = $params['email'];
            $user->name = $params['name'];
            return $user->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
        
    }
}