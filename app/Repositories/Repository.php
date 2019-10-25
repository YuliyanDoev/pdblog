<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * model property on class instances
     *
     * @var Model
     */
    protected $model;

    /**
     * Constructor to bind model to repository
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all instances of model
     *
     * @return void
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * Get paginate instances of model
     *
     * @return void
     */
    public function paginate()
    {
        return $this->model->paginate(15);
    }

    /**
     * create a new record in the database
     *
     * @param array $data
     * @return void
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * update record in the database
     *
     * @param array $data
     * @param int $id
     * @return void
     */
    public function update($data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * remove record from the database
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * show the record with the given id
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get the associated model
     *
     * @return void
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the associated model
     *
     * @param Model $model
     * @return void
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

}
