<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProducts extends FormRequest
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
        $id = $this->segment(2);

        return [
            'price' => 'required',
            'image' => 'nullable|image',
            'description' => 'required|min:3|max:10000',
            'name' => "required|min:3|max:255|unique:products,name,{$id},id",
        ];
    }

    //Reescrevendo a função de mensagens padrão para traduzir.
    public function messages()
    {
        return [
            'price.required' => 'Campo preço é obrigatório.',
            'name.required' => 'Campo nome é obrigatório.',
            'name.min' => 'Campo nome deve possuir ao menos 3 caracteres.',
            'photo.required' => 'Campo foto é obrigatório.'
        ];
    }
}
