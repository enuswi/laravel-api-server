<?php

namespace Tests\Feature;

use App\Models\User;
use App\Http\Controllers\Api\AbstractApiController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 新しいユーザーを作成して返却する
     * @test
     */
    public function should_create_new_user(): void
    {
        $data = [
            'name' => 'test_user',
            'email' => 'test@test.test',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->json('POST', 'api/v1/register', $data);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(['status' => ['code' => Response::HTTP_OK]])
            ->assertJson(['status' => ['type' => AbstractApiController::STATUS_TYPE_SUCCESS]])
            ->assertJson(['response' => ['name' => $user->name]]);
    }
}
