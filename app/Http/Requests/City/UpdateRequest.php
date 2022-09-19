<?php

namespace App\Http\Requests\City;

use App\Http\PatternResponses\IPatternResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
{

    protected $patternResponse;

    /**
     * @param IPatternResponse $patternResponse
     */
    public function __construct(IPatternResponse $patternResponse)
    {
        $this->patternResponse = $patternResponse;
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'name' => 'required|max:255',
            'group_cities_id' => 'exists:group_cities,id,deleted_at,NULL'
        ];
    }

    protected function failedValidation(Validator $validator) {
        $response = $this->patternResponse->responseFailed($validator->errors());

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
