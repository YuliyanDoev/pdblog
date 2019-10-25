<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreCategory;
use App\Http\Requests\v1\UpdateCategory;
use App\Repositories\v1\CategoryRepository;

class CategoriesController extends Controller
{
    private $repository;

    public function __construct(Category $category)
    {
        $this->repository = new CategoryRepository($category);
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
    public function store(StoreCategory $request)
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
    public function update(UpdateCategory $request, $id)
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
