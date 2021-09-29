<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use LaravelViews\LaravelViews;
use Mockery\Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FormBuilderTrait;

    public $pole_fail_data_value = "00";
    public $pole_auth_value = "01";
    public $pole_last_update_value = "02";
    public $pole_brightness_data_value = "03";
    public $pole_status_data_value = "04";
    public $pole_day_data_value = "05";

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
        $this->response['api_status_code'] = 403;
        $this->response['response_status'] = 1;
    }

    public function return_response_unauthorised(): JsonResponse
    {
        $this->set_return_response_unauthorised();
        return $this->return_response();
    }

    public function set_return_response_unauthorised($message = "Unauthorized Access")
    {
        $this->status = $this->statusArr['unauthorised'];
        $this->response['data'] = null;
        $this->response['message'] = $message;
        $this->response['api_status_code'] = 412;
        $this->response['response_status'] = 1;
    }

    public function return_response(): JsonResponse
    {
        return response()->json($this->response, $this->status, []);
    }

    /**
     * @param $response_id
     * @param $data
     */
    public function return_response_pole($response_id, $data)
    {
        $this->response['api_status_code'] = 200;

        if ($response_id == $this->pole_auth_value) {
//            echo "#:" . $this->pole_auth_value . ":$data";
            echo "$data";
        } elseif ($response_id == $this->pole_last_update_value) {
//            echo "#:" . $this->pole_last_update_value . ":$data$";
            echo "$data";
        } elseif ($response_id == $this->pole_brightness_data_value) {
//            echo "#:" . $this->pole_brightness_data_value . ":$data$";
            echo "$data";
        } elseif ($response_id == $this->pole_status_data_value) {
//            echo "#:" . $this->pole_status_data_value . ":$data$";
            echo "$data";
        } elseif ($response_id === 05) {
//            echo "#:" . $this->pole_day_data_value . ":$data$";
            echo "$data";
        } elseif ($response_id === 10) {
            echo "#:10:$data";
        } elseif ($response_id == $this->pole_fail_data_value) {
//            $this->response['status'] = 403;
            http_response_code(403);
            echo "#:" . $this->pole_fail_data_value . ":$data$";
        } elseif ($response_id === "time") {
//            echo "#:" . $this->pole_day_data_value . ":$data$";
            echo "$data";
        } else {
            echo $data;
        }
//        return response();
        exit();
    }

    public function return_response_att_error($message_data)
    {
        http_response_code(403);
        $this->return_response_att($message_data);
    }

    public function return_response_att($message_data)
    {
        echo $message_data;
        exit();
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
        $this->response['api_status_code'] = 403;
        $this->response['response_status'] = 1;
    }

    function createForm($id, string $className, Model $model, string $route, string $sidemenuName)
    {
        try {
            if ($id) {
                $model = $model->whereId($id)->first();
            }

            $form = $this->form($className, [
                'method' => 'POST',
                'model' => $model,
                'url' => $route,
                $sidemenuName => true,
            ]);
            return view('layouts.hrms_forms', compact('form'));
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param Controller $controller
     * @param string $className
     * @param Model $model
     * @param string $route
     * @param string $sidemenuName
     * @param string $message
     * @return string
     */
    function saveFormData(string $className, Model $model, string $route, string $sidemenuName, string $message): string
    {
        $form = $this->form($className);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $formData = $form->getFieldValues();
        $attribute = null;
        if ($formData['id'] == null) {
            $formData['created_by'] = Auth::id();
        } else {
            $attribute['id'] = $formData['id'];
        }
        $formData['updated_by'] = Auth::id();

        if ($attribute) {
            $saveData = $model::updateOrCreate($attribute, $formData);
        } else {
            $saveData = $model::create($formData);
        }

        if ($saveData) {
            notify()->success("$message Updated Successfully.");
        } else {
            notify()->error("$message Update has Some Issue Please try Again.");
        }
        $data[$sidemenuName] = true;

        return redirect()->route($route, $data);
    }

    function createList(LaravelViews $laravelViews, string $className, string $title, string $sidemenuName, bool $refresh_page = false): string
    {
        $laravelViews->create($className)
            ->layout('main-list', 'container', [
                'title' => $title,
                'refresh' => $refresh_page,
                $sidemenuName => true,
            ]);

        return $laravelViews->render();
    }
}
