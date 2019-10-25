<?php

namespace App\Repositories\v1;

use App\Repositories\Repository;
use Illuminate\Support\Facades\Storage;

/**
 * Class ArticleRepository.
 */
class ArticleRepository extends Repository
{
    /**
     * Get all instances of model
     *
     * @return void
     */
    public function all()
    {
        $search = request()->get('search');
        $category = request()->get('category');
        $tag = request()->get('tag');

        return $this->model->search($search,$category,$tag)->with(['tags','category','user'])->get();
    }

    /**
     * create a new record in the database
     *
     * @param array $data
     * @return void
     */
    public function create($data)
    {

        if(isset($data['image'])){
            $path = Storage::disk('assets')->putFile('images/articles/'.now()->format('Y/m/d'), $data['image']);
            $data['image'] = $path;
        }

        $data['user_id'] = auth()->id();

        $record = $this->model->create($data);

        $record->tags()->attach($data['tags'] ?? []);

        return $record;
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

        if(isset($data['image'])){
            if($record->image){
                Storage::disk('assets')->delete($record->image);
            }
            $path = Storage::disk('assets')->putFile('images/articles/'.now()->format('Y/m/d'), $data['image']);
            $data['image'] = $path;
        }else if($record->image && !$data['image_path']){
            $data['image'] = "";
            Storage::disk('assets')->delete($record->image);
        }

        $record->tags()->sync($data['tags'] ?? []);

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
        $record = $this->model->findOrFail($id);

        Storage::disk('assets')->delete($record->image);

        $record->tags()->detach();

        return $record->delete();
    }

    /**
     * show the record with the given id
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        return $this->model->with(['tags','category','comments.user','user'])->findOrFail($id);
    }
}
