<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

abstract class FormRequest extends BaseFormRequest
{
    protected $defaultValidator = false;// 是否使用默认的表单验证

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 扩展默认的表单验证，支持根据控制器 method 来返回验证规则.
     *
     * @param \Illuminate\Contracts\Validation\Factory $factory
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createDefaultValidator(ValidationFactory $factory)
    {
        if ($this->defaultValidator) {
            return parent::createDefaultValidator($factory);
        }

        $method = $this->route()->getActionMethod();

        return $factory->make(
            $this->validationData(), $this->container->call([$this, 'rules'], compact('method')),
            $this->messages(), $this->attributes()
        )->stopOnFirstFailure($this->stopOnFirstFailure);
    }
}