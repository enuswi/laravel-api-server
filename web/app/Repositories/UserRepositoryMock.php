<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepositoryMock implements UserRepositoryInterface
{
    /**
     * @var User $user
     */
    protected $user;

    /**
     * UserRepositoryMock constructor.
     */
    public function __construct()
    {
        $this->user = new User;
    }

    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model
    {
        $this->user->id = 1;
        $this->user->name = 'test';
        $this->user->email = 'test@test.test';
        return $this->user;
    }
}
