<?php namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * @property Request request
 */
class BaseRequest
{
    protected $id;

    /**
     *  A list of all post validation errors
     * @var array
     */
    protected $errors = [];

    protected $fieldsToBeRestricted = [];

    /**
     * @throws ValidationException
     */
    public function __construct()
    {
        if (!isset($this->request)) {
            $this->request = app('request');
        }

        $this->validate();
    }

    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $this->filterRequestAttributes();

        $this->mergeRequestWithAttributes();

        $requestAll = method_exists($this, 'all') ? $this->all() : $this->request->all();

        $validator = Validator::make($requestAll, $this->rules(), $this->messages(), $this->attributes());

        $pass = !empty($this->rules()) ? $validator->passes() : true;

        if (!$pass) {
            throw new ValidationException($validator);
        }

        $this->postValidate();

        if (!empty($this->errors)) {
            throw ValidationException::withMessages($this->errors);
        }
    }

    public function postValidate()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * @param $method
     * @param $params
     * @return false|mixed
     */
    function __call($method, $params)
    {
        if (!isset($this->request)) {
            $this->request = app('request');
        }
        return call_user_func_array([$this->request, $method], $params);
    }

    /**
     * @param $attr
     * @return mixed|null
     */
    function __get($attr)
    {
        if ($this->request->has($attr)) {
            return $this->request->input($attr);
        }
        if (property_exists($this->request, $attr)) {
            return $this->request->$attr;
        }
        return null;
    }

    /**
     * @param $attr
     * @param $default
     * @return mixed
     */
    public function get($attr, $default = null)
    {
        return $this->request->input($attr, $default);
    }

    /**
     * @return void
     */
    protected function mergeRequestWithAttributes() : void
    {

    }

    /**
     * @return void
     */
    protected function filterRequestAttributes() : void
    {

        $request = request();

        if (is_array($this->fieldsToBeRestricted) && count($this->fieldsToBeRestricted) > 0 )
        {
            array_walk($this->fieldsToBeRestricted, static function($item, $key) use ($request) {
                $request->offsetUnset($item);
            });
        }
    }

}
