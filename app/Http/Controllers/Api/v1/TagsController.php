<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Tag;
use App\Http\Requests\StoreTag;
use App\Http\Requests\UpdateTag;
use App\Http\Controllers\Controller;
use App\Repositories\v1\TagRepository;

class TagsController extends Controller
{
    private $repository;

    public function __construct(Tag $article)
    {
        $this->repository = new TagRepository($article);
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = $this->repository->all();

        return $this->response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTag $request)
    {

        $data = $this->repository->create($request->all());

        return $this->response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = $this->repository->show($id);

        return $this->response($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTag $request, $id)
    {

        $data = $this->repository->update($request->all(), $id);

        return $this->response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->repository->delete($id);

        return $this->deleteResponse();
    }
}
