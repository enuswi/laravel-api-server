<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class AbstractApiController
 * @package App\Http\Controllers\Api
 *
 * @OA\Schema(
 *     schema="success_response_status_200",
 *     @OA\Property(
 *          property="status", type="object",
 *          @OA\Property(property="code", type="integer", example=200),
 *          @OA\Property(property="type", type="string", example="success"),
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="failed_response_400",
 *     @OA\Property(
 *          property="status", type="object",
 *          @OA\Property(property="code", type="integer", example=400),
 *          @OA\Property(property="type", type="string", example="failed"),
 *     ),
 *     @OA\Property(
 *          property="response", type="object",
 *     )
 * )
 */
abstract class AbstractApiController extends Controller
{
    /**
     * @param int $statusCode
     * @param string $statusType
     * @param array|string|null $data
     * @return JsonResponse
     */
    protected function responseSuccess(
        int $statusCode = Response::HTTP_OK,
        string $statusType = 'success',
        array|string $data = null
    ): JsonResponse
    {
        return $this->responseFormat($statusCode, $statusType, $data);
    }

    /**
     * @param int $statusCode
     * @param string $statusType
     * @param array|string|null $data
     * @return JsonResponse
     */
    protected function responseFailed(
        int $statusCode = Response::HTTP_BAD_REQUEST,
        string $statusType = 'failed',
        array|string $data = null
    ): JsonResponse
    {
        return $this->responseFormat($statusCode, $statusType, $data);
    }

    /**
     * @param int $statusCode
     * @param string $statusType
     * @param array|string|null $data
     * @return JsonResponse
     */
    private function responseFormat(
        int $statusCode,
        string $statusType,
        array|string|null $data
    ): JsonResponse
    {
        return response()->json([
            'status' => [
                'code' => $statusCode,
                'type' => $statusType
            ],
            'response' => $data
        ], Response::HTTP_OK);
    }
}
