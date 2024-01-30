<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:100',
            'description' => 'required',
            'ingredients' => 'required',
            'visible' => 'required|boolean',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image',
        ];
    }
        public function messages() : array
        {
            return [
                'name.required' => "Il piatto deve avere un nome",
                'name.min' => "Il nome del piatto deve essere di almeno :min caratteri",
                'name.max' => "Il nome del piatto non può superare i :min caratteri",
                'visible.boolean' => 'Il campo visibile non è corretto',
                'visible.required' => "Il campo visibile è richiesto",
                'price.min' => 'Il prezzo deve essere almeno :min.',
                'price.numeric' => "Il prezzo è in formato errato",
                'price.required' => "Inserisci un prezzo",
                'ingredients.required' => 'Devi inserire almeno un ingrediente',
                'description.required' => 'Inserisci una descrizione del piatto',
                'photo.image' => 'Sono accettati solo file immagini',
            ];
        }
    }
