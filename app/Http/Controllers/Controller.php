<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Mockery\Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    public $response = array('test_data' => array(), 'data' => null, 'message' => '');
    public $response = array('data' => null, 'message' => '');
    public $status = 405;
    public $statusArr = [
        'success' => 200,
        'not_found' => 404,
        'unauthorised' => 412,
        'already_exist' => 409,
        'validation' => 422,
        'something_wrong' => 405
    ];

    public function ApiValidator($fields, $rules): bool
    {
        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $this->status = $this->statusArr['validation'];
            $this->response['data'] = null;
            $this->response['error'] = $errors;
            $this->response['message'] = "Data Validation Error";
            $this->response['api_status_code'] = 422;
            $this->response['response_status'] = 1;

            return false;
        }

        return true;
    }

    /**
     * @param $fields
     * @param $rules
     * @return bool
     */
    public function ApiValidatorOnly($fields, $rules): bool
    {
        $validator = Validator::make($fields, $rules);
        if ($validator->fails()) {
            return false;
        }
        return true;
    }

    /**
     * @param $fields
     * @param $rules
     * @return bool|MessageBag
     */
    public function ApiValidatorWithErrors($fields, $rules)
    {
        $validator = Validator::make($fields, $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }
        return true;
    }

    public function set_return_response_exception(Exception $exception)
    {
        $this->status = $this->statusArr['something_wrong'];
        $this->response['data'] = null;
        $this->response['message'] = $exception->getMessage();
        $this->response['response_status'] = 1;
    }

    public function return_response(): JsonResponse
    {
        return response()->json($this->response, $this->status, []);
    }

    public function set_return_response_success($data, $message)
    {
        $this->status = $this->statusArr['success'];
        $this->response['data'] = $data;
        $this->response['message'] = $message;
        $this->response['api_status_code'] = 200;
        $this->response['response_status'] = 0;
    }

    public function set_return_response_unsuccessful($message)
    {
        $this->status = $this->statusArr['something_wrong'];
        $this->response['data'] = null;
        $this->response['message'] = $message;
        $this->response['api_status_code'] = 405;
        $this->response['response_status'] = 1;
    }

    public function set_return_response_no_data_found()
    {
        $this->status = $this->statusArr['not_found'];
        $this->response['data'] = null;
        $this->response['message'] = "No data found.";
        $this->response['api_status_code'] = 404;
        $this->response['response_status'] = 1;
    }

    public function set_return_response_unauthorised($message)
    {
        $this->status = $this->statusArr['unauthorised'];
        $this->response['data'] = null;
        $this->response['message'] = $message;
        $this->response['api_status_code'] = 412;
        $this->response['response_status'] = 1;
    }

}
