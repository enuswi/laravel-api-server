<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model;
}
