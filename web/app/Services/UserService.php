<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
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
        } catch (\Exception $e) {
            DB::rollBack();
            // TODO: ログ関連の処理をどこかにまとめたい
            \Log::info($e->getMessage());
        }
        return false;
    }

    /**
     * ログイン
     * @param array $params
     * @return array|bool
     */
    public function login(array $params): array|bool
    {
        try {
            if (!Auth::guard('web')->attempt($params)) {
                throw new \Exception();
            }

            $user = Auth::guard('web')->user();
            return [
                'name' => $user->name,
                'email' => $user->email,
                'access_token' => $this->createToken($user),
            ];
        } catch (\Exception $e) {
            // TODO: ログ関連の処理をどこかにまとめたい
            \Log::info($e->getMessage());
        }
        return false;
    }

    /**
     * accessTokenの作成
     * @param User $user
     * @return ?string
     */
    private function createToken(User $user): ?string
    {
        $token = $user->createToken($user->id);
        return $token->token->id;
    }
}
