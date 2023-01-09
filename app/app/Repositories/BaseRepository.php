<?php namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
class BaseRepository
{
    /**
     * @var Model
     */
    public $model;

    /**
     * @var Builder
     */
    protected $query;

    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     * @param $key
     * @param bool $fail
     * @param bool $includeArchived
     * @return mixed
     */
    public function getByKey($key, $fail = true, $includeArchived = false)
    {
        if ($includeArchived) {
            $this->query = $this->model->withTrashed();
        }
        if ($fail) {
            return $this->query()->findOrFail($key);
        }

        return $this->query()->find($key);
    }

    /**
     * @return Builder
     */
    public function query()
    {
        if (!$this->query) {
            $this->query = $this->model->newQuery();
        }

        return $this->query;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * @param $input
     * @return mixed
     */
    public function create($input)
    {
        $record = $this->query()->create($input);

        return $record;
    }

    /**
     * @param $key
     * @param $input
     * @return mixed
     */
    public function update($key, $input)
    {
        $record = $this->getByKey($key);
        foreach ($input as $attr => $value) {
            $record->{$attr} = $value;
        }
        $record->save();

        return $record;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function archive($key)
    {
        $record = $this->getByKey($key, true);
        $record->delete();

        return $record;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function delete($key)
    {
        $record = $this->getByKey($key, true, true);
        $result = $record->forceDelete();

        return $result;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function restore($key)
    {
        $record = $this->getByKey($key, true, true);
        $record->restore();

        return $record;
    }

    /**
     * @return Model|null
     */
    public function make()
    {
        return new $this->model;
    }

    public function save($model)
    {
        $model->save();

        return $model;
    }

    public function findByID($id)
    {
        return $this
            ->query()
            ->findOrFail($id);
    }
}

