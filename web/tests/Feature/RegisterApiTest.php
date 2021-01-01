<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 新しいユーザーを作成して返却する
     * @test
     */
    public function should_create_and_return_new_user()
    {
        $data = [
            'name' => 'test_user',
            'email' => 'test@test.test',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->post('api/v1/register', $data);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);

        $response->assertStatus(Response::HTTP_OK);
    }
}
