<?php

namespace App\Http\Requests\Reserves;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReserveRequest extends FormRequest
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
            'costumer'   => 'required|exists:App\Models\Costumer,id',
            'vehicle'    => 'required|exists:App\Models\Vehicle,id',
            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:' .  Date('Y-m-d'),
            'end_date'   => 'required|date|date_format:Y-m-d|after_or_equal:start_date'
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
            'max'      => 'The field :attribute must have at most :max characters',
        ];
    }
}
