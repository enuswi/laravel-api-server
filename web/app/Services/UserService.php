<?php
namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UserService
{
    /**
     * @param array $params
     */
    public function register(array $params)
    {
        try {
            DB::beginTransaction();

            $user = new User;
            $user->password = Hash::make($params['password']);
            $user->email = $params['email'];
            $user->name = $params['name'];
            $user->save();
            DB::commit();

            // accessTokenの作成
            $token = $user->createToken($user->id);
            $token->accessToken->id;

            return $user;
        } catch (Exception|GuzzleException $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
            return false;
        }

    }
}
