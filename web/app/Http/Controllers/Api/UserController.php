<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
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
     * @return User|bool
     */
    public function register(Request $request): User|bool
    {
        return $this->userService->register($request->all());
    }
}
