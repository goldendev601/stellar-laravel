<?php
namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    protected $repository;
    protected $model;

    public function __construct(BaseRepository $repository = null, Model $model = null)
    {
        $this->repository = $repository;
        $this->model = $model;
    }

    public function findByID($id)
    {
        return $this->repository->findByID($id);
    }
}

