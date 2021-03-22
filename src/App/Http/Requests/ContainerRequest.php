<?php

declare(strict_types=1);

namespace Asseco\Containers\App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ContainerRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|string|unique:containers,name' . ($this->route('container') ? ',' . $this->route('container')->id : null),
            'owner_id' => 'nullable',
        ];
    }

    /**
     * Dynamically set validator from 'required' to 'sometimes' if resource is being updated.
     *
     * @param Validator $validator
     */
    public function withValidator(Validator $validator)
    {
        $requiredOnCreate = ['name'];

        $validator->sometimes($requiredOnCreate, 'sometimes', function () {
            return $this->container !== null;
        });
    }
}
