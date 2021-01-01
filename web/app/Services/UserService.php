<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(protected UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * ユーザー作成
     * @param array $params
     * @return array|bool
     */
    public function register(array $params): array|bool
    {
        try {
            DB::beginTransaction();

            $params['password'] = Hash::make($params['password']);
            $user = $this->repository->create($params);

            DB::commit();

            return [
                'name' => $user->name,
                'email' => $user->email
            ];
        } catch (Exception $e) {
            DB::rollBack();
            // TODO: ログ関連の処理をどこかにまとめたい
            \Log::info($e->getMessage());
        } finally {
            return false;
        }
    }

    /**
     * TODO: トークン作成メソッドの分離
     * @param array $params
     * @return mixed
     */
    public function createToken(array $params)
    {
        $user = User::factory($params);
        // accessTokenの作成
        $token = $user->createToken($user->id);
        return $token->token->id;
    }
}
