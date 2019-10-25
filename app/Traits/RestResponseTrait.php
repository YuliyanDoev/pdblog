<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;


/**
 * Api response trait structure response
 */
trait RestResponseTrait
{
    /**
     * Set transformed data in variable
     *
     * @var array
     */
    protected $data = [];

    /**
     * Prepare response with structured and transformed data
     *
     * @param  $collection
     * @return Illuminate\Http\Response
     */
    public function response($collection)
    {

        if (!$collection || !$collection->count()) {
            return $this->notFoundResponse();
        }

        //transform data
        $this->transform($collection);

        return $this->successResponse($this->data);
    }

    /**
     * Return success response
     *
     * @param array $data
     * @param string $message
     * @return Illuminate\Http\Response
     */
    protected function successResponse($data = null,$message = null)
    {

        $response = [
            'code' => 200,
            'data' => $data,
            'message' => $message ?? __('response.success'),
        ];

        return response($response, $response['code']);
    }

    /**
     * No data in response
     *
     * @return Illuminate\Http\Response
     */
    protected function notFoundResponse()
    {

        $response = [
            'code' => 404,
            'message' => __('response.res_not_found')
        ];

        return response($response, $response['code']);
    }

    /**
     * When record is delete return this response
     *
     * @return Illuminate\Http\Response
     */
    public function deleteResponse()
    {

        $response = [
            'code' => 204,
            'message' => __('response.success_delete'),
        ];

        return response($response, $response['code']);
    }

    /**
     * On error can use this it return info for error
     *
     * @param array $data
     * @param integer $code
     * @param string $message
     * @return Illuminate\Http\Response
     */
    public function errorResponse($data, $code = 422, $message = null)
    {

        $response = [
            'code' => $code,
            'data' => $data,
            'message' => $message ?? __('response.un_entry'),
        ];

        return response($response, $response['code']);
    }


      /**
     * Transform data to by criteria
     *
     * @param collection $collection
     * @return array
     */
    protected function transform($collection)
    {

        if($collection instanceof Collection){
            $resource = $collection->first()->resource;
            $this->data = $resource::collection($collection);
        }else{
            $resource = $collection->resource;
            $this->data = (new $resource($collection));
        }

    }

}
