<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * AbstractRepository constructor.
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model
    {
        return $this->model->create($params);
    }
}
