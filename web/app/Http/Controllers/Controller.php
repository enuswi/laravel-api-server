<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @package App\Http\Controllers\Api
 * @OA\Info(
 *   version="1.0.0",
 *   title="Laravel API Server",
 *   description="PHP8.0.0, Laravel8で作るサンプルAPIサーバプロジェクト"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
