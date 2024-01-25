<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'name' => 'required|min:3|max:200',
            'address' => 'required|max:200',
            'piva' => 'required|numeric',
            'photo' => 'required|image',
            'typologies' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => "Il ristorante deve avere un nome",
            'name.min' => "Il nome del ristorante deve essere di almeno :min caratteri",
            'address.required' => "L'indirizzo del ristorante è richiesto",
            'address.max' => "L'indirizzo non può essere più lungo di :max caratteri",
            'name.max' => "Il nome del ristorante non può essere più lungo di :max caratteri",
            'piva.required' => 'Inserisci una partita IVA',
            'piva.numeric' => 'Formato partita IVA non corretto',
            'photo.required' => 'Inserisci una foto per il ristorante',
            'photo.image' => 'Puoi caricare solo file immagini',
            'typologies.required' => 'Almeno una categoria per il ristorante è richiesta'

        ];
    }
}
