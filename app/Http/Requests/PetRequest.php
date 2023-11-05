<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueAnimal;

class PetRequest extends FormRequest
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
            'name'=>['required', new UniqueAnimal($this->input())],
            'image1'=>['required'],
            'image2'=>['required'],
            'image3'=>['required'],
            'image4'=>['required'],
            'image5'=>['required'],
            'specie'=>['required'],
            'breed'=>['required'],
            'age'=>['required', 'integer'],
            'size'=>['required'],
            'local'=>['required'],
            'weight'=>['sometimes', 'integer'],
            'gender'=>['required']
        ];
    }
}
