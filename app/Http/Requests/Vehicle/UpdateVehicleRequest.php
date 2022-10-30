<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'model'  => 'required|string|max:50',
            'brand'   => 'required|string|max:50',
            'plate' => 'required|string|min:7|max:7|unique:vehicles,plate,'.$this->vehicle->id,
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1)
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'required' => 'The field :attribute must have be filled',
            'string'   => 'The field :attribute must have be a string',
            'min'      => 'The field :attribute must have at least :min characters',
            'max'      => 'The field :attribute must have at most :max characters',
        ];
    }

}
