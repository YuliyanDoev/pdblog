<?php

namespace App\Repositories\v1;

use App\Repositories\Repository;

/**
 * Class CommentsRepository.
 */
class CommentRepository extends Repository
{
   /**
     * Get all instances of model
     *
     * @return void
     */
    public function all()
    {
        return $this->model->with(['tags'])->get();
    }

    /**
     * create a new record in the database
     *
     * @param array $data
     * @return void
     */
    public function create($data)
    {
        $data['user_id'] = auth()->id();
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
}
