<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * @param Request $request
     * @return string|bool
     * @OA\Post(
     *   path="/api/v1/register",
     *   operationId="register",
     *   tags={"User"},
     *   summary="ユーザー登録API",
     *   description="",
     *   @OA\RequestBody(
     *     required=true,
     *     description="",
     *     @OA\JsonContent(
     *       required={"name","email","password","password_confirmation"},
     *       @OA\Property(property="name", type="string", example="test_user"),
     *       @OA\Property(property="email", type="string", format="email", example="test@test.test"),
     *       @OA\Property(property="password", type="string", format="password", example="test1234"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="test1234")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="成功",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="status",
     *         type="integer",
     *         description="ステータス",
     *         example="200",
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         description="メッセージ",
     *         example="success"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="失敗",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="status",
     *         type="integer",
     *         description="ステータス",
     *         example="400",
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         description="メッセージ",
     *         example="failed"
     *       )
     *     )
     *   )
     * )
     */
    public function register(Request $request): string|bool
    {
        if ($response = $this->userService->register($request->all())) {
            return json_encode(['status' => true]);
        }
        return json_encode(['status' => false]);
    }
}
