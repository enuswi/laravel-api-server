<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginUser;
use App\Services\UserService;
use App\Http\Requests\RegisterUser;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends AbstractApiController
{
    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(protected UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param RegisterUser $request
     * @return JsonResponse
     * @OA\Post(
     *   path="/api/v1/register", operationId="register", tags={"User"}, summary="ユーザー登録API", description="",
     *   @OA\RequestBody(
     *     required=true, description="",
     *     @OA\JsonContent(
     *       required={"name","email","password","password_confirmation"},
     *       @OA\Property(property="name", type="string", example="test_user"),
     *       @OA\Property(property="email", type="string", format="email", example="test@test.test"),
     *       @OA\Property(property="password", type="string", format="password", example="test1234"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="test1234")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200, description="成功",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="status", type="object",
     *         ref="#/components/schemas/success_response_status_200"
     *       ),
     *       @OA\Property(
     *         property="response", type="object",
     *         @OA\Property(property="name", type="string", example="test_user"),
     *         @OA\Property(property="email", type="string", example="test@test.test"),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=400, description="schema",
     *     @OA\JsonContent(
     *       type="object",
     *       ref="#/components/schemas/failed_response_400"
     *     )
     *   )
     * )
     */
    public function register(RegisterUser $request): JsonResponse
    {
        $params = $request->only(['email', 'password', 'name']);
        if ($response = $this->userService->register($params)) {
            return $this->responseSuccess(data: $response);
        }
        return $this->responseFailed();
    }

    /**
     * @param LoginUser $request
     * @return JsonResponse
     * @OA\Post(
     *   path="/api/v1/login", operationId="login", tags={"User"}, summary="ログインAPI", description="",
     *   @OA\RequestBody(
     *     required=true, description="",
     *     @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="test@test.test"),
     *       @OA\Property(property="password", type="string", format="password", example="test1234"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=200, description="成功",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="status", type="object",
     *         ref="#/components/schemas/success_response_status_200",
     *       ),
     *       @OA\Property(
     *         property="response", type="object",
     *         @OA\Property(property="name", type="string", example="test_user"),
     *         @OA\Property(property="email", type="string", example="test@test.test"),
     *         @OA\Property(property="access_token", type="string", example="xxxxxxxxxxxxxxx"),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=400, description="失敗",
     *     @OA\JsonContent(
     *       type="object",
     *       ref="#/components/schemas/failed_response_400"
     *     )
     *   )
     * )
     */
    public function login(LoginUser $request): JsonResponse
    {
        $params = $request->only(['email', 'password']);
        if ($response = $this->userService->login($params)) {
            return $this->responseSuccess(data: $response);
        }
        return $this->responseFailed();
    }
}
